<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'content'
    ];
    use HasFactory;
}
