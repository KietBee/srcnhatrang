<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Validator;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $addressController = new AddressController();
        $provinces = $addressController->getProvince();
        return view('auth.register', compact('provinces'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone_number' => 'required|unique:users',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ];        
    
        $messages = [
            'firstName.required' => 'Tên là trường bắt buộc.',
            'firstName.string' => 'Tên phải là một chuỗi.',
            'firstName.max' => 'Tên không được vượt quá 255 ký tự.',
            'lastName.required' => 'Họ là trường bắt buộc.',
            'lastName.string' => 'Họ phải là một chuỗi.',
            'lastName.max' => 'Họ không được vượt quá 255 ký tự.',
            'phone_number.unique' => 'Số điện thoại đã tồn tại.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email phải là định dạng hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'password.required' => 'Mật khẩu là trường bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một chữ số và một ký tự đặc biệt.',
        ];               
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'id'=> 'ID'. now(),
            'user_type_id' => 'ATUS0406',
            'avatar' => 'user.jpg',
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone_number' => $request->phoneNumber,
            'address_id' => NULL,
            'address_description'=> NULL,
            'password' => Hash::make($request->password),
        ]);
        $userArray = $user->toArray();
        $userJson = json_encode($userArray);
        event(new Registered($userJson));

        // event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
