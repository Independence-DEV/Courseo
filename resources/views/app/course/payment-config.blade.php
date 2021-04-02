<x-app-layout>
    @include('layouts.courses-navigation')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:col-span-1">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('app.courses.paymentConfig.update') }}" method="POST">
                                @csrf
                                <div class="shadow sm:rounded-md sm:overflow-hidden">
                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                        <div class="grid grid-cols-4 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <x-label for="stripe_publishable_key" :value="__('Stripe Publishable key')" :tooltip="__('You can find the Stripe API Key on your Stripe account')"/>

                                                <x-input id="stripe_publishable_key" class="block mt-1 w-full" type="text" name="stripe_publishable_key" :value="isset($configPayment) ? $configPayment->stripe_publishable_key : ''" />
                                            </div>

                                            <div class="col-span-3 sm:col-span-2">
                                                <x-label for="stripe_secret_key" :value="__('Stripe Secret key')" :tooltip="__('You can find the Stripe API Key on your Stripe account')"/>

                                                <x-input id="stripe_secret_key" class="block mt-1 w-full" type="password" name="stripe_secret_key" :value="isset($configPayment) ? $configPayment->stripe_secret_key : ''" />

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
</x-app-layout>
