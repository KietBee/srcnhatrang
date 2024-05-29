<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailItemDonation extends Model
{
    use HasFactory;

    protected $table = 'detail_item_donations';

    protected $primaryKey = ['item_donation_id', 'item_id'];

    public $incrementing = false;

    protected $fillable = [
        'item_donation_id',
        'item_id',
        'amount',
    ];

    public function itemDonation()
    {
        return $this->belongsTo(ItemDonation::class, 'item_donation_id', 'item_donation_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}
