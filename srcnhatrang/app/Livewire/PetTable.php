<?php

namespace App\Livewire;

use App\Models\Breed;
use App\Models\Pet;
use App\Models\PetImage;
use App\Models\Size;
use App\Models\Age;
use App\Models\PrimaryColor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Enumerable;
use RamonRietdijk\LivewireTables\Actions\Action;
use RamonRietdijk\LivewireTables\Columns\BooleanColumn;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Columns\ImageColumn;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;
use RamonRietdijk\LivewireTables\Filters\BooleanFilter;
use RamonRietdijk\LivewireTables\Filters\DateFilter;
use RamonRietdijk\LivewireTables\Filters\SelectFilter;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use App\Helpers\ExcelHelpers;

class PetTable extends LivewireTable
{
    protected string $model = Pet::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;
    protected function columns(): array
    {
        return [
            ImageColumn::make(__('Hình ảnh'), 'pet_id')
            ->displayUsing(function ($petId) {
                $avatar = PetImage::where('pet_id', $petId)->first();
                if ($avatar && file_exists(public_path('storage/images/app/upload/' . $avatar))) {
                    $image = asset('storage/images/app/upload/' . $avatar);
                } else {
                    $image = asset('storage/images/default.jpg');
                };
                return $image;
            }),
            Column::make(__('ID'), 'pet_id')
                ->sortable()
                ->searchable(),
            Column::make(__('Tên'), 'pet_name')
                ->sortable()
                ->searchable(),
            Column::make(__('Mô tả'), 'description')
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Loại'), 'breed_id')
                ->options(
                    Breed::query()->pluck('breed_name', 'breed_id')->toArray()
                )
                ->displayUsing(function ($value) {
                    $breed = Breed::find($value);
                    return $breed ? $breed->breed_name : '';
                })
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Màu chủ đạo'), 'primary_color_id')
                ->options(
                    PrimaryColor::query()->pluck('primary_color_name', 'primary_color_id')->toArray()
                )
                ->displayUsing(function ($value) {
                    $primaryColor = PrimaryColor::find($value);
                    return $primaryColor ? $primaryColor->primary_color_name : '';
                })
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Tuổi'), 'age_id')
                ->options(
                    Age::query()->pluck('description', 'age_id')->toArray()
                )
                ->displayUsing(function ($value) {
                    $age = Age::find($value);
                    return $age ? $age->description : '';
                })
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Kích thước'), 'size_id')
                ->options(
                    Size::query()->pluck('description', 'size_id')->toArray()
                )
                ->displayUsing(function ($value) {
                    $size = Size::find($value);
                    return $size ? $size->description : '';
                })
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Giới tính'), 'gender')
                ->options([
                    '1' => 'Giống đực',
                    '0' => 'Giống cái',
                ])
                ->displayUsing(function ($value) {
                    return $value ? 'Giống đực' : 'Giống cái';
                })
                ->sortable()
                ->searchable(),
            Column::make(__('Tình trạng sức khỏe'), 'health_status')
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày nhận'), 'rescued_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày tạo'), 'created_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày cập nhật gần nhất'), 'updated_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            Column::make(__('Tùy chọn'), function (Model $model): string {
                $editUrl = route('admin.pet.edit', ['id' => $model->getKey()]);
            
                return '<ul class="flex flex-wrap gap-3 items-center justify-center text-gray-900 dark:text-white">
                <li>
                    <a href="'.$editUrl.'"> 
                        <svg class="w-[20px] h-[20px] text-green-800 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                        </svg>                  
                    </a>
                </li>
                <li>
                    <button> 
                        <svg  data-target="'.$model->getKey().'" class="btnDelete text-red-600 w-[20px] h-[20px]  dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                        </svg> 
                    </button>
                </li>
            </ul>';
            })->clickable(false)->asHtml(), 
        ];
    }

