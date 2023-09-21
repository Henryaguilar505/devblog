<?php

namespace App\Livewire;

use App\Models\PostGuardado;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class GuardarPost extends Component
{
    public $post;
    public $guardado;

    public function mount()
    {
        $this->guardado = PostGuardado::checkUser(auth()->id(), $this->post->id);
    }

    public function render()
    {
        return view('livewire.guardar-post');
    }

    public function guardar()
    {

      $this->guardado = PostGuardado::checkUser(auth()->id(), $this->post->id);

      if($this->guardado)
      {
        $this->post->guardado()->where('user_id', auth()->id())->where('post_id', $this->post->id)->delete();
        $this->guardado = false;
      } else{
        $this->post->guardado()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id
        ]);

        $this->guardado = true;
      }
 
    }
}
