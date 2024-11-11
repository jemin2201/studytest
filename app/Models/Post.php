<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
