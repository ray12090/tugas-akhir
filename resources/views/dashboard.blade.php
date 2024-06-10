<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard ') }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div>
        <div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
