<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specie;
use Illuminate\Support\Carbon;

class SpecieController extends Controller
{
    public function index() {
        return view('page.admin.specie.index');
    }

    public function edit(Request $request, $id) {
        $specie = Specie::findOrFail($id);
        return view('page.admin.specie.edit', compact('specie'));
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        $specie = Specie::create([
            'specie_id' => 'SP'. $currentDateTime,
            'specie_name' => $request->specie_name,
        ]);
    
        if ($specie->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $specie = Specie::findOrFail($id);
    
            $specie->specie_name =  $request->specie_name;
    
            $specie->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $specie = Specie::findOrFail($id);
        $specie->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
