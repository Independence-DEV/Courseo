<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'seo_title', 'description', 'content', 'meta_description', 'meta_keywords', 'thumbnail', 'active', 'account_id'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
