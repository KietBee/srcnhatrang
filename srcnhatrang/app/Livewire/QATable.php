<?php

namespace App\Livewire;

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

use App\Models\QA;

class QATable extends LivewireTable
{
    protected string $model = QA::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;
    protected function columns(): array
    {
        return [
            Column::make(__('ID'), 'QA_ID')
                ->sortable()
                ->searchable(),
            Column::make(__('Câu hỏi '), 'question')
                ->sortable()
                ->searchable(),
            Column::make(__('Câu trả lời'), 'answer')
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
                $editUrl = route('admin.QA.edit', ['id' => $model->getKey()]);

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
            DateFilter::make(__('Ngày tạo'), 'created_at'),
            DateFilter::make(__('Ngày cập nhật gần nhất'), 'updated_at'),
        ];
    }

    protected function prepareExportData($QAs) {
        return $QAs->map(function ($QA) {
            return [
                'ID' => $QA->QA_ID,
                'Câu hỏi' => $QA->question,
                'Câu trả lời' => $QA->answer,
                'Ngày tạo' => $QA->created_at,
                'Ngày cập nhật gần nhất' => $QA->updated_at,
            ];
        })->toArray();
    }

    protected function actions(): array {
        $exportData = function ($fileName, $QAs) {
            $headings = collect($this->columns())->filter(function ($column) {
                return $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareExportData($QAs);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachcauhoi'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachcauhoi'.now().'.xlsx';
                return $exportData($fileName, QA::all());
            })->standalone(),
        ];
    }
}
