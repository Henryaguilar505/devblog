<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class imagenController extends Controller
{
    public function store(Request $request)
    {

        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //imgenServidor ahpra es un instancia de intervention Image
        $imagenServidor = Image::make($imagen);
        //ajustar la medidas de la imagen
        $imagenServidor->fit(1000, 600);

        //definir la direccion donde se guardar la imagen
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        //guardar la imagen
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }

    public function eliminar()
    {
        $imagenes = glob(public_path('uploads') . '/*');
        $imagenesBaseDatos = \App\Models\Post::pluck('imagen')->toArray();
 
        foreach ($imagenes as $imagen) {
            if (!in_array(basename($imagen), $imagenesBaseDatos)) {
                unlink($imagen);
            }
        }
 
        return response()->json(['mensaje' => 'Imagenes eliminadas']);
    }
}
