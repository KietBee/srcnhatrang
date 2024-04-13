<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specie;

class SpecieController extends Controller
{
    public function getAllSpecie(Request $request) {
        $orderBy = $request->input('orderBy', 'specie_name');
        $orderDirection = $request->input('orderDirection', 'asc');
    
        $listSpecie = Specie::getAllDataSpecie($request->input('paginate', 8));
    
        if ($orderDirection === 'asc') {
            $listSpecie = $listSpecie->sortBy($orderBy);
        } else {
            $listSpecie = $listSpecie->sortByDesc($orderBy);
        }
    
        return view('admin.page.specie', compact('listSpecie'));
    }
    
}
