<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;


class MostrarPosts extends Component
{

    protected $listeners = ['eliminar', 'status'];

    //esta funcion elimina un post
    public function eliminar(Post $post)
    {
        $post->delete();
    }

    public function render()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('livewire.mostrar-posts', [
            'posts' => $posts
        ]);
    }

    //esta funcion cambia el estado de oculto a mostar de un post
    public function status(Post $post)
    {
 
        if($post->status === 1){
            $post->status = 0;
        }else{
            $post->status = 1;
        }

        $post->save();
    }



}
