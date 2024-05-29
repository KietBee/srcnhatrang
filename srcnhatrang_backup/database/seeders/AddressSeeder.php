<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ImportAddress;

class AddressSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/address-excel/vnzone.xls');
        Excel::import(new ImportAddress, $path);
    }
}
