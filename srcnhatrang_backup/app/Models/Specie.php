<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    use HasFactory;

    protected $table = 'species';
    protected $primaryKey = 'specie_id';

    public $incrementing = false;

    protected $fillable = [
        'specie_id',
        'specie_name',
    ];

    public function breed()
    {
        return $this->hasMany(Breed::class, 'specie_id', 'specie_id');
    }

    public static function getAllDataSpecie($paginate) {
        return self::withCount('breed')->paginate($paginate);
    }  
}
