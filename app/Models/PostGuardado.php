<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostGuardado extends Model
{
    use HasFactory;

    protected $table = 'posts_guardados';
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public static function checkUser($userId, $postId)
    {
        $resultado = self::where('user_id', $userId)
        ->where('post_id', $postId)
        ->exists(); 

        return $resultado;
    }
}
