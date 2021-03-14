@props(['value', 'tooltip' => false])



<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 inline-block align-middle']) }}>
    {{ $value ?? $slot }}
</label>

@if ($tooltip)
    <div class="inline-block align-middle has-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4 text-gray-500">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>
        <span class='tooltip rounded shadow-lg p-1.5 bg-red-400 text-white -mt-8 transform -translate-y-1/2'>{{ $tooltip }}</span>
    </div>
@endif




