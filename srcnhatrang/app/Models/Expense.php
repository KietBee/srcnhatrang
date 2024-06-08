<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';
    protected $primaryKey = 'expense_id';
    public $incrementing = false;

    protected $fillable = [
        'expense_id',
        'approver_id',
        'type',
        'fund_id',
        'amount',
        'description',
    ];

    // Define relationships
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id', 'fund_id');
    }
}
