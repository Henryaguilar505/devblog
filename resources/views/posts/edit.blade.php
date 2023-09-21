@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scripts')
<script src="https://cdn.tiny.cloud/1/3l0zryj6ioib1hjsy85r2vweawocys294pfe0a88mp7nslo8/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Post') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-700 font-semibold">

                    <h1 class="text-gray-800 font-bold text-3xl text-center mb-10">Editar Post: {{$post->titulo}}</h1>
                   
                    <div class="p-5">

                        <div class="flex justify-center items-center h-60">
                        <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone"
                        class="dropzone border-dashed border-2 w-full md:w-1/3 min-h-[100%] flex flex-col justify-center items-center">
                        @csrf

                        </form>
                        </div>

                        <form method="POST" action="{{route('posts.update', $post)}}" novalidate>
                            @method('PUT')
                            @csrf

                            <div class="mb-6">
                        
                                <x-text-input id="imagen"
                                 class="mt-1" 
                                 type="hidden" name="imagen"
                                 value="{{($post->imagen) ? $post->imagen :  old('imagen')}}"
                               
                               
                                 />
                        
                                <x-input-error :messages="$errors->get('imagen')" class="mt-2 md:w-1/2" />
                            </div>
                          
                            <div class="mb-6 w-full">
                                <x-input-label for="titulo" :value="__('Titulo')" />
                        
                                <x-text-input id="titulo"
                                 class="block mt-1 w-full" 
                                 type="text"
                                 name="titulo"
                                 value="{{($post->titulo) ? $post->titulo :  old('titulo')}}"
                                 placeholder="Titulo post"/>
                        
                                <x-input-error :messages="$errors->get('titulo')" class="mt-2 md:w-1/2" />
                            </div>
                        
                        
                            <div class="mb-6">
                                <x-input-label for="categoria" :value="__('Categoria')" />
                        
                                <select id="categoria"
                                 class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                 type="text"
                                 name="categoria_id" 
                                 value="{{($post->categoria_id) ? $post->categoria_id :  old('categoria_id')}}"
                                 >
                        
                                 <option value="{{$post->categoria_id}}">{{$post->categoria->nombre}}</option>
                                 @foreach ($categorias as $categoria)
                                 <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                 @endforeach
                             
                                </select>
                        
                                <x-input-error :messages="$errors->get('categoria_id')" class="md:w-1/2" />
                            </div>
                        
                        
                            <div class="mb-5">
                            <textarea id="editor" name="contenido">{{($post->contenido) ? $post->contenido : old('contenido')}}</textarea>
                            <x-input-error :messages="$errors->get('contenido')" class="mt-2 md:w-1/2" />
                            </div>
                        
                            
                            <div class="flex justify-center mt-4">
                            <x-primary-button class="w-full md:w-1/2 justify-center">
                                {{ __('Guardar Cambios') }}
                            </x-primary-button>
                           </div>
                         
                        
                        </form>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>