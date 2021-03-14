<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('app.blog.posts') }}" class="inline-block align-middle" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 w-7 text-gray-500 hover:text-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg></a>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block align-middle">
            {{ __('Create a new post') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('app.blog.post.store') }}" method="POST">
                            @csrf
                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    <div>
                                        <x-label for="title" :value="__('Title')" />

                                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                                    </div>

                                    <div>
                                        <x-label for="description" :value="__('Description')" />

                                        <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                                    </div>

                                    <div>
                                        <x-label for="content" :value="__('Content')" />

                                        <x-textarea id="content" class="block mt-1 w-full" name="content" :value="old('content')" required />
                                    </div>

                                    <div>
                                        <x-label for="categories" :value="__('Categories')" />

                                        <x-textarea id="categories" class="block mt-1 w-full" type="selectMultiple" name="categories" :value="old('description')" required />
                                    </div>

                                    <div>
                                        <x-label for="tags" :value="__('Tags')" />

                                        <x-input id="tags" class="block mt-1 w-full" type="text" name="tags" :value="old('tags')" required />
                                    </div>

                                    <div class="hidden sm:block" aria-hidden="true">
                                        <div class="py-2">
                                            <div class="border-t border-gray-200"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <x-label for="seo_title" :value="__('SEO Title')" />

                                        <x-input id="seo_title" class="block mt-1 w-full" type="text" name="seo_title" :value="old('seo_title')" />
                                    </div>

                                    <div>
                                        <x-label for="meta_description" :value="__('META Description')" />

                                        <x-textarea id="meta_description" class="block mt-1 w-full" type="text" name="meta_description" :value="old('meta_description')" />
                                    </div>

                                    <div>
                                        <x-label for="meta_keywords" :value="__('META keywords')" />

                                        <x-textarea id="meta_keywords" class="block mt-1 w-full" type="text" name="meta_keywords" :value="old('meta_keywords')" />
                                    </div>

                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <x-button class="ml-3">
                                        {{ __('Save') }}
                                    </x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
    $(function() {
        $.fn.filemanager = function(type, options) {
            type = type || 'file';
            this.on('click', function(e) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                var target_input = $('#' + $(this).data('input'));
                var target_preview = $('#' + $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    var file_path = items.map(function (item) {
                        return item.url;
                    }).join(',');
                    // set the value of the desired input to image url
                    target_input.val('').val(file_path).trigger('change');
                    // clear previous preview
                    target_preview.html('');
                    // set or change the preview image src
                    items.forEach(function (item) {
                        target_preview.append(
                            $('<img>').attr('src', item.thumb_url)
                        );
                    });
                    // trigger change event
                    target_preview.trigger('change');
                };
                return false;
            });
        }
        $('#lfm').filemanager('image');
    });
    CKEDITOR.replace('content', { customConfig: '{{ asset('js/ckeditor.js') }}' });
</script>
