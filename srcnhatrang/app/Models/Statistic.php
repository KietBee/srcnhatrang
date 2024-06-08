<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    protected $table = 'statistics';
    protected $primaryKey = 'statistic_id';
    public $incrementing = false;

    public function fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id', 'fund_id');
    }
}
