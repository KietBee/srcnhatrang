<?php

namespace App\Livewire;

use App\Models\Pet;
use App\Models\PetImage;
use Illuminate\Database\Eloquent\Model;
use RamonRietdijk\LivewireTables\Columns\Column;
use RamonRietdijk\LivewireTables\Columns\DateColumn;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;
use RamonRietdijk\LivewireTables\Columns\ImageColumn;
use RamonRietdijk\LivewireTables\Columns\SelectColumn;

class PetImageTable extends LivewireTable
{

    protected string $model = PetImage::class;
    protected bool $deferLoading = true;
    protected bool $useSelection = false;
    protected function columns(): array
    {
        return [
            ImageColumn::make(__('Ảnh thú cưng'), 'pet_image')
            ->displayUsing(function ($avatar) {
                if ($avatar && file_exists(public_path('storage/images/app/upload/' . $avatar))) {
                    $image = asset('storage/images/app/upload/' . $avatar);
                } else {
                    $image = asset('storage/images/default.jpg');
                };
                return $image;
            }),
            Column::make(__('ID'), 'pet_image_id')
                ->sortable()
                ->searchable(),
            SelectColumn::make(__('Tên thú cưng'), 'pet_id')
                ->options(
                    Pet::query()->pluck('pet_name', 'pet_id')->toArray()
                )
                ->displayUsing(function ($value) {
                    $pet = Pet::find($value);
                    return $pet ? $pet->pet_name : '';
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
}
