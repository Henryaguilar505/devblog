<?php

namespace App\Livewire;

use App\Models\Comentario;
use Carbon\Carbon;
use Livewire\Component;

class ComentariosPost extends Component
{
    protected $listeners = ['eliminar', 'editar'];

    public $post;
    public $comentario;
    public $comentarioEnEdicionId = null;
    public $comentarioEnEdicion = null;
    public $contenidoEditado = null;
    public $modoEdicion = false;


    protected $rules = [
        'comentario' => 'required|string'
    ];


    public function render()
    {
        $comentarios = Comentario::orderBy('created_at', 'desc')
            ->where('post_id', $this->post->id)
            ->get();


        foreach ($comentarios as $comentario) {
            $comentario->created_at =  Carbon::parse($comentario->created_at);
        }

        return view('livewire.comentarios-post', [
            'comentarios' => $comentarios,
        ]);
    }


    public function comentar()
    {

        $datos = $this->validate();

        Comentario::create([
            'user_id' => Auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $datos['comentario']
        ]);

        $this->comentario = "";

        $mensaje = 'Se ha publicado tu comentario';

        return back()->with('mensaje', $mensaje);
    }

    public function eliminar(Comentario $comentario)
    {
        $comentario->delete();
    }

    //*editar

    public function editar($comentarioId)
    {
        $this->comentarioEnEdicionId = $comentarioId;
        $this->comentarioEnEdicion = Comentario::find($this->comentarioEnEdicionId);
        $this->contenidoEditado = $this->comentarioEnEdicion->comentario;
        $this->modoEdicion = true;
    }

    public function actualizar()
    {
        $this->validate([
            'contenidoEditado' => 'required',
        ]);

        $this->comentarioEnEdicion->comentario = $this->contenidoEditado;
        $this->comentarioEnEdicion->save();

        // Restablece el modo de edición y limpia los campos
        $this->modoEdicion = false;
        $this->contenidoEditado = '';
        $this->comentarioEnEdicionId = '';

        // Puedes agregar un mensaje de éxito si lo deseas
        session()->flash('mensaje', 'Comentario editado exitosamente.');
    }
}
