<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredefinedMonthlyAmount extends Model
{
    use HasFactory;

    protected $table = 'predefined_monthly_amount';

    protected $fillable = [
        'amount',
    ];
}
