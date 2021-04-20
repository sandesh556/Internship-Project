<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
