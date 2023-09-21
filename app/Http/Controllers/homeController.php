<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index(){

        $posts = Post::Where('status', 1)
               -> orderBy('created_at', 'desc')
               ->take(5)
               ->get();

        foreach ($posts as $post) {
            $post->created_at = Carbon::parse($post->created_at);
        }


        

        return view('home.index', [
            'posts' => $posts
        ]);
    }
}
