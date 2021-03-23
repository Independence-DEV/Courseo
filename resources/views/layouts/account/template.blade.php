<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="{{ isset($post) && $post->meta_description ? $post->meta_description : __(config('app.description')) }}">
    <meta name="author" content="{{ isset($account) ? $account->name : __(config('app.author')) }}">
    @if(isset($post) && $post->meta_keywords)
        <meta name="keywords" content="{{ $post->meta_keywords }}">
    @endif

    <title>{{ $account->name }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    @yield('style')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="antialiased">
<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="{{ route('account.index', ['account_subdomain' => $account->subdomain]) }}">
            <img style="max-height: 50px;" src="{{ $config->logo }}" alt="">
            <span class="ml-3 text-xl">{{ $account->name }}</span>
        </a>
        <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
            <a class="mr-5 hover:text-gray-900" href="{{ route('account.posts', ['account_subdomain' => $account->subdomain]) }}">Blog</a>
            <a class="mr-5 hover:text-gray-900" href="{{ route('account.courses', ['account_subdomain' => $account->subdomain]) }}">Courses</a>
        </nav>
        <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
            @if($config->facebook_link)
      <a class="text-gray-500 hover:text-blue-600" href="{{ $config->facebook_link }}">
        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 " viewBox="0 0 24 24">
          <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
        </svg>
      </a>
            @endif
            @if($config->twitter_link)
      <a class="ml-3 text-gray-500 hover:text-blue-400" href="{{ $config->twitter_link }}">
        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
        </svg>
      </a>
            @endif
            @if($config->instagram_link)
      <a class="ml-3 text-gray-500 hover:text-red-500" href="{{ $config->instagram_link }}">
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
          <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
        </svg>
      </a>
            @endif
            @if($config->linkedin_link)
      <a class="ml-3 text-gray-500 hover:text-blue-800" href="{{ $config->linkedin_link }}">
        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
          <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
          <circle cx="4" cy="4" r="2" stroke="none"></circle>
        </svg>
      </a>
            @endif
    </span>
    </div>
</header>
@yield('main')
<footer class="text-gray-600 body-font">
    <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
        <p class="text-sm text-gray-500 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
            {{ __('Powered by') }}<a href="https://courseo.tech/" class="underline text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">Courseo</a>
        </p>
    </div>
</footer>
</body>
@livewireScripts
</html>
