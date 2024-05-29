<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ExcelHelpers;
class UserController extends Controller
{
    // public function getAllUser(Request $request) {
    //     $users = User::getAllDataUsers($request->input('paginate', 8));
    //     return view('admin.page.user', compact('users'));
    // }
    // public function getAllUsers(Request $request) {
    //     $paginate = $request->input('paginate', 8);
    //     $sortBy = $request->input('sortBy', 'id');
    //     $sortDirection = $request->input('sortDirection', 'asc');
    //     $search = $request->input('search', '');
    
    //     $users = User::getAllDataUsers($paginate, $sortBy, $sortDirection, $search);
    
    //     if ($request->ajax()) {
    //         // Trả về dữ liệu dưới dạng JSON
    //         return response()->json([
    //             <x-admin.table :headers="[
    //                 ['label' => 'ID', 'sortable' => true],
    //                 ['label' => 'Ảnh', 'sortable' => false],
    //                 ['label' => 'Họ', 'sortable' => true],
    //                 ['label' => 'Tên', 'sortable' => true],
    //                 ['label' => 'Email', 'sortable' => true],
    //                 ['label' => 'SĐT', 'sortable' => true],
    //                 ['label' => 'Quyền', 'sortable' => true],
    //                 ['label' => 'Xác thực', 'sortable' => true],
    //                 ['label' => 'Chi tiết', 'sortable' => false],
    //                 ['label' => 'Sửa', 'sortable' => false],
    //                 ['label' => 'Xóa', 'sortable' => false],
    //             ]">
    //                 @foreach($users as $user)
    //                     <x-admin.table-row :rowData="[
    //                         $user->id,
    //                         $user->avatar,
    //                         $user->first_name,
    //                         $user->last_name,
    //                         $user->email,
    //                         $user->phone_number,
    //                         $user->userType->user_type_name,
    //                         $user->email_verified_at
    //                     ]" :imageColumns="[1]"/>
    //                 @endforeach
    //             </x-admin.table>
    //             'users' => $users // Dữ liệu người dùng
    //         ]);
    //     }
    
    //     return view('admin.page.user', compact('users'));
    // }

    public function index() {
        return view('page.admin.user');
    }

    public function edit(Request $request, $id) {
        $user = User::findOrFail($id);
        return view('page.admin.user-detail', compact('user'));
    }

    public function create(Request $request) {
        $rules = [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ];
    
        $messages = [
            'email.unique' => 'Email đã tồn tại.',
            'password.confirmed' => 'Mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',
        ];        
        
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Có lỗi xảy ra trong quá trình xử lý dữ liệu!');
        }        
        
        $user = User::create([
            'id'=> 'ID'. now(),
            'user_type_id' => $request->userType,
            'avatar' => 'user.jpg',
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone_number' => NULL,
            'address_id' => NULL,
            'address_description'=> NULL,
            'password' => Hash::make($request->password),
        ]);

        $user->markEmailAsVerified();

        if ($user->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Người dùng đã được tạo thành công!');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra khi tạo người dùng mới!');
        }
    }

    // public function updateUser(Request $request) {
    //     $user = User::find($request->user()->id);
    //     dd($user);
    //     dd($request);
    //     if ($user) {
    //         $user->update([
    //             'first_name' => $request->firstName,
    //             'last_name' => $request->lastName,
    //             'address_id' => $request->ward,
    //             'address_description' => $request->addressDescription,
    //         ]);
    
    //         dd($user->save());
    
    //         return redirect()->back()->with('success', 'Thông tin người dùng đã được cập nhật!');
    //     } else {
    //         return redirect()->back()->with('error', 'Không tìm thấy người dùng!');
    //     }
    // }
    public function updateUser(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phoneNumber' => 'nullable|string|max:255',
            'ward' => 'required|exists:wards,id',
            'addressDescription' => 'nullable|string|max:255',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user data
        $updated = $user->update([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'address_id' => $request->ward,
            'address_description' => $request->addressDescription,
        ]);

        // Check if update was successful
        if ($updated) {
            // Redirect back with success message
            return redirect()->back()->with('success', 'Thông tin người dùng đã được cập nhật thành công!');
        } else {
            // Redirect back with error message
            return redirect()->back()->with('error', 'Cập nhật thông tin người dùng thất bại. Vui lòng thử lại sau!');
        }
    }


    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Bản ghi đã được xóa thành công.']);
    }

    public function exportUserToExcel()
    {
        $fileName = 'danhsachnguoidung'.now().'.xlsx';
        $users = User::with('userAddress.district.province')->get();
        $data = $users->map(function ($user) {
            $address = $user->userAddress;
            $provinceName = null;
            $districtName = null;

            if ($address) {
                $district = $address->district;
                if ($district) {
                    $districtName = $district->name;
                    $province = $district->province;
                    if ($province) {
                        $provinceName = $province->name;
                    }
                }
            }
    
            return [
                'ID' => $user->id,
                'Họ' => $user->first_name,
                'Tên' => $user->last_name,
                'Email' => $user->email,
                'Số điện thoại' => $user->phone_number,
                'Quyền' => $user->userType->user_type_name,
                'Tỉnh/Thành phố' => $provinceName,
                'Huyện/Quận' => $districtName,
                'Tên đường/Số nhà' => $user->address_description,
                'Ngày tạo tài khoản' => $user->created_at
            ];
        })->toArray();
    
        $headings = ['ID', 'Họ', 'Tên', 'Email', 'Số điện thoại', 'Quyền', 'Tỉnh/Thành phố', 'Huyện/Quận', 'Tên đường/Số nhà', 'Ngày tạo tài khoản'];

        return ExcelHelpers::exportToExcel($data, $fileName, $headings);
    }
    
    
}

