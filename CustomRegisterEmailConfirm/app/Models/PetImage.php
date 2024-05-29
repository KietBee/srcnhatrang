<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'pet_image_id';
    public $incrementing = false;

    protected $fillable = [
        'pet_id',
        'pet_image',
    ];

    // Define the relationship with Pet model
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }
}
