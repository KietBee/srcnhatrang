<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ImportAddress;

class ExcelImportAddress extends Controller
{
    public function showForm()
    {
        return view('import-form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);

        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            $filename = 'vnzone.xls';
            $file->storeAs('address-excel', $filename);
            $path = storage_path('app/address-excel/' . $filename);

            Excel::import(new ImportAddress, $path);
        }

        return redirect()->back()->with('success', 'Dữ liệu đã được nhập thành công!');
    }
}
