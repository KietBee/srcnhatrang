<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function getAllPet(Request $request) {
        $listPet = (new Pet())->getAllDataPet($request->input('paginate', 8));
        return view('admin.page.pet', compact('listPet'));
    }

    public function getDetailPet(Request $request, $id) {
        $pet = Pet::findOrFail($id);
        return view('admin.page.pet', compact('pet'));
    }
}
