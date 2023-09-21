<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-700 font-semibold">
                    @if (session()->has('mensaje'))
                        <div class="p-4 mb-4 bg-green-600 text-green-100 font-semibold rounded-lg">
                            {{session('mensaje')}}
                        </div>
                    @endif
                    
                    <livewire:mostrar-posts/>
                </div>
        </div>
    </div>
</x-app-layout>