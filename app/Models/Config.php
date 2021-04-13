<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'logo', 'favicon', 'email_from', 'lang', 'facebook_link', 'twitter_link', 'instagram_link', 'linkedin_link', 'youtube_link', 'github_link', 'account_id'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
