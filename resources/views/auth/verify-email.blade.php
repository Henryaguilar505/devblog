<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('"¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo click en el enlace que acabamos de enviarte por correo? Si no recibiste el correo electrónico, con gusto te enviaremos otro."') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __("Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.") }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Reenviar emeail de verificación') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Cerrar Sesión') }}
            </button>
        </form>
    </div>
</x-guest-layout>