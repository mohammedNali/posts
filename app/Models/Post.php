<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $table = 'db_posts';  // posts => db_posts
    // protected $primaryKey = 'post_id'; // id => post_id
    public $incrementing = false;
    protected $fillable = ['title', 'body', 'image'];


    

}
