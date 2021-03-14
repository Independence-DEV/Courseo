<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'slug', 'account_id'
    ];

    public $timestamps = false;

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
