<x-slot name="header">
    <div class="hidden sm:block sm:ml-6">
        <div class="flex space-x-4">
            <x-subnav-link :href="route('app.courses.list')" :active="request()->routeIs('app.courses.list')">
                {{ __('Courses') }}
            </x-subnav-link>
            <x-subnav-link :href="route('app.courses.list')" :active="request()->routeIs('app.courses.customers')">
                {{ __('Customers') }}
            </x-subnav-link>
            <x-subnav-link :href="route('app.courses.list')" :active="request()->routeIs('app.courses.prospects')">
                {{ __('Prospects') }}
            </x-subnav-link>
        </div>
    </div>
</x-slot>
