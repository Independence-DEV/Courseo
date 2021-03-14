<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'subdomain', 'account_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function indexPage(){
        return $this->hasOne(IndexPage::class);
    }

    public function prospects(){
        return $this->hasMany(Prospect::class);
    }
}
