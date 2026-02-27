<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'source',
        'author',
        'title',
        'description',
        'content',
        'url',
        'image_url',
        'category',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
