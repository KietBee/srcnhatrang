<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyDonation extends Model
{
    use HasFactory;

    protected $table = 'money_donations';

    protected $primaryKey = 'money_donation_id';
    
    public $incrementing = false;

    protected $fillable = [
        'money_donation_id',
        'donor_id',
        'fund_id',
        'frequency',
        'status',
        'amount',
    ];

    protected $casts = [
        'frequency' => 'boolean',
        'status' => 'boolean',
        'amount' => 'decimal:2',
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id', 'id');
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id', 'fund_id');
    }
}
