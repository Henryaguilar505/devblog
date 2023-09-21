<div class="bg-gray-100 mb-4">
    <h2 class="text-xl md:text-3xl text-gray-600 text-center font-bold my-5">Buscar y Filtrar Posts</h2>

    <div class="max-w-7xl mx-auto">
        <form wire:submit.prevent='leerDatosFormulario'>
            <div class="md:grid md:grid-cols-3 gap-5 justify-center items-center">
                <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm text-gray-700 font-bold "
                        for="termino">Término de Búsqueda
                    </label>
                    <input 
                       wire:model='termino'
                        id="termino"
                        type="text"
                        placeholder="Buscar por Término: ej. Nicaragua, turismo.."
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                    />
                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 font-bold">Categoría</label>
                    <select wire:model='categoria' class="border-gray-300 rounded-md p-2 w-full">
                       
                        <option value="" >--Todas--</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <input 
                        type="submit"
                        class="bg-sky-700 hover:bg-sky-800 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer w-full md:w-auto"
                        value="Buscar"
                    />
                </div>

            </div>

        </form>
    </div>
</div>