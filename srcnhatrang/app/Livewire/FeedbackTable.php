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
use App\Models\Feedback;

class FeedbackTable extends LivewireTable
{
    protected string $model = Feedback::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;

    protected function columns(): array {
        return [
            Column::make(__('ID'), 'feedback_id')
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Tình trạng phản hồi'), 'is_responded')
                ->options([
                    '1' => 'Đã phản hồi',
                    '0' => 'Chưa phản hồi',
                ])
                ->displayUsing(function ($value, $model) {
                    return $value ? '<a class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">&nbsp;&nbsp;Đã phản hồi&nbsp;&nbsp;</a>' : 
                    '<a href="'.route('admin.feedback.sendResponse', ['id' => $model->getKey()]).'" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Chưa phản hồi</a>';
                })                
                ->sortable()
                ->searchable()
                ->asHtml(),
            Column::make(__('Người gửi'), 'senderUser.email')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Nội dung gửi'), 'content')
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày gửi'), 'created_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            Column::make(__('Người phản hồi'), 'responderUser.email')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Nội dung phản hồi'), 'response')
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày phản hồi'), 'responded_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày cập nhật gần nhất'), 'updated_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            Column::make(__('Tùy chọn'), function (Model $model): string {
                $editUrl = route('admin.feedback.sendResponse', ['id' => $model->getKey()]);
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
            SelectFilter::make(__('Tình trạng phản hồi'), 'is_responded')
            ->options([
                '1' => 'Đã phản hồi',
                '0' => 'Chưa phản hồi',
            ]),
            DateFilter::make(__('Ngày gửi'), 'created_at'),
            DateFilter::make(__('Ngày phản hồi'), 'responded_at'),
            DateFilter::make(__('Ngày cập nhật gần nhất'), 'updated_at'),
        ];
    }

    protected function prepareExportData($feedbacks) {
        return $feedbacks->map(function ($feedback) {
            return [
                'ID' => $feedback->feedback_id,
                'Tình trạng phản hồi' => $feedback->is_responded ? 'Đã phản hồi' : 'Chưa phản hồi',
                'Người gửi' => $feedback->sender,
                'Nội dung gửi' => $feedback->content,
                'Ngày gửi' => $feedback->created_at,
                'Người phản hồi' => $feedback->responder,
                'Nội dung phản hồi' => $feedback->response,
                'Ngày phản hồi' => $feedback->responded_at,
                'Ngày cập nhật gần nhất' => $feedback->updated_at,
            ];
        })->toArray();
    }
    

    protected function actions(): array {
        $exportData = function ($fileName, $feedbacks) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareExportData($feedbacks);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachphanhoi'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachphanhoi'.now().'.xlsx';
                return $exportData($fileName, Feedback::all());
            })->standalone(),
        ];
    }
}
