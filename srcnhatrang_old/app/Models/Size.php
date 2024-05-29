<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    
    protected $table = 'sizes';

    protected $fillable = [
        'size_id',
        'description',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class,  'size_id');
    }
}
