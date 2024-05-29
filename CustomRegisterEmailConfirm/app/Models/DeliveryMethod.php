<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;

    protected $table = 'delivery_methods';

    protected $primaryKey = 'delivery_method_id';

    protected $fillable = [
        'delivery_method_id',
        'delivery_method_name',
    ];

    public function itemDonation()
    {
        return $this->hasMany(ItemDonation::class, 'delivery_method_id', 'delivery_method_id');
    }
}
