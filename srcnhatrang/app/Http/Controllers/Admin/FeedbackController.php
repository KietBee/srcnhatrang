<?php

namespace App\Http\Controllers\Admin;
use App\Models\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;

class FeedbackController extends Controller
{
    public function index() {
        return view('page.admin.feedback.index');
    }

    public function sendResponse(Request $request, $id) {
        $feedback = Feedback::findOrFail($id);
        return view('page.admin.feedback.send-response', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->is_responded = true;
            $feedback->responder = Auth::user()->id;
            $feedback->response = $request->response;
            $feedback->responded_at = now();
            $feedback->save();

            $title = 'SRC Nha Trang - Ý kiến của bạn là động lực của chúng tôi';
            $content = $feedback->response;
            $view = 'email.feedback';

            Mail::to($feedback->senderUser->email)->send(new NotifyMail($title, $content, $view));

            return redirect()->route('admin.feedback')->with('success', 'Mail đã được gửi thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi gửi mail phản hồi. Vui lòng thử lại sau.');
        }
    }

    public function destroy($id) {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
