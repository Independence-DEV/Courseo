<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'account_id',
    ];

    protected $guarded = [];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class);
    }
}
