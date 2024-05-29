<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetAdoption extends Model
{
    use HasFactory;

    protected $table = 'pet_adoptions';
    protected $primaryKey = 'pet_adoption_id';
    public $incrementing = false;

    protected $fillable = [
        'pet_adoption_id',
        'pet_id',
        'title',
        'description',
        'created_by',
    ];

    // Define the relationship with Pet model
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }

    // Define the relationship with User model
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
