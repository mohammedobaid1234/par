<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
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
        'video_url',
        'image_url',
    ];
    public function getImagePathAttribute($value)
    {
        if(!$this->image_url){
            return asset('images/placeholder.png');
        }
        if(stripos($this->image_url , 'http') ===  0){
            return $this->image_url;
        }
        return asset('uploads/' . $this->image_url);
    } 
    protected static function booted()
    {
        static::creating(function(Video $video) {
            $slug = Str::slug($video->title);

            $count = Video::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count) {
                $slug .= '-' . ($count + 1);
            }
            $video->slug = $slug;
        });
    }
}
