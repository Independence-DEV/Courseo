<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block align-middle">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:col-span-1">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('app.user.edit') }}" method="POST">
                                @csrf
                                <div class="shadow sm:rounded-md sm:overflow-hidden">
                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                        <div class="grid grid-cols-4 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <x-label for="name" :value="__('Account Name')" />

                                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($user) ? $user->name : ''" />
                                            </div>

                                            <div class="col-span-3 sm:col-span-2">
                                                <x-label for="email" :value="__('Account Email')" />

                                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="isset($user) ? $user->email : ''" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <x-button class="ml-3">
                                            {{ __('Save') }}
                                        </x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
