<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('users-management') }}" class="flex items-center p-2 rounded-lg transition duration-200 text-gray-800">
            <x-heroicon-o-users class="w-6 h-6" />
            <h2 class="text-lg leading-tight ml-2">
                User Management
            </h2>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('user-management.partials.OverviewUsers')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>