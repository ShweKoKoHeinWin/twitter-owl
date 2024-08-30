<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'comment',
        'user_id'
    ];

    protected $with = ['user', 'comments'];


    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function comment() {
        return $this->belongsTo(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function commentable() {
        return $this->morphTo();
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
