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
use App\Models\Expense;
use App\Models\Fund;

class ExpenseTable extends LivewireTable
{
    protected string $model = Expense::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;
    protected function columns(): array
    {
        return [
            Column::make(__('ID'), 'expense_id')
                ->sortable()
                ->searchable(),
            Column::make(__('Người chi tiêu'), 'approver.email')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Quỹ chi tiêu'), 'fund.title')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Giá tiền chi tiêu (VNĐ)'), 'amount')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Nội dung chi tiêu'), 'description')
                ->sortable()
                ->searchable(),       
            DateColumn::make(__('Ngày chi tiêu'), 'created_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày cập nhật gần nhất'), 'updated_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y'),
        ];
    }

    protected function filters(): array {
        return [
            SelectFilter::make(__('Quỹ chi tiêu'), 'fund_id')
                ->options(
                    Fund::query()->pluck('title', 'fund_id')->toArray()
                ),
            DateFilter::make(__('Ngày chi tiêu'), 'created_at'),
        ];
    }

    protected function prepareExportData($expenses) {
        return $expenses->map(function ($expense) {
            return [
                'ID' => $expense->expense_id,
                'Người chi tiêu' => $expense->approver->email,
                'Quỹ chi tiêu' => $expense->fund->title,
                'Giá tiền chi tiêu (VNĐ)' => $expense->amount,
                'Nội dung chi tiêu' => $expense->	description,
                'Ngày chi tiêu' => $expense->created_at,
                'Ngày cập nhật gần nhất' => $expense->updated_at,
            ];
        })->toArray();
    }

    protected function actions(): array {
        $exportData = function ($fileName, $expenses) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareExportData($expenses);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachchitieu'.now().'.xlsx';
                dd($this->appliedQuery()->where('pet_adoption_request_id', '72e72e03')->get());
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachchitieu'.now().'.xlsx';
                return $exportData($fileName, Expense::all());
            })->standalone(),
        ];
    }
}