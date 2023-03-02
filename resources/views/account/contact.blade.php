@extends('layouts.account.theme'.$config->theme_id)

@section('main')
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-4 mx-auto">
            <div class="flex flex-col text-center w-full mb-6">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ __('Contact') }}</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ __('You can use this form to contact me !') }}</p>
            </div>
            <form action="{{ route('account.contact.send', ['domain' => $domain]) }}" method="POST">
                @csrf
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                            <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">Name*</label>
                                    <input type="text" id="name" name="name" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="email" class="leading-7 text-sm text-gray-600">Email*</label>
                                    <input type="email" id="email" name="email" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="message" class="leading-7 text-sm text-gray-600">Message*</label>
                                    <textarea id="message" name="message" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="g-recaptcha flex justify-center" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY')  }}"></div>
                            </div>
                            <div class="p-2 w-full">
                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    {{ __('Send') }}
                                </button>
                            </div>
                            <input id="account_id" name="account_id" type="hidden" value="{{ $account->id }}">
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
