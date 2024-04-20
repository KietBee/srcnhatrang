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

    public function getAllUsers(Request $request) {
        $currentPage = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 8);
        $sortBy = $request->input('sortBy', 'id');
        $sortDirection = $request->input('sortDirection', 'asc');
        $search = $request->input('search', '');
        $userType = $request->input('userType');
    
        $userData  = User::getAllDataUsers($currentPage, $pageSize, $sortBy, $sortDirection, $search, $userType);
        $users = $userData['data'];
        $totalUsers = $userData['total'];

        if ($request->ajax()) {
            $rowsHtml = '';
            foreach ($users as $user) {
                $id = $user->id;
                $action = new HtmlString('
                    <ul class="flex flex-wrap gap-3 items-center justify-center text-gray-900 dark:text-white">
                        <li><a href="' . route('admin.detail-user', ['id' => $id]) . '" class="hover:underline"><svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                    </svg>
                    </a></li>
                        <li>
                        <button> <svg  data-target="'.$id.'" class="btnDelete w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                    </svg> </button>
                        </li>
                    </ul>
                ');
                $rowHtml = View::make('components.admin.table-row', [
                    'rowData' => [
                        $user->id,
                        $user->avatar,
                        $user->first_name,
                        $user->last_name,
                        $user->email,
                        $user->phone_number,
                        $user->userType->user_type_name,
                        $user->email_verified_at,
                        $action
                        ],
                        'imageColumns' => [1]
                    ])->render();
                $rowsHtml .= $rowHtml;
            }
            $tableHtml = View::make('components.admin.table-header', [
                'headers' => [
                    ['label' => 'ID', 'sortable' => true, 'sortBy' => 'id', 'center' => false],
                    ['label' => 'Ảnh', 'sortable' => false, 'sortBy' => null, 'center' => false],
                    ['label' => 'Họ', 'sortable' => true, 'sortBy' => 'first_name', 'center' => false],
                    ['label' => 'Tên', 'sortable' => true, 'sortBy' => 'last_name', 'center' => false],
                    ['label' => 'Email', 'sortable' => true, 'sortBy' => 'email', 'center' => false],
                    ['label' => 'SĐT', 'sortable' => true, 'sortBy' => 'phone_number', 'center' => false],
                    ['label' => 'Quyền', 'sortable' => true, 'sortBy' => 'user_type_id', 'center' => false],
                    ['label' => 'Xác thực', 'sortable' => true, 'sortBy' => 'email_verified_at', 'center' => false],
                    ['label' => 'Tùy chọn', 'sortable' => false, 'sortBy' => null, 'center' => true],
                ],
            ])->render();

            $paginationHtml = view('components.admin.pagination', [
                'currentPage' => $currentPage,
                'totalItems' => $totalUsers,
                'itemsPerPage' => $pageSize
            ])->render();
    
            return response()->json([
                'paginationHtml' => $paginationHtml,
                'headers' => $tableHtml,
                'rowsHtml' => $rowsHtml,
                'totalUsers' => $totalUsers
            ]);        
        }
        return view('admin.page.user', compact('users', 'totalUsers'));
    }

    public function getDetailUser(Request $request, $id) {
        $user = User::findOrFail($id);
        return view('admin.page.user-detail', compact('user'));
    }

    public function createUser(Request $request) {
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

        return redirect()->back()->with('success', 'Người dùng đã được tạo thành công!');
        

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


    public function deleteUser(Request $request) {
        $id = $request->id;

    // Tìm người dùng cần xóa
    $user = User::find($id);

    // Kiểm tra xem người dùng có tồn tại không
    if (!$user) {
        return redirect()->back()->with('error', 'Không tìm thấy người dùng!');
    }

    // Thực hiện xóa người dùng
    $user->delete();

    // Chuyển hướng lại và gửi thông báo thành công
    return redirect()->back()->with('success', 'Người dùng đã được xóa thành công!');
        

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

