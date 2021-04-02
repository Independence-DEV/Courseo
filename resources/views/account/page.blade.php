@extends('layouts.account.template')

@section('main')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto">
            @if (!empty($page))
                {!! $page->content !!}
            @endif
        </div>
    </section>
@endsection

