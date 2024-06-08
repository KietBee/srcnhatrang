<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PetImage;

class PetImageController extends Controller
{
    public function index() {
        return view('page.admin.pet-image.index');
    }

    public function create(Request $request) { 
        if ($request->hasFile('pet_image')) {
            $file = $request->file('pet_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $request->file('pet_image')->storeAs('public/images/app/upload', $filename);
        } else {
            $filename = 'default.jpg';
        }
        $currentDateTime = Carbon::now()->format('Hisdm');
        $petImage = PetImage::create([
            'pet_image_id' => 'PI'. $currentDateTime,
            'pet_id' => $request->pet_id,
            'pet_image' => $filename,
        ]);
    
        if ($petImage->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }

    public function destroy($id) {
        $petImage = PetImage::findOrFail($id);
        $petImage->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
