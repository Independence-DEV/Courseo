@extends('layouts.account.template')

@section('main')

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">
                    @foreach ($post->categories as $category)
                        {{ $category->title }}
                    @endforeach
                </h2>
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $post->title }}</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ $post->content }}</p>
                <img src="{{ getImage($post) }}" alt="" style="width:100%">
            </div>
        </div>
    </section>

@endsection

