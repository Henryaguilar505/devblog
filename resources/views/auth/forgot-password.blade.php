<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¡Olvidaste tu contraseña? ¡No hay problema! Solo déjanos saber tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña, permitiéndote elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between my-4">
            <x-link :href="route('login')">
                Iniciar Sesión
            </x-link>  
            
            <x-link :href="route('register')">
                Crear cuenta
            </x-link>    
        </div>
    
            <x-primary-button class="w-full justify-center">
                {{ __('Enviar link') }}
            </x-primary-button>
    </form>
</x-guest-layout>
