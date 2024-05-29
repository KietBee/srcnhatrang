<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbacksController extends Controller
{
    public function index()
    {
        return view('page.app.feedbacks.feedbacks');
    }

    public function create(Request $request)
    {
        $currentDateTime = Carbon::now()->format('Hisdm');

        $feedbacks = Feedback::create([
            'feedback_id' => 'FB' . $currentDateTime,
            'sender' => Auth::user()->id,
            'content' => $request->content,
        ]);

        if ($feedbacks->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Gửi phản hồi thành công!');
        } else {
            return redirect()->back()->with('error', 'Phản hồi chưa được gửi! Vui lòng thử lại!');
        }
    }
}
