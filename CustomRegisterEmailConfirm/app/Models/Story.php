<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'stories';

    protected $primaryKey = 'story_id';
    public $incrementing = false;

    protected $fillable = [
        'story_id',
        'title',
        'content',
        'feature_image_url',
        'author_id',
        'is_approved',
        'approver_id',
        'approved_at',
        'is_edited',
        'edited_at',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_edited' => 'boolean',
        'approved_at' => 'datetime',
        'edited_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
