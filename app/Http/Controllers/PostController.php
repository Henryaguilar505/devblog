<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Post;
use App\Models\PostGuardado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);


        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('viewAny', Post::class);

        $categorias = Categoria::all();
        return view('posts.create', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $this->validate($request, [
            'imagen' => 'required',
            'titulo' => 'required|string|min:10',
            'categoria_id' => 'required',
            'contenido' => 'required'
        ]);

         Post::create([
            'titulo' => $request->titulo,
            'categoria_id' => $request->categoria_id,
            'contenido' => $request->contenido,
            'user_id' => Auth()->user()->id,
            'imagen' =>$request->imagen,
            'status' => true
        ]);

        session()->flash('mensaje', 'El post se publicó correctamente');

        return redirect()->route('posts.index');
       
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
       $categorias = Categoria::all();

       return view('posts.edit', [
        'post' =>$post,
        'categorias' => $categorias
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        //validar
        $this->validate($request, [
            'imagen' => 'required',
            'titulo' => 'required|string|min:10',
            'categoria_id' => 'required',
            'contenido' => 'required'
        ]);

        //asignar los nuevos valores
        $post->titulo = $request->titulo;
        $post->imagen=$request->imagen;
        $post->categoria_id=$request->categoria_id;
        $post->contenido = $request->contenido;
        
        $post->save();

        session()->flash('mensaje', 'El post se actualizó correctamente');

        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function saved()
    {
    
        $userId = Auth::user()->id;
        $guardados = PostGuardado::where('user_id', $userId)
                                ->orderBy('created_at', 'desc')
                                ->with('post')
                                ->get();
                               


        return view('posts.guardados', [
            'guardados' => $guardados
        ]);
    }
}
