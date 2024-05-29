<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';

    protected $fillable = [
        'category_id',
        'category_name',
    ];

    public function storyCategory()
    {
        return $this->hasMany(StoryCategory::class,  'category_id');
    }
}
