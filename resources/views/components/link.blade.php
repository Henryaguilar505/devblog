@php
    $classes = "font-semibold text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none";
@endphp

<div>
    <a {{$attributes->merge(['class'=>$classes])}}>
        {{ $slot }}
    </a>
</div>