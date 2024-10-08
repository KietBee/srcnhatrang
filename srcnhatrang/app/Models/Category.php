<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'category_name',
    ];

    public function storyCategories()
    {
        return $this->hasMany(StoryCategory::class, 'category_id');
    }
}

