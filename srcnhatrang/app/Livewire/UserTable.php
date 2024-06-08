<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Columns\ImageColumn;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;
use RamonRietdijk\LivewireTables\Filters\DateFilter;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use App\Helpers\ExcelHelpers;
use App\Models\UserType;
use App\Models\User;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class UserTable extends LivewireTable
{
    protected string $model = User::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;

    protected function columns(): array {
        return [
            ImageColumn::make(__('Ảnh đại diện'), 'avatar')
            ->displayUsing(function ($avatar) {
                if ($avatar && file_exists(public_path('storage/images/app/upload/' . $avatar))) {
                    $image = asset('storage/images/app/upload/' . $avatar);
                } else {
                    $image = asset('storage/images/user.jpg');
                };
                return $image;
            }),
            Column::make(__('ID'), 'id')
                ->sortable()
                ->searchable(),
            Column::make(__('Họ'), 'first_name')
                ->sortable()
                ->searchable(),
            Column::make(__('Tên'), 'last_name')
                ->sortable()
                ->searchable(),
            Column::make(__('Email'), 'email')
                ->sortable()
                ->searchable(),
            Column::make(__('Số điện thoại'), 'phone_number')
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Quyền'), 'user_type_id')
                ->options(
                    UserType::query()->pluck('user_type_name', 'user_type_id')->toArray()
                )
                ->displayUsing(function ($value) {
                    $userType = UserType::find($value);
                    return $userType ? $userType->user_type_name : '';
                })
                ->sortable()
                ->searchable(),
            Column::make(__('Tỉnh/Thành Phố'), 'userAddress.district.province.name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Quận/Huyện'), 'userAddress.district.name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Phường/Xã'), 'userAddress.name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Chi tiết địa chỉ'), 'address_description')
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày tạo'), 'created_at')
                ->sortable()->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày xác nhận email'), 'email_verified_at')
                ->sortable()->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày đăng nhập gần nhất'), 'login_at')
                ->sortable()->searchable()
                ->format('H:i:s d/m/Y'),   
        ];
    }

    protected function filters(): array {
        $filters = [
            SelectFilter::make(__('Tỉnh/Thành Phố'), 'userAddress.district.province.id')
                ->options(
                    Province::pluck('name', 'id')->toArray()
                ),
            SelectFilter::make(__('Quận/Huyện'), 'userAddress.district.id')
                ->options([]),
            SelectFilter::make(__('Phường/Xã'), 'userAddress.id')
                ->options([]),
            DateFilter::make(__('Ngày xác nhận email'), 'email_verified_at'),
            DateFilter::make(__('Ngày tạo'), 'created_at'),
        ];

        if (isset($this->filters['userAddress_district_province_id'])) {
            $provinceId = $this->filters['userAddress_district_province_id'];
            $filters[1]->options(District::where('province_id', $provinceId)->pluck('name', 'id')->toArray());
        }

        if (isset($this->filters['userAddress_district_id'])) {
            $districtId = $this->filters['userAddress_district_id'];
            if ($districtId !== null) {
                $filters[2]->options(Ward::where('district_id', $districtId)->pluck('name', 'id')->toArray());
            }
        }

        return $filters;
    }

    protected function prepareUserData($users) {
        return $users->map(function ($user) {
            $address = $user->userAddress;
            $provinceName = null;
            $districtName = null;

            if ($address) {
                $district = $address->district;
                if ($district) {
                    $districtName = $district->name;
                    $province = $district->province;
                    if ($province) {
                        $provinceName = $province->name;
                    }
                }
            }

            return [
                'ID' => $user->id,
                'Họ' => $user->first_name,
                'Tên' => $user->last_name,
                'Email' => $user->email,
                'Số điện thoại' => $user->phone_number,
                'Quyền' => $user->userType->user_type_name,
                'Tỉnh/Thành phố' => $provinceName,
                'Huyện/Quận' => $districtName,
                'Phường/Xã' => $user->userAddress->name,
                'Tên đường/Số nhà' => $user->address_description,
                'Ngày tạo tài khoản' => $user->created_at,
                'Ngày xác nhận email' => $user->email_verified_at,
                'Ngày đăng nhập gần nhất' => $user->login_at
            ];
        })->toArray();
    }

    protected function actions(): array {
        $exportData = function ($fileName, $users) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareUserData($users);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachnguoidung'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->with('userAddress.district.province')->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachnguoidung'.now().'.xlsx';
                return $exportData($fileName, User::with('userAddress.district.province')->get());
            })->standalone(),
        ];
    }

}
