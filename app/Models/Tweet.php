<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class Tweet extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'body',
        'comments',
        'slug',
        'image_url',
        'likes',
        'user_id',
    ];
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    protected static function booted()
    {
        static::creating(function(Tweet $tweet) {
            $slug = Str::slug($tweet->body);

            $count = Tweet::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count) {
                $slug .= '-' . ($count + 1);
            }
            $tweet->slug = $slug;
        });
    }
}
