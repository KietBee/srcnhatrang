<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    protected $table = 'item_types';

    protected $primaryKey = 'item_type_id';
    public $incrementing = false;

    protected $fillable = [
        'item_type_id',
        'item_type_name',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'item_type_id', 'item_type_id');
    }
}
