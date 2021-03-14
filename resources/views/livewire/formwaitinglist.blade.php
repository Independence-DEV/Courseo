    <form wire:submit.prevent="formSubmit" method="POST" class="w-full">
        @csrf
    <div class="flex w-full md:justify-start justify-center items-end">
        <div class="relative mr-4 lg:w-full xl:w-1/2 w-2/4">
            <label for="hero-field" class="leading-7 text-sm text-gray-600">{{ __('Your Email Address') }} :</label>
            <input type="email" wire:model="email" id="hero-field" name="hero-field" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-red-200 focus:bg-transparent focus:border-red-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </div>
        <button class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg" type="submit">{{ __('Subscribe') }}</button>

    </div>
        @if ($success == 'OK')
            <p class="text-sm mt-2 text-gray-500 mb-8 w-full text-green-500">{{ __('You are now in the waiting list !') }}</p>
        @elseif ($success == 'NOK')
            <p class="text-sm mt-2 text-gray-500 mb-8 w-full text-red-500">{{ __('You already are in the waiting list !') }}</p>
        @else
            <p class="text-sm mt-2 text-gray-500 mb-8 w-full">{{ __('Waiting list for beta testing.') }}</p>
        @endif
    </form>
