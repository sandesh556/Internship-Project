<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function comment(){
        return $this->hasMany('App\Models\Comment','post_id');
    }
    public function comments(){
        return $this->morphMany(Comment::class,'post');
    }
}
