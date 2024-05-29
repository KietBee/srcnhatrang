<?php

namespace App\Http\Controllers\Admin;
use App\Models\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index() {
        return view('page.admin.feedback.index');
    }

    public function sendResponse(Request $request, $id) {
        $feedback = Feedback::findOrFail($id);
        return view('page.admin.feedback.send-response', compact('feedback'));
    }

    public function update(Request $request, $id) {
        try {
            $feedback = Feedback::findOrFail($id);
    
            $feedback->question = $request->question;
            $feedback->answer = $request->answer;
    
            $feedback->save();
    
            return redirect()->back()->with('success', 'Q&A đã được cập nhật thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật Q&A. Vui lòng thử lại sau.');
        }
    }    

    public function destroy($id) {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
