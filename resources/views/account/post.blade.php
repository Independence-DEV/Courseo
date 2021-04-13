@extends('layouts.account.template')

@section('main')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto">
            <div class="flex flex-col text-center w-full mb-4">
                <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">
                    @foreach ($post->categories as $category)
                        {{ $category->title }}
                    @endforeach
                </h2>
                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">{{ $post->title }}</h1>
                <div>
                    @foreach ($post->tags as $tag)
                        <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">
                            {{ $tag->tag }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4">
                {!! $post->content !!}
            </div>
        </div>
    </section>
@endsection