    protected function filters(): array {
        return [
            SelectFilter::make(__('Loại'), 'breed_id')
                ->options(
                    Breed::query()->pluck('breed_name', 'breed_id')->toArray()
                ),
            SelectFilter::make(__('Màu chủ đạo'), 'primary_color_id')
                ->options(
                    PrimaryColor::query()->pluck('primary_color_name', 'primary_color_id')->toArray()
                ),
            SelectFilter::make(__('Tuổi'), 'age_id')
                ->options(
                    Age::query()->pluck('description', 'age_id')->toArray()
                ),
            SelectFilter::make(__('Kích thước'), 'size_id')
                ->options(
                    Size::query()->pluck('description', 'size_id')->toArray()
                ),
            SelectFilter::make(__('Giới tính'), 'gender')
                ->options([
                    '1' => 'Giống đực',
                    '0' => 'Giống cái',
                ]),

            DateFilter::make(__('Ngày nhận'), 'created_at'),
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
                $fileName = 'danhsachthucung'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachthucung'.now().'.xlsx';
                return $exportData($fileName, Pet::all());
            })->standalone(),
        ];
    }
}


// namespace App\Livewire;

// use Illuminate\Database\Eloquent\Model;
// use RamonRietdijk\LivewireTables\Actions\Action;
// use RamonRietdijk\LivewireTables\Columns\Column;
// use RamonRietdijk\LivewireTables\Columns\DateColumn;
// use RamonRietdijk\LivewireTables\Columns\ImageColumn;
// use RamonRietdijk\LivewireTables\Columns\SelectColumn;
// use RamonRietdijk\LivewireTables\Filters\DateFilter;
// use RamonRietdijk\LivewireTables\Filters\SelectFilter;
// use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
// use App\Helpers\ExcelHelpers;
// use App\Models\UserType;
// use App\Models\User;
// use App\Models\Province;
// use App\Models\District;
// use App\Models\Ward;

// class UserTable extends LivewireTable
// {
//     protected string $model = User::class;
//     protected bool $deferLoading = true;
//     protected bool $useSelection = false;

//     protected function columns(): array {
//         return [
//             ImageColumn::make(__('Ảnh đại diện'), 'avatar'),
//             Column::make(__('ID'), 'id')
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Họ'), 'first_name')
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Tên'), 'last_name')
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Email'), 'email')
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Số điện thoại'), 'phone_number')
//                 ->sortable()
//                 ->searchable(),
//             SelectColumn::make(__('Quyền'), 'user_type_id')
//                 ->options(
//                     UserType::query()->pluck('user_type_name', 'user_type_id')->toArray()
//                 )
//                 ->displayUsing(function ($value) {
//                     $userType = UserType::find($value);
//                     return $userType ? $userType->user_type_name : '';
//                 })
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Tỉnh/Thành Phố'), 'userAddress.district.province.name')
//                 ->qualifyUsingAlias()
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Quận/Huyện'), 'userAddress.district.name')
//                 ->qualifyUsingAlias()
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Phường/Xã'), 'userAddress.name')
//                 ->qualifyUsingAlias()
//                 ->sortable()
//                 ->searchable(),
//             Column::make(__('Chi tiết địa chỉ'), 'address_description')
//                 ->sortable()
//                 ->searchable(),
//             DateColumn::make(__('Ngày tạo'), 'created_at')
//                 ->sortable()->searchable()
//                 ->format('d/m/Y'),
//             DateColumn::make(__('Ngày xác nhận email'), 'email_verified_at')
//                 ->sortable()->searchable()
//                 ->format('d/m/Y'),
//             DateColumn::make(__('Ngày đăng nhập gần nhất'), 'login_at')
//                 ->sortable()->searchable()
//                 ->format('d/m/Y'),
//             Column::make(__('Tùy chọn'), function (Model $model): string {
//                 $editUrl = '';
//                 $deleteUrl = '';
            
//                 return '<ul class="flex flex-wrap gap-3 items-center justify-center text-gray-900 dark:text-white">
//                 <li>
//                     <button> 
//                         <svg  data-target="'.$model->getKey().'" class="btnDelete text-red-600 w-[20px] h-[20px]  dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
//                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
//                         </svg> 
//                     </button>
//                 </li>
//             </ul>';
//             })->clickable(false)->asHtml(),   
//         ];
//     }

//     protected function filters(): array {
//         $filters = [
//             SelectFilter::make(__('Tỉnh/Thành Phố'), 'userAddress.district.province.id')
//                 ->options(
//                     Province::pluck('name', 'id')->toArray()
//                 ),
//             SelectFilter::make(__('Quận/Huyện'), 'userAddress.district.id')
//                 ->options([]),
//             SelectFilter::make(__('Phường/Xã'), 'userAddress.id')
//                 ->options([]),
//             DateFilter::make(__('Ngày xác nhận email'), 'email_verified_at'),
//             DateFilter::make(__('Ngày tạo'), 'created_at'),
//         ];

