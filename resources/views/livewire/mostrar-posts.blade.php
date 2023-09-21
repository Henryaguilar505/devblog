<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

    @forelse ($posts as $post)
        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a class="font-bold text-xl" href="{{route('posts.show', $post)}}">
                    {{ $post->titulo }}
                </a>
                <p class="text-sm text-gray-700 font-semibold">Categoria: {{ $post->categoria->nombre }}</p>
                <p class="text-sm text-gray-700 font-semibold">Publicado: {{ $post->created_at->format('d/m/Y') }}</p>
                <p class="text-sm text-gray-700 font-bold">Estado: {{ $post->status ? 'Mostrar' : 'Oculto' }}</p>

            </div>

            <div class="mt-4 md:mt-0 flex flex-col items-stretch gap-3 md:flex-row md:items-center">

                <button wire:click="$dispatch('status',{ post: {{ $post }} })"
                    class="bg-slate-700 py-2 px-3 rounded-lg text-white text-xs font-bold uppercase text-center">
                    {{ $post->status === 1 ? 'Ocultar' : 'Mostar' }}</button>

                    
                <a href="{{ route('posts.edit', $post->id) }}"
                    class="bg-blue-800 py-2 px-3 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Editar</a>

                <button wire:click="$dispatch('alertaEliminar',{ post: {{ $post }} })"
                    class="bg-red-700 py-2 px-3 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Eliminar</button>


            </div>
        </div>
    @empty
        <p>No hay publicaciones que mostrar</p>
    @endforelse
</div>

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('alertaEliminar', post => {
                Swal.fire({
                    title: 'Estás seguro que deseas eliminar este post?',
                    text: "Una vez eliminado no podrás recuperarlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borrar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //eliminar la vacaante desde el servidor
                        @this.dispatch('eliminar', {post: post})
                        Swal.fire(
                            'Borrado!',
                            'Tu post ha sido borrado.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
