<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'logo', 'facebook_link', 'twitter_link', 'instagram_link', 'linkedin_link', 'account_id'
    ];
}
