<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <x-input-label for="password_confirmation" :value="__('Daftar Sebagai')" />
        </div>

        <div class="flex items-center mt-4 justify-start">
            <div class="mr-8">
                <input id="tipe_user_id" type="radio" value="11" name="tipe_user_id"
                    class="w-4 h-4 border-gray-300 text-[#014F41] shadow-sm focus:ring-[#016452]">
                <label for="tipe_user_id" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ __('Pemilik') }}
                </label>
            </div>
            <div>
                <input id="tipe_user_id" type="radio" value="12" name="tipe_user_id"
                    class="w-4 h-4 border-gray-300 text-[#014F41] shadow-sm focus:ring-[#016452]">
                <label for="tipe_user_id" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ __('Penyewa') }}
                </label>
            </div>
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-[#016452] hover:bg-[#014F41] text-white font-bold py-2 px-4 rounded-full">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
