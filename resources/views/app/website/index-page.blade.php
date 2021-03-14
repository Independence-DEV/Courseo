<x-app-layout>
    @include('layouts.website-navigation')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:col-span-1">
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('app.website.indexPage.edit') }}" method="POST">
                                @csrf
                                <div class="shadow sm:rounded-md sm:overflow-hidden">
                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                                        <x-label for="content" :value="__('Content')" />

                                        <x-textarea id="content" class="block mt-1 w-full" name="content" :value="isset($indexPage) ? $indexPage->content : ''" />

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
