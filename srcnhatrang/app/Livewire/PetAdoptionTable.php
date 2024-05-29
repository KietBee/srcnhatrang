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
use App\Models\PetAdoption;
use App\Models\Pet;
use App\Models\PetImage;

class PetAdoptionTable extends LivewireTable
{
    protected string $model = PetAdoption::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;

    protected function columns(): array {
        return [
            ImageColumn::make(__('Ảnh'), 'image_feature')
            ->displayUsing(function ($imageFeature) {
                $defaultImagePath = asset('images/pet.jpg');
                $imagePath = asset('images/'.$imageFeature);
                if ($imageFeature && file_exists($imagePath)) {
                    return $imagePath;
                } else {
                    return $defaultImagePath;
                }
            }),
            Column::make(__('ID'), 'pet_adoption_id')
                ->sortable()
                ->searchable(),
            Column::make(__('Tên thú cưng'), 'pet.pet_name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Tiêu đề'), 'title')
                ->sortable()
                ->searchable(),
            Column::make(__('Nội dung'), 'description')
                ->sortable()
                ->searchable(),
            Column::make(__('Người tạo'), 'createdBy.email')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Tình trạng nhận nuôi'), 'adopted')
                ->options([
                    '1' => 'Đã được nhận nuôi',
                    '0' => 'Chưa được nhận nuôi',
                ])
                ->displayUsing(function ($value) {
                    return $value ? 'Đã được nhận nuôi' : 'Chưa được nhận nuôi';
                })
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày tạo'), 'created_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày cập nhật gần nhất'), 'updated_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            Column::make(__('Tùy chọn'), function (Model $model): string {
                $editUrl = route('admin.pet-adoption.update', ['id' => $model->getKey()]);

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
            SelectFilter::make(__('Tình trạng nhận nuôi'), 'adopted')
                ->options([
                    '1' => 'Đã được nhận nuôi',
                    '0' => 'Chưa được nhận nuôi',
                ]),
            DateFilter::make(__('Ngày tạo'), 'created_at'),
            DateFilter::make(__('Ngày cập nhật gần nhất'), 'updated_at'),
        ];
    }

    protected function prepareExportData($petAdoptions) {
        return $petAdoptions->map(function ($petAdoption) {
            $petName = $petAdoption->pet ? $petAdoption->pet->pet_name : null;
            $createdByUserName = $petAdoption->createdBy ? $petAdoption->createdBy->email : null;
    
            return [
                'ID' => $petAdoption->pet_adoption_id,
                'Tên thú cưng' => $petName,
                'Tiêu đề' => $petAdoption->title,
                'Nội dung' => $petAdoption->description,
                'Người tạo' => $createdByUserName,
                'Ngày tạo' => $petAdoption->created_at,
                'Ngày cập nhật gần nhất' => $petAdoption->updated_at,
            ];
        })->toArray();
    }
    

    protected function actions(): array {
        $exportData = function ($fileName, $petAdoptions) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareExportData($petAdoptions);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachthucungnhannuoi'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachthucungnhannuoi'.now().'.xlsx';
                return $exportData($fileName, PetAdoption::all());
            })->standalone(),
        ];
    }
}
