<x-app-layout>
    <x-slot name="header">
    <a href="{{ route('app.courses.list') }}" class="inline-block align-middle" >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 w-7 text-gray-500 hover:text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
        </svg></a>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block align-middle">
        {{ __('Create a new course') }}
    </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:col-span-1">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-3 sm:col-span-3 shadow sm:rounded-md sm:overflow-hidden">
                        <form action="{{ route('app.courses.course.store') }}" method="POST">
                            @csrf
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6 ">
                            <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-4 sm:col-span-4">
                                <x-label for="title" :value="__('Title')" />

                                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="isset($account) ? $account->name : ''" required />
                            </div>

                            <div class="col-span-4 sm:col-span-4">
                                <x-label for="description" :value="__('Description')" />

                                <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                            </div>

                            <div class="col-span-1 sm:col-span-1">
                                <x-label for="price" :value="__('Price')" />
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" min="0" step="any" name="price" id="price" class="w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:ring-2 focus:ring-red-200 focus:bg-transparent focus:border-red-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                                    <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">€</span>
                                </div>
                            </div>


                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="stripe_id" :value="__('Stripe API Key')" :tooltip="__('You can find the Stripe API Key on your Stripe account')" />

                                <x-input id="stripe_id" class="block mt-1 w-full" type="text" name="stripe_id" :value="isset($account) ? $account->name : ''" />
                            </div>

                            <div class="col-span-4 sm:col-span-4">
                                <x-label for="presentation" :value="__('Presentation')" />

                                <x-textarea id="presentation" class="block mt-1 w-full" name="presentation" :value="old('presentation')" required />
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
