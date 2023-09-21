<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'categoria_id',
        'contenido',
        'user_id',
        'imagen',
        'status' 

    ];

    public function checkstatus($postId){
        dd( Post::where('id', $postId)->value('status'));
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'email']);
    }

    public function comentario()
    {
        return $this->hasMany(Comentario::class);
    }

    public function guardado()
    {
        return $this->hasMany(PostGuardado::class);
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }
}
