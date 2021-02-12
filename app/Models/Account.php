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
}
