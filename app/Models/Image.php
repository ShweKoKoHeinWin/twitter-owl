<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'taggable_type',
        'taggable_id',
        'url'
    ];

    public function taggable()
    {
        return $this->morphTo();
    }
}
