<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getImageUrlAttribute($value)
    {
        if(!$this->image_path){
            return asset('images/placeholder.png');
        }
        if(stripos($this->image_path , 'http') ===  0){
            return $this->image_path;
        }
        return asset('uploads/' . $this->image_path);
    } 

}
