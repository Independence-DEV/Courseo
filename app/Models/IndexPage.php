<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 'active_posts', 'account_id'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
