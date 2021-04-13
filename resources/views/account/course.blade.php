@extends('layouts.account.template')

@section('main')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                <div
                    class="text-s inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ $course->price }} €
                </div>
                <h1 class="title-font font-medium text-3xl text-gray-900">{{ $course->title }}</h1>
                <p class="leading-relaxed mt-4">{{ $course->description }}</p>
            </div>
            <livewire:formcourseprospect :course="$course"/>
            <div class="px-5 py-4">
                {!! $course->presentation !!}
            </div>
            <div class="px-5 py-4">
                <h2>{{ __('Course Content') }}</h2>
                @foreach($course->chapters as $chapter)
                    <h3>{{ $chapter->title }}</h3>
                    @foreach($chapter->lessons as $lesson)
                        <h4>{{ $lesson->title }}</h4>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection
