<div class="bg-white border-b border-gray-200 md:1/2 m-auto">

    <div class="m-auto p-6 md:p-0 md:w-1/2 my-12">
        @if (session()->has('mensaje'))
            <div class="p-3 mb-4 bg-green-600 text-green-100 text-center font-semibold rounded-lg" id='mensaje-flash'>
                {{ session('mensaje') }}
            </div>
        @endif

        @auth
            @if (Auth::user()->email_verified_at)
                <form action="POST" wire:submit.prevent="comentar">
                    <x-input-label for="comentario" :value="__('Agregar comentario')" />
                    <textarea wire:model="comentario" id="comentario" class="w-full mb-2 rounded-md" placeholder="Escribe aquí tu comentario"></textarea>

                    <x-input-error :messages="$errors->get('comentario')" class="my-2" />

                    <button type="submit" class="font-bold text-white p-2 rounded-lg w-full text-sm bg-blue-700">
                        Comentar
                    </button>
                </form>
            @else
                <div class="text-gray-100 bg-indigo-700 p-3 mb-4 text-md text-center rounded-lg">
                    <p>Para dejar tu comentario debes verificar tu email. <a class="font-semibold"
                            href="{{ route('verification.notice') }}">Click Aquí para verificar</a></p>
                </div>
            @endif

        @endauth

        @guest
            <div class="text-gray-100 bg-indigo-700 p-3 mb-4 text-md text-center rounded-lg">
                <p>Para dejar tu comentario debes registrarte primero. <a class="font-semibold"
                        href="{{ route('register') }}">Click Aquí para registrarte</a></p>
            </div>
        @endguest

        <div class="mt-2">
            <h4 class="font-bold mt-6 text-lg text-center">{{ $comentarios->count() }} @choice('Comentario|Comentarios', $comentarios->count())</h4>
            @forelse ($comentarios as $comentario)
                <div class="p-4 grid grid-cols-[10%_auto] gap-4 border-b-2">
                    <div>
                        <img class="rounded-full" src="{{ asset('profile/R.png') }}" alt="Imagen de usuario">
                    </div>

                    <div class="mb-3 flex flex-col ">
                        <p class="font-bold text-slate-800">{{ $comentario->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $comentario->created_at->diffForHumans() }}</p>
                        <p class="text-lg  text-gray-800">{{ $comentario->comentario }}</p>

                        @auth

                        <div>
                            @if ($comentario->id === $comentarioEnEdicionId)
                            <div class="mb-3">
                                <textarea wire:model="contenidoEditado" rows="6" class="w-full rounded border p-2"></textarea>
                            </div>
                            <button wire:click="actualizar"
                                class="py-2 px-3 rounded-lg bg-blue-500 text-white hover:bg-blue-600">
                                Guardar
                            </button>
                           @endif
                           </div>

                            <div class="mt-4 flex justify-end">
                                @if ($comentario->user->id === Auth::user()->id || Auth::user()->rol === 1)
                                    <button wire:click="$dispatch('alertaEliminar',{ comentario: {{ $comentario }} })"
                                        class=" py-2 px-3 rounded-lg text-red-500 hover:text-red-600 text-md font-semibold text-center">
                                        Eliminar</button>
                                @endif

                                @if ($comentario->user->id === Auth::user()->id)
                                    <button wire:click="$dispatch('editar',{ comentarioId: {{ $comentario->id }} })"
                                        class=" py-2 px-3 rounded-lg text-blue-500 hover:text-blue-600 text-md font-semibold text-center">
                                        Editar</button>

                                @endif
                            </div>
                        @endauth
                    </div>
                </div>

            @empty
                <div class="bg-white p-4 text-gray-700 mb-4 text-center rounded-lg">
                    <p>No hay comentarios para mostar</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('alertaEliminar', comentario => {
                Swal.fire({
                    title: 'Estás seguro que deseas eliminar este comentario?',
                    text: "Una vez eliminado no podrás recuperarlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borrar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //eliminar la vacaante desde el servidor
                        @this.dispatch('eliminar', {
                            comentario: comentario
                        })
                        Swal.fire(
                            'Borrado!',
                            'El comentario ha sido borrado.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
