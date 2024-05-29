<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryColor extends Model
{
    protected $table = 'primary_colors';
    protected $primaryKey = 'primary_color_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'primary_color_id',
        'primary_color_name',
    ];

    public function pet()
    {
        return $this->hasMany(Pet::class,  'primary_color_id');
    }
}
