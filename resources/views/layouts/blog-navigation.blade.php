<x-slot name="header">
    <div class="hidden sm:block sm:ml-6">
        <div class="flex space-x-4">
            <x-subnav-link :href="route('app.blog.posts')" :active="request()->routeIs('app.blog.posts')">
                {{ __('Posts') }}
            </x-subnav-link>
            <x-subnav-link :href="route('app.blog.categories')" :active="request()->routeIs('app.blog.categories')">
                {{ __('Categories') }}
            </x-subnav-link>
        </div>
    </div>
</x-slot>
