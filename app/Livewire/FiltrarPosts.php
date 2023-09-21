<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class FiltrarPosts extends Component
{

    public $termino;
    public $categoria;

    public function leerDatosFormulario()
    {
        $this->dispatch('terminosBusqueda', $this->termino, $this->categoria);
    }

    public function render()
    {
        $categorias = Categoria::all();
        return view('livewire.filtrar-posts', [
            'categorias' => $categorias
        ]);
    }
}
