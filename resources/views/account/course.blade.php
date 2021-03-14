@extends('layouts.account.template')

@section('main')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                <h1 class="title-font font-medium text-3xl text-gray-900">{{ $course->title }}</h1>
                <p class="leading-relaxed mt-4">{{ $course->description }}</p>
            </div>
            <livewire:formcourseprospect :course="$course"/>

            <div>
            {{ $course->presentation }}
            </div>
        </div>
    </section>
@endsection


