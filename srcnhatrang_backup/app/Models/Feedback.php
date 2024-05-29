<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $primaryKey = 'feedback_id';
    public $incrementing = false;

    protected $fillable = [
        'feedback_id',
        'sender',
        'content',
        'is_responded',
        'responder',
        'response',
        'responded_at',
    ];

    protected $casts = [
        'is_responded' => 'boolean',
        'responded_at' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender', 'id');
    }

    public function responder()
    {
        return $this->belongsTo(User::class, 'responder', 'id');
    }
}
