<x-app-layout>
    @include('layouts.blog-navigation')

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:col-span-1">
                <div class="grid grid-cols-3 gap-4">

                    <div class="col-span-3 bg-white sm:col-span-2 shadow sm:rounded-md sm:overflow-hidden">
                        <form action="{{ route('app.courses.course.store') }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 space-y-6 sm:p-6 ">
                                <div class="grid grid-cols-4 gap-4">
                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="title" :value="__('Title')" />

                                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$course->title" required />
                                    </div>

                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="slug" :value="__('Slug')" />

                                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="$course->title" required />
                                    </div>

                                    <div class="col-span-1 sm:col-span-1">
                                        <x-label for="price" :value="__('Price')" />
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" min="0" step="any" name="price" id="price" value="{{ $course->price }}" class="w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:ring-2 focus:ring-red-200 focus:bg-transparent focus:border-red-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                                            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">€</span>
                                        </div>
                                    </div>


                                    <div class="col-span-3 sm:col-span-3">
                                        <x-label for="stripe_id" :value="__('Stripe API Key')" :tooltip="__('You can find your Stripe API Key on your Stripe account')" />

                                        <x-input id="stripe_id" class="block mt-1 w-full" type="text" name="stripe_id" :value="$course->stripe_id" />
                                    </div>

                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="presentation" :value="__('Presentation')" />

                                        <x-textarea id="presentation" class="block mt-1 w-full" name="presentation" :value="$course->presentation" required />
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-button class="ml-3">
                                    {{ __('Save') }}
                                </x-button>
                            </div>
                        </form>
                    </div>

                    <div class="col-span-3 sm:col-span-1 bg-white shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 space-y-6 sm:p-6">
                            <div class="grid grid-cols-4 gap-2">
                                <x-course-nav-link href="#" :active="request()->routeIs('app.courses.course.edit')" class="col-span-4 sm:col-span-4 m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Course Configuration') }}
                                </x-course-nav-link>
                                <x-course-nav-link href="#" :active="request()->routeIs('app.courses.course')" class="col-span-2 sm:col-span-2 m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Add Chapter') }}
                                </x-course-nav-link>
                                <x-course-nav-link href="#" :active="request()->routeIs('app.courses.course')" class="col-span-2 sm:col-span-2 m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Add Lesson') }}
                                </x-course-nav-link>
                            </div>


                            <div class="w-full mx-auto">
                                <div class="shadow-md">
                                    @foreach($chapters as $chapter)
                                        <div class="tab w-full overflow-hidden border-t">
                                            <input class="absolute opacity-0" id="{{ $chapter->slug }}" type="radio" name="tabs2">
                                            <label class="block p-5 leading-normal cursor-pointer" for="{{ $chapter->slug }}">{{ $chapter->title }}</label>
                                            <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-red-500 leading-normal">
                                                <ul class="px-0">
                                                    @foreach($lessons[$chapter->id] as $lesson)
                                                        <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>{{ $lesson->title }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
