    <div class="lg:w-2/5 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
        <form wire:submit.prevent="formSubmit" method="POST" class="w-full">
            @csrf
        <h2 class="text-gray-900 text-lg font-medium title-font mb-5">{{ __('Get this course') }}</h2>
        <div class="relative mb-4">
            <label for="name" class="leading-7 text-sm text-gray-600">{{ __('Name') }}</label>
            <input type="text" wire:model="name" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </div>
        <div class="relative mb-4">
            <label for="email" class="leading-7 text-sm text-gray-600">{{ __('Email') }}</label>
            <input type="email" wire:model="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </div>
            <input type="hidden" wire:model="course_id" id="course_id" name="course_id" value="{{ $course->id }}" >
        <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" type="submit">{{ __('Get it !') }}</button>
            @if ($success == 'OK')
                <p class="text-sm mt-2 text-gray-500 mb-8 w-full text-green-500">{{ __('Check your mails to get the course !') }}</p>
            @elseif ($success == 'NOK')
                <p class="text-sm mt-2 text-gray-500 mb-8 w-full text-red-500">{{ __('Already a prospect !') }}</p>
            @else
                <p class="text-xs text-gray-500 mt-3">{{ __('You will receive an email with all the informations.') }}</p>
            @endif
        </form>
    </div>
