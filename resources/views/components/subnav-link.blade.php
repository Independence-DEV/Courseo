@props(['active', 'disable'])

@php
$classes = ($active ?? false)
            ? 'bg-red-500 text-white px-3 py-2 rounded-md text-sm font-medium'
            : 'bg-gray-100 hover:bg-gray-400 hover:text-white px-3 py-2 rounded-md text-sm font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
