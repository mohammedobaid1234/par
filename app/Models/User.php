<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'phone_number',
        'phone_number_verified_at',
        'about',
        'full_name',
        'birthday',
        'marital_status',
        'type',
        'email',
        'password',
        'image_url',
        'council_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The reflations.
     *
     * @var void
     */
    public function council()
    {
        return $this->belongsTo(Council::class);
    }
    public function tweet()
    {
        return $this->hasMany(Tweet::class);
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
        static::creating(function(User $user) {
            $slug = Str::slug($user->name);

            $count = User::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count) {
                $slug .= '-' . ($count + 1);
            }
            $user->slug = $slug;
        });
    } 
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
}
