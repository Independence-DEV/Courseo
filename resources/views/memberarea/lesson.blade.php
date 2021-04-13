@extends('layouts.memberarea')

@section('main')

    <div class="font-sans">
        <div class="flex flex-col sm:flex-row">
            <div class="w-64 h-screen bg-white">
                <div class="flex items-center justify-center mt-6">
                    <a class="flex title-font font-medium items-center text-gray-900 md:mb-0" href="{{ route('account.memberarea.home', ['domain' => $domain]) }}">
                        <span class="ml-3 text-xl">{{ $account->name }}</span>
                    </a>
                </div>

                <nav class="mt-6">
                    @foreach($chapters as $chapter)
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex justify-between items-center py-3 px-6 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                        <span class="flex items-center">

                            <span class="font-medium">{{ $chapter->title }}</span>
                        </span>
                                <span>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                            </button>

                            <div x-show="open" class="bg-gray-100">
                                @foreach($lessons[$chapter->id] as $lesson)
                                    <a class="py-2 px-8 block text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="{{ route('account.memberarea.lesson', ['domain' => $domain, 'slug' => $course->slug, 'chapterSlug' => $chapter->slug, 'lessonSlug' => $lesson->slug]) }}">{{ $lesson->title }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </nav>
                <div class="bottom-0 my-8">
                    <p class="flex items-center py-2 px-8 text-sm text-gray-500 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
                        {{ __('Powered by') }}<a href="https://courseo.tech/" class="underline text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">Courseo</a>
                    </p>
                </div>
            </div>

            <div class=" w-full bg-gray-100 sm:py-8 py-16 sm:px-10 px-6 relative">
                <h2 class="text-center sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $currentLesson->title }}</h2>
                @if(!empty($currentLesson->video))
                    <div class="relative" style="padding-top: 56.25%">
                        <iframe src="{{ $currentLesson->video }}" title="{{ $currentLesson->title }}" class="absolute inset-0 w-full h-full" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @endif
                {!! $currentLesson->content !!}
            </div>
        </div>
    </div>

@endsection
