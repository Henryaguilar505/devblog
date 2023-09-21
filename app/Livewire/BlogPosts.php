<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogPosts extends Component
{

    public $termino;
    public $categoria;
    protected $listeners = ['terminosBusqueda' => 'buscar'];

    public function buscar($termino, $categoria)
    {
        $this->termino = $termino;
        $this->categoria = $categoria;
    }

    public function render()
    {
        // $posts = Post::orderBy('created_at', 'desc')
        // ->where('status', '1')
        // ->get();


        $posts = Post::when($this->termino, function ($query) {
            $query->where('titulo', 'LIKE', "%" . $this->termino . "%");
        })->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria);
        })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.blog-posts', [
            'posts' => $posts
        ]);
    }
}
