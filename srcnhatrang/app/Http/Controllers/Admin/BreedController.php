<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BreedController extends Controller
{
    public function index() {
        return view('page.admin.breed.index');
    }

    public function edit(Request $request, $id) {
        $breed = Breed::findOrFail($id);
        return view('page.admin.breed.edit', compact('breed'));
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        $breed = Breed::create([
            'breed_id' => 'BR'. $currentDateTime,
            'specie_id' => $request->specie_id,
            'breed_name' => $request->breed_name,
        ]);
    
        if ($breed->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $breed = Breed::findOrFail($id);
    
            $breed->breed_name =  $request->breed_name;
    
            $breed->save();
    
            return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $breed = Breed::findOrFail($id);
        $breed->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
