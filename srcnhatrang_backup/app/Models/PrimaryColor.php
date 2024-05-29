<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryColor extends Model
{
    protected $table = 'primary_colors';

    protected $fillable = [
        'primary_color_id',
        'primary_color_name',
    ];

    public function pet()
    {
        return $this->hasMany(Pet::class,  'primary_color_id');
    }
}
