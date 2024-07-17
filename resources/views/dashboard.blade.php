<x-app-layout>
    <div>
        <div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang, ") }}{{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
