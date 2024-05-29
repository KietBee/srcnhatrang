<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QA;

class QAController extends Controller
{
    public function index() {
        $listQAs = QA::all();
        return view('page.admin.QA.index', compact('listQAs'));
    }

    public function edit(Request $request, $id) {
        $QA = QA::findOrFail($id);
        return view('page.admin.QA.edit', compact('QA'));
    }

    public function create(Request $request) { 
        $QA = QA::create([
            'answer' => $request->answer,
            'question' => $request->question
        ]);
    
        if ($QA->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Q&A mới đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo Q&A mới!');
        }
    }

    public function update(Request $request, $id) {
        try {
            $QA = QA::findOrFail($id);
    
            $QA->question = $request->question;
            $QA->answer = $request->answer;
    
            $QA->save();
    
            return redirect()->back()->with('success', 'Q&A đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật Q&A. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $QA = QA::findOrFail($id);
        $QA->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
