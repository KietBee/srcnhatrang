<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Story;
use App\Models\StoryCategory;

class StoryController extends Controller
{
    public function index()
    {
        return view('page.app.new-and-post.new-and-post');
    }

    public function details(Request $request, $id)
    {
        $story = Story::findOrFail($id);
        $categories = $story->storyCategories->pluck('category_id')->toArray();
        $listCategories = $story->storyCategories->pluck('category.category_name')->toArray();

        $relatedStories = Story::whereHas('storyCategories', function ($query) use ($categories) {
            $query->whereIn('category_id', $categories);
        })->where('story_id', '!=', $story->story_id)
            ->limit(4)
            ->get();
        return view('page.app.new-and-post.new-and-post-detail', compact('story', 'listCategories', 'relatedStories'));
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
        ]);

        if (!empty($request->category)) {
            foreach ($request->category as $category) {
                StoryCategory::create([
                    'story_id' => $story->story_id,
                    'category_id' => $category,
                ]);
            }
        }

        if ($story->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Bài viết đang đợi kiểm duyệt!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo bài viết!');
        }
    }
}
