<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;
use App\Models\PetAdoption;

class PetAdoptionController extends Controller
{
    public function index() {
        $listPets = Pet::all();
        return view('page.admin.pet-adoption.index', compact('listPets'));
    }

    public function edit(Request $request, $id) {
        $pet_adoption = PetAdoption::findOrFail($id);
        return view('page.admin.pet-adoption.edit', compact('pet_adoption'));
    }

    public function create(Request $request) { 
        $petAdoption = PetAdoption::create([
            'pet_adoption_id'=> 'ID'. now(),
            'pet_id' => $request->pet,
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
        ]);
    
        if ($petAdoption->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Bài viết nhận nuôi mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo bài viết nhận nuôi mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $petAdoption = PetAdoption::findOrFail($id);
    
            $petAdoption->title = $request->title;
            $petAdoption->description = $request->description;
            $petAdoption->created_by = Auth::user()->id;
    
            $petAdoption->save();
    
            return redirect()->back()->with('success', 'Bài viết nhận nuôi đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật bài viết nhận nuôi. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $petAdoption = PetAdoption::findOrFail($id);
        $petAdoption->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
