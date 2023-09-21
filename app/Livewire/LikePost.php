<?php

namespace App\Livewire;

use App\Models\PostLike;
use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $liked;

    public function mount()
    {
        $this->liked= PostLike::checkUser(auth()->id(), $this->post->id);
       
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    public function like()
    {
        if($this->liked)
        {
          $this->post->likes()->where('user_id', auth()->id())->where('post_id', $this->post->id)->delete();
          $this->liked = false;
        } else{
          $this->post->likes()->create([
              'user_id' => auth()->user()->id,
              'post_id' => $this->post->id
          ]);
  
          $this->liked = true;
        }
    }
}
