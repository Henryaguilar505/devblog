<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h1>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-700 font-semibold">

                    {{-- <h1 class="font-bold text-2xl text-center mb-10">Todos los posts</h1> --}}

                   <livewire:blog-posts/>


                          
                </div>
            </div>
        </div>
    </div>
</x-app-layout>