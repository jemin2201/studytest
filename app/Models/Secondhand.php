<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secondhand extends Model
{
    protected $table = 'secondhands'; // 모델이 어떤 데이터베이스와 연결될지 정의
    protected $primaryKey = 'id'; // 기본 키를 정의
    protected $fillable = [ // 어떤 데이터를 할당할지 정의
        'title',
        'content',
        'user_id',
        'price',
        'photo',
    ];
    use HasFactory;

    public function user(){ // 연관관계
        return $this->belongsTo(User::class); // belongsTo는 1대1
    }
}
