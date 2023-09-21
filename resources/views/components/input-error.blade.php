@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="bg-red-100 p-2 border-l-4 border-red-700 font-semibold">{{ $message }}</li>
        @endforeach
    </ul>
@endif
