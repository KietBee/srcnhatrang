<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\StoryCategory;

class StoryController extends Controller
{
    public function index() {
        return view('page.admin.story.index');
    }

    public function edit(Request $request, $id) {
        $story = Story::findOrFail($id);
        return view('page.admin.story.edit', compact('story'));
    }

    public function refuseView() {
        return view('page.admin.story.refuse');
    }

    public function update(Request $request, $id) {
        try {
            $petAdoptionRequest = Story::findOrFail($id);
            $petAdoptionRequest->is_approved = true;
            $petAdoptionRequest->approver_id = Auth::user()->id;
            $petAdoptionRequest->approved_at = now();
    
            $petAdoptionRequest->save();
            return redirect()->route('admin.story')->with('success', 'Bài viết đã được xác nhận thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi kiểm duyệt bài viết. Vui lòng thử lại sau!');
        }
    }

    public function create(Request $request)
    {
        if ($request->hasFile('featureImage')) {
            $file = $request->file('featureImage');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $request->file('featureImage')->storeAs('public/images/app/upload', $filename);
        } else {
            $filename = 'default.jpg';
        }

        $currentDateTime = Carbon::now()->format('Hisdm');

        $story = Story::create([
            'story_id' => 'ST' . $currentDateTime,
            'title' => $request->title,
            'content' => $request->content,
            'feature_image_url' => $request->filename,
            'author_id' => Auth::user()->id,
            'is_approved' => true,
            'approved_at' => now(),
            'approver_id' => Auth::user()->id,
        ]);

        StoryCategory::create([
            'story_id' => $story->story_id,
            'category_id' => Category::first()->category_id,
        ]);        

        if ($story->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Tin tức đã được đăng thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo tin tức!');
        }
    }
    
    public function refuse(Request $request, $id) {
        try {
            $story = Story::findOrFail($id);
            $story->delete();
    
            return redirect()->route('admin.story')->with('success', 'Bài viết đã được xóa bỏ');
        } catch (\Exception) {
            return redirect()->route('admin.story.edit', ['id' => $id])->with('error', 'Đã xảy ra lỗi khi xóa bỏ bài viết! Vui lòng thử lại sau!');
        }
    }   

    public function destroy($id) {
        $story = Story::findOrFail($id);
        $story->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
