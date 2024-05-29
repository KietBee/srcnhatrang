<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\PetAdoption;
use App\Models\PetAdoptionRequest;
use App\Models\PetImage;

class PetAdoptionController extends Controller
{
    public function index()
    {
        $petAdoption = PetAdoption::where('adopted', false)->orderBy('created_at', 'asc')->get();
        $listPetAdoptions = [];
        $postPetAdoption = [];

        foreach ($petAdoption as $item) {
            $postPetAdoption[] = [
                'title' => 'Xin chào! Con tên là ' . $item->pet['pet_name'],
                'description' => $item['description'],
                'date' => $item->created_at,
                'image' => [
                    'url' => $item['image_feature'],
                    'alt' => 'hình thú cưng',
                ],
                'link' => [
                    'url' => '#',
                    'title' => 'Nhận nuôi thú cưng',
                ],
                'linkAll' => [
                    'url' => '#',
                    'title' => 'Xem tất cả thú cưng',
                ],
            ];
        }
        $listPetAdoptions['postStories'] = $postPetAdoption;
        $listPetAdoptions['headline'] = 'Tin tức và bài viết mới nhất';
        $listPetAdoptions['linkAll'] = [
            'url' => '#',
            'title' => 'Xem tất cả tin tức và bài viết',
        ];

        return view('page.app.pet-adoptions.pet-adoptions', compact('listPetAdoptions'));
    }

    public function details(Request $request, $id)
    {
        $petAdoption = PetAdoption::findOrFail($id);

        $listImage = PetImage::where('pet_id', $petAdoption->pet_id)->get();
    
        $relatedPetAdoptions = PetAdoption::where('pet_adoption_id', '!=', $id)
            ->where('adopted', false)
            ->limit(4)
            ->get();
        return view('page.app.pet-adoptions.pet-adoptions-detail', compact('petAdoption', 'listImage', 'relatedPetAdoptions'));
    }
    
    public function requests(Request $request, $id)
    {
        if (Auth::check()) {
            $petAdoption = PetAdoption::findOrFail($id);
            return view('page.app.pet-adoptions.pet-adoptions-requests', compact('petAdoption'));
        } else {
            return redirect()->route('login');
        }
    }

    public function createRequests(Request $request)
    {

        $currentDateTime = Carbon::now()->format('Hisdm');

        $story = PetAdoptionRequest::create([
            'story_id' => 'ST' . $currentDateTime,
            'title' => $request->title,
            'content' => $request->content,
            'feature_image_url' => $request->filename,
            'author_id' => Auth::user()->id,

            'pet_adoption_request_id' => 'PAR' . $currentDateTime,
            'pet_adoption_id' => $request->petAdoptionID,
            'requester_id' => Auth::user()->id,
            'reason_for_adoption' => $request->reasonForAdoption,
            'notes' => $request->notes
        ]);

       
        if ($story->wasRecentlyCreated) {
            return redirect()->route('pet-adoptions')->with('success', 'Yêu cầu đang đợi kiểm duyệt!');
        } else {
            return redirect()->route('pet-adoptions')->with('error', 'Đã có lỗi xảy ra khi tạo yêu cầu!');
        }
    }
}
