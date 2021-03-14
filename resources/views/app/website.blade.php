<x-app-layout>
    @include('layouts.website-navigation')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                            <div class="md:col-span-1">
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ route('app.website.config.edit') }}" method="POST">
                                    @csrf
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <div class="grid grid-cols-4 gap-6">
                                                <div class="col-span-3 sm:col-span-2">
                                                    <x-label for="name" :value="__('Website Name')" />

                                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($account) ? $account->name : ''" />
                                                </div>

                                                <div class="col-span-3 sm:col-span-2">
                                                    <x-label for="subdomain" :value="__('Website Domain')" />

                                                    <div class="mt-1 flex rounded-md shadow-sm">
                  <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    https://
                  </span>
                                                        <input type="text" name="subdomain" id="subdomain" value="{{$account->subdomain}}" class="w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:ring-2 focus:ring-red-200 focus:bg-transparent focus:border-red-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" disabled>
                                                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    .courseo.tech
                  </span>
                                                    </div>
                                                </div>


                                            <div class="col-span-3 sm:col-span-2">
                                                <x-label for="logo" :value="__('Logo')" />
                                                <a id="lfm" data-input="logo" data-preview="holder" class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg" type="button">{{ __('Add my logo') }}</a>
                                                <x-input id="logo" class="block mt-1 w-full" type="text" name="logo" :value="isset($config->logo) ? $config->logo : ''" readonly />
                                            </div>
                                                <div class="col-span-3 sm:col-span-2">
                                                    <div id="holder" class="text-center" style="margin-bottom:15px;">
                                                        @isset($config->logo)
                                                            <img style="max-height: 150px;" src="{{ $config->logo }}" alt="">
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="hidden sm:block" aria-hidden="true">
                                                    <div class="py-2">
                                                        <div class="border-t border-gray-200"></div>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-4 gap-6">
                                                <div class="col-span-3 sm:col-span-2">

                                                    <x-label for="facebook_link" :value="__('Facebook Link')" />

                                                    <x-input id="facebook_link" class="block mt-1 w-full" type="text" name="facebook_link" :value="isset($config) ? $config->facebook_link : ''" />


                                                </div>
                                                <div class="col-span-3 sm:col-span-2">
                                                    <x-label for="twitter_link" :value="__('Twitter Link')" />

                                                    <x-input id="twitter_link" class="block mt-1 w-full" type="text" name="twitter_link" :value="isset($config) ? $config->twitter_link : ''" />
                                                </div>
                                            </div>


                                            <div class="grid grid-cols-4 gap-6">
                                                <div class="col-span-3 sm:col-span-2">
                                                    <x-label for="instagram_link" :value="__('Instagram Link')" />

                                                    <x-input id="instagram_link" class="block mt-1 w-full" type="text" name="instagram_link" :value="isset($config) ? $config->instagram_link : ''" />
                                                </div>
                                                <div class="col-span-3 sm:col-span-2">
                                                    <x-label for="linkedin_link" :value="__('LinkedIn Link')" />

                                                    <x-input id="linkedin_link" class="block mt-1 w-full" type="text" name="linkedin_link" :value="isset($config) ? $config->linkedin_link : ''" />
                                                </div>
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
    </div>
</x-app-layout>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
</script>
