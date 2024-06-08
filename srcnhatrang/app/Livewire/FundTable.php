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
use App\Models\Fund;

class FundTable extends LivewireTable
{
    protected string $model = Fund::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;
    protected function columns(): array
    {
        return [
            ImageColumn::make(__('Ảnh'), 'feature_image')
            ->displayUsing(function ($avatar) {
                if ($avatar && file_exists(public_path('storage/images/app/upload/' . $avatar))) {
                    $image = asset('storage/images/app/upload/' . $avatar);
                } else {
                    $image = asset('storage/images/default.jpg');
                };
                return $image;
            }),
            Column::make(__('ID'), 'fund_id')
                ->sortable()
                ->searchable(),
            Column::make(__('Tên quỹ'), 'title')
                ->sortable()
                ->searchable(),
            Column::make(__('Mô tả'), 'description')
                ->sortable()
                ->searchable(),
            Column::make(__('Số tiền hiện tại'), 'current_balance')
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
        ];
    }

    protected function prepareExportData($funds) {
        return $funds->map(function ($fund) {
            return [
                'ID' => $fund->fund_id,
                'Tên quỹ' => $fund->title,
                'Mô tả' => $fund->description,
                'Số tiền hiện tại' => $fund->current_balance,
                'Ngày tạo' => $fund->created_at,
                'Ngày cập nhật gần nhất' => $fund->updated_at,
            ];
        })->toArray();
    }

    protected function actions(): array {
        $exportData = function ($fileName, $funds) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareExportData($funds);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachquy'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachquy'.now().'.xlsx';
                return $exportData($fileName, Fund::all());
            })->standalone(),
        ];
    }
}