//         if (isset($this->filters['userAddress_district_province_id'])) {
//             $provinceId = $this->filters['userAddress_district_province_id'];
//             $filters[1]->options(District::where('province_id', $provinceId)->pluck('name', 'id')->toArray());
//         }

//         if (isset($this->filters['userAddress_district_id'])) {
//             $districtId = $this->filters['userAddress_district_id'];
//             if ($districtId !== null) {
//                 $filters[2]->options(Ward::where('district_id', $districtId)->pluck('name', 'id')->toArray());
//             }
//         }

//         return $filters;
//     }

//     protected function actions(): array {
//         return [
//             Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function (): mixed {
//                 $headings = collect($this->columns())->filter(function ($column) {
//                     return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
//                 })->map(function ($column) {
//                     return $column->label();
//                 })->toArray();                

//                 $fileName = 'danhsachnguoidung'.now().'.xlsx';
//                 $pets = $this->appliedQuery()->with('userAddress.district.province')->get();
//                 $data = $pets->map(function ($user) {
//                     $address = $user->userAddress;
//                     $provinceName = null;
//                     $districtName = null;
        
//                     if ($address) {
//                         $district = $address->district;
//                         if ($district) {
//                             $districtName = $district->name;
//                             $province = $district->province;
//                             if ($province) {
//                                 $provinceName = $province->name;
//                             }
//                         }
//                     }
            
//                     return [
//                         'ID' => $user->id,
//                         'Họ' => $user->first_name,
//                         'Tên' => $user->last_name,
//                         'Email' => $user->email,
//                         'Số điện thoại' => $user->phone_number,
//                         'Quyền' => $user->userType->user_type_name,
//                         'Tỉnh/Thành phố' => $provinceName,
//                         'Huyện/Quận' => $districtName,
//                         'Phường/Xã' => $user->userAddress->name,
//                         'Tên đường/Số nhà' => $user->address_description,
//                         'Ngày tạo tài khoản' => $user->created_at,
//                         'Ngày xác nhận email' => $user->email_verified_at,
//                         'Ngày đăng nhập gần nhất' => $user->login_at
//                     ];
//                 })->toArray();
        
//                 return ExcelHelpers::exportToExcel($headings, $data, $fileName);
//             })->standalone(),

//             Action::make(__('Xuất tất cả'), 'export_all', function (): mixed {
//                 $headings = collect($this->columns())->filter(function ($column) {
//                     return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
//                 })->map(function ($column) {
//                     return $column->label();
//                 })->toArray();                

//                 $fileName = 'danhsachnguoidung'.now().'.xlsx';
//                 $pets = User::with('userAddress.district.province')->get();
//                 $data = $pets->map(function ($user) {
//                     $address = $user->userAddress;
//                     $provinceName = null;
//                     $districtName = null;
        
//                     if ($address) {
//                         $district = $address->district;
//                         if ($district) {
//                             $districtName = $district->name;
//                             $province = $district->province;
//                             if ($province) {
//                                 $provinceName = $province->name;
//                             }
//                         }
//                     }
            
//                     return [
//                         'ID' => $user->id,
//                         'Họ' => $user->first_name,
//                         'Tên' => $user->last_name,
//                         'Email' => $user->email,
//                         'Số điện thoại' => $user->phone_number,
//                         'Quyền' => $user->userType->user_type_name,
//                         'Tỉnh/Thành phố' => $provinceName,
//                         'Huyện/Quận' => $districtName,
//                         'Phường/Xã' => $user->userAddress->name,
//                         'Tên đường/Số nhà' => $user->address_description,
//                         'Ngày tạo tài khoản' => $user->created_at,
//                         'Ngày xác nhận email' => $user->email_verified_at,
//                         'Ngày đăng nhập gần nhất' => $user->login_at
//                     ];
//                 })->toArray();
        
//                 return ExcelHelpers::exportToExcel($headings, $data, $fileName);  
//             })->standalone(),
//         ];
//     }
// }

