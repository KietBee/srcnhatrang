<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $table = 'user_types';

    protected $primaryKey = 'user_type_id';

    public $incrementing = false;


    protected $fillable = [
        'user_type_id',
        'user_type_name',
    ];

    public function user()
    {
        return $this->hasMany(User::class,  'user_type_id');
    }
}
