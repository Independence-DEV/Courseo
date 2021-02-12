<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg']) }}>
    {{ $slot }}
</button>
