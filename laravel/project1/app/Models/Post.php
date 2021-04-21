<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use function Symfony\Component\Translation\t;

class Post extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function comments(){
        return $this->morphMany(Comment::class,'post');
    }
}
