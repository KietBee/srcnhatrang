<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_type_id',
        'avatar',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address_id',
        'address_description',
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
        return $this->belongsTo(ward::class, 'address_id');
    }

    public static function getAllDataUsers($paginate) {
        return self::paginate($paginate);
    }    
}
