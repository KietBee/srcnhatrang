<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $table = 'breeds';
    protected $primaryKey = 'breed_id';
    public $incrementing = false;

    protected $fillable = [
        'breed_id',
        'specie_id',
        'breed_name',
    ];

    public function specie()
    {
        return $this->hasMany(Specie::class, 'specie_id', 'specie_id');
    }
}
