<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
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
        'body',
        'image_url',
    ];
    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function($model){
            $model->slug = Str::slug($model->title);
        });
    }
    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getImagePathAttribute()
    {
        if(!$this->image_url){
            return asset('uploads/Twitte.png');
        }
        if(stripos($this->image_url , 'http') ===  0){
            return $this->image_url;
        }
        return asset('uploads/' . $this->image_url);
    } 

}
