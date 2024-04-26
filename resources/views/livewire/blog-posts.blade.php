<div>
    <livewire:filtrar-posts :posts='$posts'>          
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
             <div class="bg-white p-4 text-gray-700 mb-4 shadow-md md:flex md:gap-8 rounded-lg">
             <p>No hay publicaciones en este blog</p>
             </div>
             @endforelse
</div>                 
                  
