<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    protected $table = 'ages';

    protected $fillable = [
        'age_id',
        'description',
    ];

    public function pet()
    {
        return $this->hasMany(Pet::class,  'age_id');
    }
}
