<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';

    protected $primaryKey = 'expense_id';

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id', 'fund_id');
    }

}
