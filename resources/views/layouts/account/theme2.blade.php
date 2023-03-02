<!DOCTYPE html>
<html class="no-js" lang="{{ $config->lang }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ $config->favicon }}" type="image/x-icon"/>

    <title>{{ (isset($post) && $post->seo_title) ? $post->seo_title : $account->name }}</title>
    <meta name="description" content="{{ (isset($post) && $post->meta_description) ? $post->meta_description : __(config('app.description')) }}">
    <meta name="author" content="{{ $account->name }}">
    @if(isset($post) && $post->meta_keywords)
        <meta name="keywords" content="{{ $post->meta_keywords }}">
    @endif

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="antialiased">

<header class="p-4 sm:p-6 bg-gray-800">
    <div class="mx-auto max-w-screen-xl">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="{{ route('account.index', ['domain' => $domain]) }}">
            <img src="https://www.independence-dev.com/assets/logo.svg" class="mr-3 h-8" alt="Independence DEV Logo"/>
        </a>
        <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4	flex flex-wrap items-center text-base justify-center">
            @if($postNumber)
                <a class="mr-5 hover:text-gray-900" href="{{ route('account.posts', ['domain' => $domain]) }}">Blog</a>
            @endif
            @if($courseNumber)
                <a class="mr-5 hover:text-gray-900" href="{{ route('account.courses', ['domain' => $domain]) }}">Courses</a>
            @endif
            @foreach($customPages as $customPage)
                 <a class="mr-5 hover:text-gray-900" href="{{ route('account.page', ['domain' => $domain, 'slug' => $customPage->slug]) }}">{{ $customPage->title }}</a>
            @endforeach
            @if($contactPage->active)
                 <a class="mr-5 hover:text-gray-900" href="{{ route('account.contact', ['domain' => $domain]) }}">Contact</a>
             @endif
        </nav>
    </div>
</header>
@yield('main')
<footer class="p-4 sm:p-6 bg-gray-800">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a class="flex items-center">
                    <img src="https://www.independence-dev.com/assets/logo.svg" class="mr-3 h-8" alt="Independence DEV Logo"/>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Ressources</h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <p class="hover:underline">
                            Blog
                            </p>
                        </li>
                        <li>
                            <a href="https://formations.independence-dev.com/" class="hover:underline">Formations</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Suivez-moi</h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a href="https://twitter.com/geof_dev" class="hover:underline">Twitter</a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/c/IndependenceDEV?sub_confirmation=1" class="hover:underline ">YouTube</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Liens affiliés</h2>
                    <ul class="text-gray-400">
                        <li class="mb-4">
                            <a href="https://www.coinbase.com/fr/join/bernic_9s" class="hover:underline">Reçois $10 en Bitcoin</a>
                        </li>
                        <li>
                            <a href="https://www.binance.com/fr/activity/referral/offers/claim?ref=CPA_00E99Z7FID" class="hover:underline">100 USDT offerts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8"/>
        <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm sm:text-center text-gray-400">© 2022 Independence DEV. Tous droits réservés.
                </span>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                @if($config->youtube_link)
                <a href="{{ $config->youtube_link }}" class="text-gray-500 hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 576 512" aria-hidden="true">
                        <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/>
                    </svg>
                </a>
                @endif
                @if($config->facebook_link)
                <a href="{{ $config->facebook_link }}" class="text-gray-500 hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 512 512" aria-hidden="true">
                        <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                    </svg>
                </a>
                @endif
                @if($config->twitter_link)
                <a href="{{ $config->twitter_link }}" class="text-gray-500 hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 512 512" aria-hidden="true">
                        <path
                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>
                    </svg>
                </a>
                @endif
                @if($config->instagram_link)
                <a href="{{ $config->instagram_link }}" class="text-gray-500 hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512" aria-hidden="true">
                        <path
                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                    </svg>
                </a>
                @endif
                @if($config->tiktok_link)
                <a href="{{ $config->tiktok_link }}" class="text-gray-500 hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512" aria-hidden="true">
                        <path
                            d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                    </svg>
                </a>
                @endif
            </div>
        </div>
    </div>
</footer>
</body>
@livewireScripts
</html>
