 <x-app-layout>
     <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             {{ __('Principal') }}
         </h2>
     </x-slot>

     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="p-6 text-gray-700 font-semibold">

                <h1 class=" mb-6 text-2xl font-bold text-center">Últimos Posts</h1>

                 @forelse ($posts as $post)
                     <a href="{{route('posts.show', $post) }}">
                         <div class="bg-white p-4 text-gray-700 mb-4 shadow-md md:flex md:gap-8 rounded-lg">
                             <div class="md:w-full md:flex md:flex-col md:justify-between">
                                 <div class="mt-2 md:mt-0">
                                     <p class= "bg-sky-700 text-white w-fit px-2 text-sm font-semibold py-1 rounded-md">
                                         {{ $post->categoria->nombre }}</p>
                                     <h2 class="text-xl font-bold text-gray-800">{{ $post->titulo }}</h2>
                                 </div>
                                 <div class="mb-2 md:mb-0">
                                    {!! mb_substr(strip_tags($post->contenido), 0, 300, 'UTF-8') !!}
                                    @if(mb_strlen(strip_tags($post->contenido)) > 300)
                                        <span>...</span>
                                    @endif
                                 </div>

                                 <div>
                                     <p class="text-gray-500 text-sm mb-1">Publicado por: <span class="font-bold">{{$post->user->name}}</span></p>
                                     <p class="text-gray-500 text-sm">Fecha: <span
                                             class="font-bold">{{ $post->created_at->format('d/m/Y') }}</span></p>
                                 </div>

                             </div>
                         </div>
                     </a>
                 @empty
                 <div class="bg-white p-4 text-gray-700 mb-4 shadow-md md:flex md:justify-center md:gap-8 rounded-lg">
                 <p>Aún no hay publicaciones en este blog</p>
                 </div>
                 @endforelse
             </div>
         </div>
     </div>
 </x-app-layout>
