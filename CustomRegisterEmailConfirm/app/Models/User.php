<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'avatar',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'login_at' => 'datetime',
            'change_password_at' => 'datetime',
        ];
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function userAddress()
    {
        return $this->belongsTo(Ward::class, 'address_id');
    }

    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        $this->save();
    }

    public static function search($query)
    {
        return self::where(function ($q) use ($query) {
            $q->where('id', 'like', "%$query%")
                ->orWhere('first_name', 'like', "%$query%")
                ->orWhere('last_name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('phone_number', 'like', "%$query%");
        });
    }

    public static function getAllDataUsers($currentPage, $paginate, $sortBy = 'id', $sortDirection = 'asc', $search = '', $userType = [])
    {
        // Tạo một đối tượng User từ phương thức query()
        $query = self::query();

        if ($search !== '') {
            // Gọi phương thức search() trên đối tượng User đã tạo
            $query = self::search($search);
        }

        if (is_string($userType)) {
            // Nếu là chuỗi, chuyển đổi thành mảng
            $userType = [$userType];
        }
        
        // Lọc dữ liệu theo user_type_id nếu $userType không rỗng
        if (!empty($userType)) {
            $query->whereIn('user_type_id', $userType);
        }

        $total = $query->count();

        // Gọi orderBy() và paginate() trên đối tượng User đã tạo
        $query->orderBy($sortBy, $sortDirection);
        $result = $query->paginate($paginate, ['*'], 'page', $currentPage);

        // Trả về kết quả cùng với tổng số bản ghi
        return [
            'data' => $result,
            'total' => $total,
        ];
    }


    
}

