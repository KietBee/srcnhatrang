<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetAdoptionRequest;
use App\Models\PetAdoption;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Auth;

class PetAdoptionRequestController extends Controller
{
    public function index() {
        return view('page.admin.pet-adoption-request.index');
    }

    public function edit(Request $request, $id) {
        $pet_adoption_request = PetAdoptionRequest::findOrFail($id);
        return view('page.admin.pet-adoption-request.edit', compact('pet_adoption_request'));
    }

    public function refuseView() {
        return view('page.admin.pet-adoption-request.refuse');
    }

    public function update(Request $request, $id) {
        try {
            $petAdoptionRequest = PetAdoptionRequest::findOrFail($id);
            $email = $petAdoptionRequest->requester->email;
            $petAdoptionRequest->is_approval = true;
            $petAdoptionRequest->approver_id = Auth::user()->id;
            $petAdoptionRequest->approved_at = now();
    
            $petAdoptionRequest->save();
            $title = 'SRC Nha Trang - Phản hồi yêu cầu nhận nuôi thú cưng';
            $content = 'Yêu cầu nhận nuôi thú cưng của bạn đã được xác nhận! Vui lòng liên hệ lại với trung tâm để hoàn tất thủ tục nhận nuôi thú cưng!';
            $view = 'email.feedback';

            Mail::to($email)->send(new NotifyMail($title, $content, $view));
            return redirect()->route('admin.pet-adoption-request')->with('success', 'Yêu cầu nhận nuôi đã được xác nhận thành công!');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xác nhận yêu cầu nhận nuôi. Vui lòng thử lại sau.');
        }
    }
    
    public function refuse(Request $request, $id) {
        try {
            $petAdoptionRequest = PetAdoptionRequest::findOrFail($id);
            $email = $petAdoptionRequest->requester->email;
            $petAdoptionRequest->is_approval = true;
            $petAdoptionRequest->approver_id = Auth::user()->id;
            $petAdoptionRequest->approved_at = now();
    
            $petAdoptionRequest->save();
            $title = 'SRC Nha Trang - Phản hồi yêu cầu nhận nuôi thú cưng';
            $content = 'Yêu cầu nhận nuôi thú cưng của bạn đã bị từ chối! Bạn có thể tìm kiếm thêm thú cưng nhận nuôi tại <a href="'.route('pet-adoptions').'" >đây</a>.';
            $view = 'email.feedback';

            Mail::to($email)->send(new NotifyMail($title, $content, $view));
    
            return redirect()->route('admin.pet-adoption-request')->with('success', 'Yêu cầu nhận nuôi đã bị từ chối! Mail phản hồi sẽ được gửi sau vài giây!');
        } catch (\Exception) {
            return redirect()->route('admin.pet-adoption-request.edit', ['id' => $id])->with('error', 'Đã xảy ra lỗi khi hủy yêu cầu nhận nuôi. Vui lòng thử lại sau.');
        }
    }   

    public function destroy($id) {
        $petAdoptionRequest = PetAdoptionRequest::findOrFail($id);
        $petAdoptionRequest->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
