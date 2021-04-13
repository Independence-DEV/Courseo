<style>
    /* Tab content - closed */
    .tab-content {
        max-height: 0;
        -webkit-transition: max-height .35s;
        -o-transition: max-height .35s;
        transition: max-height .35s;
    }
    /* :checked - resize to full height */
    .tab input:checked ~ .tab-content {
        max-height: 100vh;
    }
    /* Label formatting when open */
    .tab input:checked + label{
        /*@apply text-xl p-5 border-l-2 border-indigo-500 bg-gray-100 text-indigo*/
        font-size: 1.25rem; /*.text-xl*/
        padding: 1.25rem; /*.p-5*/
        border-left-width: 2px; /*.border-l-2*/
        border-color: #ef4444; /*.border-indigo*/
        background-color: #f8fafc; /*.bg-gray-100 */
        color: #ef4444; /*.text-indigo*/
    }
    /* Icon */
    .tab label::after {
        float:right;
        right: 0;
        top: 0;
        display: block;
        width: 1.5em;
        height: 1.5em;
        line-height: 1.5;
        font-size: 1.25rem;
        text-align: center;
        -webkit-transition: all .35s;
        -o-transition: all .35s;
        transition: all .35s;
    }
    /* Icon formatting - closed */
    .tab input[type=checkbox] + label::after {
        content: "+";
        font-weight:bold; /*.font-bold*/
        border-width: 1px; /*.border*/
        border-radius: 9999px; /*.rounded-full */
        border-color: #ef4444; /*.border-grey*/
    }
    .tab input[type=radio] + label::after {
        content: "\25BE";
        font-weight:bold; /*.font-bold*/
        border-width: 1px; /*.border*/
        border-radius: 9999px; /*.rounded-full */
        border-color: #ef4444; /*.border-grey*/
    }
    /* Icon formatting - open */
    .tab input[type=checkbox]:checked + label::after {
        transform: rotate(315deg);
        background-color: #ef4444; /*.bg-indigo*/
        color: #f8fafc; /*.text-grey-lightest*/
    }
    .tab input[type=radio]:checked + label::after {
        transform: rotateX(180deg);
        background-color: #ef4444; /*.bg-indigo*/
        color: #f8fafc; /*.text-grey-lightest*/
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('app.courses.list') }}" class="inline-block align-middle" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 w-7 text-gray-500 hover:text-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg></a>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block align-middle">
            {{ __('Manage a course') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:col-span-1">
                <div class="grid grid-cols-3 gap-4">

                    <div class="col-span-3 bg-white sm:col-span-2 shadow sm:rounded-md sm:overflow-hidden">
                        <form action="{{ route('app.courses.course.update', ['id' => $course->id]) }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 space-y-6 sm:p-6 ">
                                <div class="grid grid-cols-4 gap-4">
                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="title" :value="__('Title')" />

                                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$course->title" required />
                                    </div>

                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="slug" :value="__('Slug')" />

                                        <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="$course->slug" required />
                                    </div>

                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="description" :value="__('Description')" />

                                        <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" :value="$course->description" required />
                                    </div>

                                    <div class="col-span-3 sm:col-span-2">
                                        <x-label for="image" :value="__('Image')" />
                                        <a id="lfm" data-input="image" data-preview="holder" class="inline-flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg" type="button">{{ __('Add an image') }}</a>
                                        <x-input id="image" class="block mt-1 w-full" type="text" name="image" :value="isset($course->image) ? $course->image : ''" readonly />
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <div id="holder" class="text-center" style="margin-bottom:15px;">
                                            @isset($course->image)
                                                <img style="max-height: 250px;" src="{{ $course->image }}" alt="">
                                            @endisset
                                        </div>
                                    </div>

                                    <div class="col-span-1 sm:col-span-1">
                                        <x-label for="price" :value="__('Price')" />
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" min="0" step="any" name="price" id="price" value="{{ $course->price }}" class="w-full bg-gray-100 bg-opacity-50 border border-gray-300 focus:ring-2 focus:ring-red-200 focus:bg-transparent focus:border-red-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                                            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">€</span>
                                        </div>
                                    </div>

                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="presentation" :value="__('Presentation')" />

                                        <x-textarea id="presentation" class="block mt-1 w-full" name="presentation" :value="$course->presentation" required />
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
                                <x-course-nav-link href="{{ route('app.courses.course.edit', $course->id) }}" :active="request()->routeIs('app.courses.course.edit')" class="col-span-4 sm:col-span-4 m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Course Configuration') }}
                                </x-course-nav-link>
                                <x-course-nav-link href="{{ route('app.courses.course.edit.chapter.create', $course->id) }}" :active="request()->routeIs('app.courses.course.edit.chapter.create')" class="col-span-2 sm:col-span-2 m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Add Chapter') }}
                                </x-course-nav-link>
                                <x-course-nav-link href="{{ route('app.courses.course.edit.lesson.create', $course->id) }}" :active="request()->routeIs('app.courses.course.edit.lesson.create')" class="col-span-2 sm:col-span-2 m-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 inline-block align-middle">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Add Lesson') }}
                                </x-course-nav-link>
                            </div>


                            <div class="w-full mx-auto">
                                <div class="shadow-md">
                                    @foreach($chapters as $chapter)
                                        <div class="tab w-full overflow-hidden border-t">
                                            <input class="absolute opacity-0" id="{{ $chapter->slug }}" type="radio" name="tabs">
                                            <label class="block p-5 leading-normal cursor-pointer" for="{{ $chapter->slug }}">{{ $chapter->title }}</label>
                                            <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-red-500 leading-normal">
                                                <ul class="px-0">
                                                    @foreach($lessons[$chapter->id] as $lesson)
                                                        <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'><a href="{{ route('app.courses.course.edit.lesson.edit', ["id" => $course->id, "lesson_id" => $lesson->id]) }}">{{ $lesson->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
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
        $('#slug').keyup(function () {
            $(this).val(getSlug($(this).val()))
        })
        $('#title').keyup(function () {
            $('#slug').val(getSlug($(this).val()))
        })
    });
    CKEDITOR.replace('presentation', { customConfig: '{{ asset('js/ckeditor.js') }}' });
    /* Optional Javascript to close the radio button version by clicking it again */
    var myRadios = document.getElementsByName('tabs');
    var setCheck;
    var x = 0;
    for(x = 0; x < myRadios.length; x++){
        myRadios[x].onclick = function(){
            if(setCheck != this){
                setCheck = this;
            }else{
                this.checked = false;
                setCheck = null;
            }
        };
    }
</script>
