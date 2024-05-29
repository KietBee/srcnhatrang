<?php

namespace App\Livewire;

use App\Models\Breed;
use App\Models\Pet;
use App\Models\PetImage;
use App\Models\Size;
use App\Models\Age;
use App\Models\PrimaryColor;
use App\Models\PetAdoptionRequest;

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

class PetAdoptionRequestTable extends LivewireTable
{
    protected string $model = PetAdoptionRequest::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;
    protected function columns(): array
    {
        return [
            Column::make(__('ID'), 'pet_adoption_request_id')
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Trạng thái kiểm duyệt'), 'is_approval')
                ->options([
                    '1' => 'Đã duyệt',
                    '0' => 'Chờ duyệt',
                ])
                ->displayUsing(function ($value, $model) {
                    return $value ? '<a class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">&nbsp;Đã kiểm duyệt&nbsp;</a>' : 
                    '<a href="'.route('admin.pet-adoption.update', ['id' => $model->getKey()]).'" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Chờ kiểm duyệt</a>';
                })                
                ->sortable()
                ->searchable()
                ->asHtml(),   
            Column::make(__('Tên thú cưng'), 'petAdoption.pet.pet_name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Người yêu cầu'), 'requester.email')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Lí do nhận nuôi'), 'reason_for_adoption')
                ->sortable()
                ->searchable(),
            Column::make(__('Ghi chú từ người yêu cầu'), 'notes')
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày yêu cầu'), 'created_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),          
            Column::make(__('Người kiểm duyệt'), 'approver.email')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày kiểm duyệt'), 'approved_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày cập nhật gần nhất'), 'updated_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            Column::make(__('Tùy chọn'), function (Model $model): string {
                return '<ul class="flex flex-wrap gap-3 items-center justify-center text-gray-900 dark:text-white">
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
            SelectFilter::make(__('Kiểm duyệt'), 'is_approval')
                ->options([
                    '1' => 'Đã duyệt',
                    '0' => 'Chờ duyệt',
                ]),

            DateFilter::make(__('Ngày yêu cầu'), 'created_at'),
            DateFilter::make(__('Ngày kiểm duyệt'), 'approved_at'),
            DateFilter::make(__('Ngày cập nhật gần nhất'), 'updated_at'),
        ];
    }

    protected function prepareExportData($petAdoptionRequests) {
        return $petAdoptionRequests->map(function ($petAdoptionRequest) {
            return [
                'ID' => $petAdoptionRequest->pet_adoption_request_id,
                'Trạng thái kiểm duyệt' => $petAdoptionRequest->is_approval? 'Đã duyệt' : 'Chờ duyệt',
                'Tên thú cưng' => $petAdoptionRequest->petAdoption->pet->pet_name,
                'Người yêu cầu' => $petAdoptionRequest->requester->email,
                'Lí do nhận nuôi' => $petAdoptionRequest->reason_for_adoption,
                'Ghi chú từ người yêu cầu' => $petAdoptionRequest->notes,
                'Ngày yêu cầu' => $petAdoptionRequest->created_at,
                'Người kiểm duyệt' => $petAdoptionRequest->approver->email,
                'Ngày kiểm duyệt' => $petAdoptionRequest->approved_at,
                'Ngày cập nhật gần nhất' => $petAdoptionRequest->updated_at,
            ];
        })->toArray();
    }

    protected function actions(): array {
        $exportData = function ($fileName, $petAdoptionRequests) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareExportData($petAdoptionRequests);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachyeucaunhannuoi'.now().'.xlsx';
                dd($this->appliedQuery()->where('pet_adoption_request_id', '72e72e03')->get());
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachyeucaunhannuoi'.now().'.xlsx';
                return $exportData($fileName, PetAdoptionRequest::all());
            })->standalone(),
        ];
    }
}