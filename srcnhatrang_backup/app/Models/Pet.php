<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pets';
    protected $primaryKey = 'pet_id';

    public $incrementing = false;

    protected $fillable = [
        'pet_id',
        'primary_color_id',
        'age_id',
        'size_id',
        'breed_id',
        'pet_name',
        'gender',
        'description',
        'health_status',
        'rescued_at',
    ];

    protected $casts = [
        'gender' => 'boolean',
        'rescued_at' => 'datetime',
    ];

    public function breed()
    {
        return $this->belongsTo(Breed::class, 'breed_id', 'breed_id');
    }

    public function petImage()
    {
        return $this->hasMany(PetImage::class,  'pet_id');
    }

    public function getAllDataPet($paginate) {
        return $this->with('petImage')->paginate($paginate);
    }    
}
