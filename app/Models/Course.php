<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'presentation', 'image', 'stripe_id', 'price', 'active', 'account_id'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function prospects(){
        return $this->belongsToMany(Prospect::class);
    }

    public function customers(){
        return $this->belongsToMany(Customer::class);
    }
}
