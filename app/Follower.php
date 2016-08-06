<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','following_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
