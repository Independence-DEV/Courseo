<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'account_id'
    ];

    public function courses(){
        return $this->belongsToMany(Course::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

}
