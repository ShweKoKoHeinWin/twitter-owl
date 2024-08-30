<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'content',
        'privacy',
    ];

    public function images() {
        return $this->morphMany(Image::class, 'taggable');
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class)->where('like', true);
    }

    public function dislikes() {
        return $this->hasMany(Like::class)->where('like', false);
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Logic to execute before creating the model
        });

        static::created(function ($model) {
            // Logic to execute after creating the model
        });

        // Other event listeners...
    }
}
