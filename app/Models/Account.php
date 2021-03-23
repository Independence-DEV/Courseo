<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Account extends Model
{
    use HasFactory;
    use Billable;

    protected $fillable = [
        'name', 'subdomain', 'domain', 'account_id'
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

    public function customers(){
        return $this->hasMany(Customer::class);
    }
}
