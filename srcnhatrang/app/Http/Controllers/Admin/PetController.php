<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function index() {
        return view('page.admin.pet');
    }

    public function getDetailPet(Request $request, $id) {
        $pet = Pet::findOrFail($id);
        return view('admin.page.pet', compact('pet'));
    }

    public function create(Request $request) {
        // $rules = [
        //     'firstName' => 'required|string|max:255',
        //     'lastName' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users|max:255',
        //     'password' => 'required|string|min:6|confirmed',
        // ];
    
        // $messages = [
        //     'email.unique' => 'Email đã tồn tại.',
        //     'password.confirmed' => 'Mật khẩu không khớp.',
        //     'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',
        // ];        
        
        // $validator = Validator::make($request->all(), $rules, $messages);
    
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Có lỗi xảy ra trong quá trình xử lý dữ liệu!');
        // }        
        
        // $user = User::create([
        //     'id'=> 'ID'. now(),
        //     'user_type_id' => $request->userType,
        //     'avatar' => 'user.jpg',
        //     'first_name' => $request->firstName,
        //     'last_name' => $request->lastName,
        //     'email' => $request->email,
        //     'phone_number' => NULL,
        //     'address_id' => NULL,
        //     'address_description'=> NULL,
        //     'password' => Hash::make($request->password),
        // ]);

        // $user->markEmailAsVerified();

        // return redirect()->back()->with('success', 'Người dùng đã được tạo thành công!');
    }

    public function destroy($id) {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }
}
