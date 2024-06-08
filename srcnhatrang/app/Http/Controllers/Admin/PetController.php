<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\PrimaryColor;
use App\Models\Breed;
use App\Models\Age;
use App\Models\Size;
use App\Models\PetImage;
use Illuminate\Support\Carbon;

class PetController extends Controller
{
    public function index()
    {
        return view('page.admin.pet.index');
    }

    public function edit(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        return view('page.admin.pet.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->primary_color_id = $request->primary_color_id;
            $pet->age_id = $request->age_id;
            $pet->size_id = $request->size_id;
            $pet->breed_id = $request->breed_id;
            $pet->pet_name = $request->pet_name;
            $pet->gender = $request->gender;
            $pet->description = $request->description;
            $pet->health_status = $request->health_status;

            $pet->save();

            return redirect()->back()->with('success', 'Thông tin thú cưng đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật thông tin thú cưng. Vui lòng thử lại sau.');
        }
    }


    public function create(Request $request)
    {
        $currentDateTime = Carbon::now()->format('Hisdm');

        $request->validate([
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
        ], [
            'files.*.file' => 'Tệp tin không hợp lệ.',
            'files.*.mimes' => 'Chỉ chấp nhận các tệp có định dạng jpg, jpeg, png, pdf, docx.',
            'files.*.max' => 'Kích thước tệp tin tối đa là 2048KB.',
        ]);

        $pet = Pet::create([
            'pet_id' => 'PE' . $currentDateTime,
            'primary_color_id' => $request->primary_color_id,
            'age_id' => $request->age_id,
            'size_id' => $request->size_id,
            'breed_id' => $request->breed_id,
            'pet_name' => $request->pet_name,
            'gender' => $request->gender,
            'description' => $request->description,
            'health_status' => $request->health_status,
            'rescued_at' => now(),
        ]);

        if ($pet->wasRecentlyCreated) {
            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . uniqid() . '.' . $extension;
                    $file->storeAs('public/images/app/upload', $filename);

                    PetImage::create([
                        'pet_id' => $pet->pet_id,
                        'pet_image' => $filename,
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Thú cưng mới đã được thêm thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi thêm thú cưng mới!');
        }
    }


    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
