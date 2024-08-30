<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'follower_id',
    ];

    // protected $with = ['follower_user', 'following_user'];

    public function follower_user() {
        return $this->belongsTo(User::class, 'follower_id', 'id');
    }

    public function following_user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
