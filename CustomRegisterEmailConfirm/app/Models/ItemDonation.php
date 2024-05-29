<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDonation extends Model
{
    use HasFactory;

    protected $table = 'item_donations';

    protected $primaryKey = 'item_donation_id';

    protected $fillable = [
        'item_donation_id',
        'donor_id',
        'approver_id',
        'approved_at',
        'delivery_method_id',
        'status',
        'quantity',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }

    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id', 'delivery_method_id');
    }
}
