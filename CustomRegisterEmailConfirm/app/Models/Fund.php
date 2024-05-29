<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $table = 'funds';

    protected $primaryKey = 'fund_id';
    
    public $incrementing = false;

    protected $fillable = [
        'fund_id',
        'created_by',
        'title',
        'description',
        'feature_image',
        'current_balance',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
