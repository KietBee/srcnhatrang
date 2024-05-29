<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredefinedOnlyAmount extends Model
{
    use HasFactory;

    protected $table = 'predefined_only_amount';

    protected $fillable = [
        'amount',
    ];
}
