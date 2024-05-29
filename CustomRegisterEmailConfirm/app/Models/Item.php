<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_id',
        'item_type_id',
        'item_name',
        'item_description',
        'quantity',
    ];

    public function itemType()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id', 'item_type_id');
    }
}
