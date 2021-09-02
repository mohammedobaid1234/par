<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'report_id'  
    ];
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function report()
    {
        $this->belongsTo('reports');
    }
}
