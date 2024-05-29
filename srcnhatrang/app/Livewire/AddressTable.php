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

class AddressTable extends LivewireTable
{
    protected string $model = Ward::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;

    protected function columns(): array {
        return [
            Column::make(__('Tỉnh/Thành Phố'), 'district.province.name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Quận/Huyện'), 'district.name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            Column::make(__('Phường/Xã'), 'name')
                ->qualifyUsingAlias()
                ->sortable()
                ->searchable(),
            DateColumn::make(__('Ngày tạo'), 'created_at')
                ->sortable()->searchable()
                ->format('H:i:s d/m/Y'),
            DateColumn::make(__('Ngày cập nhật gần nhất'), 'updated_at')
                ->sortable()
                ->searchable()
                ->format('H:i:s d/m/Y')
        ];
    }

    protected function filters(): array {
        $filters = [
            SelectFilter::make(__('Tỉnh/Thành Phố'), 'district.province.id')
                ->options(
                    Province::pluck('name', 'id')->toArray()
                ),
            SelectFilter::make(__('Quận/Huyện'), 'district.id')
                ->options([]),
            SelectFilter::make(__('Phường/Xã'), 'id')
                ->options([]),
            DateFilter::make(__('Ngày tạo'), 'created_at'),
            DateFilter::make(__('Ngày cập nhật gần nhất'), 'updated_at'),
        ];
    
        if (isset($this->filters['district_province_id'])) {
            $provinceId = $this->filters['district_province_id'];
            $filters[1]->options(District::where('province_id', $provinceId)->pluck('name', 'id')->toArray());
        }
    
        if (isset($this->filters['district_id'])) {
            $districtId = $this->filters['district_id'];
            if ($districtId !== null) {
                $filters[2]->options(Ward::where('district_id', $districtId)->pluck('name', 'id')->toArray());
            }
        }
    
        return $filters;
    }    

    protected function prepareAddressData($address) {
        return $address->map(function ($ward) {
            return [
                'Tỉnh/Thành phố' => $ward->district->province->name,
                'Huyện/Quận' => $ward->district->name,
                'Phường/Xã' => $ward->name,
                'Ngày tạo' => $ward->created_at,
                'Ngày cập nhật gần nhất' => $ward->updated_at
            ];
        })->toArray();
    }

    protected function actions(): array {
        $exportData = function ($fileName, $address) {
            $headings = collect($this->columns())->filter(function ($column) {
                return !($column instanceof ImageColumn) && $column->label() !== __('Tùy chọn');
            })->map(function ($column) {
                return $column->label();
            })->toArray();

            $data = $this->prepareAddressData($address);

            return ExcelHelpers::exportToExcel($headings, $data, $fileName);
        };

        return [
            Action::make(__('Xuất kết quả tìm kiếm'), 'export_research', function () use ($exportData) {
                $fileName = 'danhsachdiachi'.now().'.xlsx';
                return $exportData($fileName, $this->appliedQuery()->get());
            })->standalone(),

            Action::make(__('Xuất tất cả'), 'export_all', function () use ($exportData) {
                $fileName = 'danhsachdiachi'.now().'.xlsx';
                return $exportData($fileName, Ward::all());
            })->standalone(),
        ];
    }

}
