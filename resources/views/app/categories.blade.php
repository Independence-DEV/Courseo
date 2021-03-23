<x-app-layout>
    @include('layouts.blog-navigation')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:col-span-1">
                <div class="grid grid-cols-3 gap-4">

                    <div class="col-span-3 bg-white sm:col-span-2 shadow sm:rounded-md sm:overflow-hidden">
                        <form method="post" action="{{ Route::currentRouteName() === 'app.blog.categories.edit' ? route('app.blog.categories.update', ['id' => $current_category->id]) : route('app.blog.categories.store') }}">
                            @if(Route::currentRouteName() === 'app.blog.categories.edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="px-4 py-5 space-y-6 sm:p-6 ">
                                <div class="grid grid-cols-4 gap-4">
                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="title" :value="__('Title')" />

                                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="isset($current_category) ? $current_category->title : ''" required />
                                    </div>
                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="slug" :value="__('Slug')" />

                                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="isset($current_category) ? $current_category->slug : ''" required />
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-button class="ml-3">
                                    {{ __('Save') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                    <div class="col-span-3 sm:col-span-1 bg-white shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 space-y-6 sm:p-6">
                            <div class="grid grid-cols-4 gap-2">
                                <x-course-nav-link href="{{ route('app.blog.categories.index') }}" :active="request()->routeIs('app.blog.categories.index')" class="col-span-4 sm:col-span-4 m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Add a category') }}
                                </x-course-nav-link>
                            </div>
                            <div class="w-full mx-auto">
                                    @foreach($categories as $category)
                                        <a href="{{ route('app.blog.categories.edit', ['id' => $category->id]) }}"
                                           @if(isset($current_category) && ($current_category->id == $category->id))
                                                class="flex justify-start cursor-pointer text-white bg-red-500 rounded-md px-2 py-2 my-2"
                                           @else
                                                class="flex justify-start cursor-pointer text-gray-700 hover:text-white hover:bg-red-500 rounded-md px-2 py-2 my-2"
                                            @endif

                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                            <div class="flex-grow font-medium px-2">{{ $category->title }}</div>
                                        </a>
                                    @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
<script>
    $(function() {
        $('#slug').keyup(function () {
            $(this).val(getSlug($(this).val()))
        })
        $('#title').keyup(function () {
            $('#slug').val(getSlug($(this).val()))
        })
    });
</script>
