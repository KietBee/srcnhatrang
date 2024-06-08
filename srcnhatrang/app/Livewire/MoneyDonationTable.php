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
use App\Models\User;
use App\Models\Fund;
use App\Models\MoneyDonation;

class MoneyDonationTable extends LivewireTable
{
    protected string $model = MoneyDonation::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;

    protected function columns(): array {
        return [
            ImageColumn::make(__('Ảnh đại diện'), 'donor.avatar')
            ->displayUsing(function ($avatar) {
                if ($avatar && file_exists(public_path('storage/images/app/upload/' . $avatar))) {
                    $image = asset('storage/images/app/upload/' . $avatar);
                } else {
                    $image = asset('storage/images/user.jpg');
                };
                return $image;
            }),
            Column::make(__('ID'), 'money_donation_id')
                ->sortable()
                ->searchable(),
            Column::make(__('Họ người quyên góp'), 'donor.first_name')
                ->sortable()
                ->searchable(),
            Column::make(__('Tên người quyên góp'), 'donor.last_name')
                ->sortable()
                ->searchable(),
            Column::make(__('Số tiền quyên góp'), 'amount')
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Tần xuất quyên góp'), 'frequency')
                ->options([
                    '1' => 'Quyên góp 1 lần/ tháng',
                    '0' => 'Quyên góp 1 lần',
                ])
                ->displayUsing(function ($value) {
                    return $value ? 'Quyên góp 1 lần/ tháng' : 'Quyên góp 1 lần';
                })
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày quyên góp'), 'created_at')
                ->sortable()->searchable()
                ->format('H:i:s d/m/Y'),
        ];
    }

    protected function filters(): array {
        return [
            SelectFilter::make(__('Quỹ quyên góp'), 'fund_id')
                ->options(
                    Fund::query()->pluck('title', 'fund_id')->toArray()
                ),
            SelectFilter::make(__('Tuần xuất quyên góp'), 'frequency')
                ->options([
                    '1' => 'Quyên góp 1 lần/ tháng',
                    '0' => 'Quyên góp 1 lần',
                ]),

            DateFilter::make(__('Ngày quyên góp'), 'created_at'),
        ];
    }

    protected function prepareExportData($pets) {
        return $pets->map(function ($pet) {
            return [
                'ID' => $pet->pet_id,
                'Tên' => $pet->pet_name,
                'Mô tả' => $pet->description,
                'Loại' => $pet->breed->breed_name,
                'Màu chủ đạo' => $pet->primaryColor->primary_color_name,
                'Tuổi' => $pet->age->description,
                'Kích thước' => $pet->size->description,
                'Giới tính' => $pet->gender ? 'Giống đực' : 'Giống cái',
                'Tình trạng sức khỏe' => $pet->health_status,
                'Ngày nhận' => $pet->rescued_at,
                'Ngày tạo' => $pet->created_at,
                'Ngày cập nhật gần nhất' => $pet->updated_at,
            ];
        })->toArray();
    }

    protected function actions(): array {
        $exportData = function ($fileName, $pets) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareExportData($pets);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachquyengop'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachquyengop'.now().'.xlsx';
                return $exportData($fileName, MoneyDonation::all());
            })->standalone(),
        ];
    }
}
