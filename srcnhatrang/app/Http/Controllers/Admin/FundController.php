<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Fund;
use Illuminate\Support\Facades\Auth;

class FundController extends Controller
{
    public function index() {
        return view('page.admin.fund.index');
    }

    public function create(Request $request) { 
        $currentDateTime = Carbon::now()->format('Hisdm');
        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $request->file('feature_image')->storeAs('public/images/app/upload', $filename);
        } else {
            $filename = 'default.jpg';
        }
        $fund = Fund::create([
            'fund_id' => 'CG'. $currentDateTime,
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
            'feature_image' => $filename,
            'current_balance' => 0
        ]);
    
        if ($fund->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Dữ liệu mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo dữ liệu mới!');
        }
    }
}
