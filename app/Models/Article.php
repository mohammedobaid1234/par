<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 
        'slug',
        'article_url',
        'image_url',
    ];

    protected static function booted()
    {
        static::creating(function(Article $article) {
            $slug = Str::slug($article->title);

            $count = Article::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count) {
                $slug .= '-' . ($count + 1);
            }
            $article->slug = $slug;
        });
    }    
}
