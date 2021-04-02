<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_publishable_key', 'stripe_secret_key'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
