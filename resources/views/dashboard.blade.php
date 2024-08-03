<x-app-layout>
    <div>
        @include('components.alert')
        <div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="p-6 h-auto">
                    <section class="bg-white px-4 antialiased dark:bg-gray-900 ">
                        <div
                            class="mx-auto grid max-w-screen-xl rounded-lg bg-white dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16">
                            <div class="lg:col-span-5 lg:mt-0 justify-center">
                                <svg class="w-[300px] h-[300px] text-[#D4A34A] dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="me-auto place-self-center lg:col-span-7">
                                @if (Auth::user()->tipe_user_id == 11)
                                    @if (App\Models\Pemilik::where('user_id', Auth::user()->id)->exists())
                                        <h1
                                            class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                                            {{ __('Selamat datang, ') }} {{ Auth::user()->name }}!
                                        </h1>
                                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                                            {{ __('Pilih layanan yang Anda diperlukan di bawah') }}
                                        </p>
                                    @else
                                        <h1
                                            class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                                            {{ __('Selamat datang, ') }} {{ Auth::user()->name }}!
                                        </h1>
                                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                                            {{ __('Anda belum mengisi data diri Anda. Silahkan lengkapi data diri Anda terlebih dahulu.') }}
                                        </p>
                                        <a href="{{ route('pemilik.create') }}"
                                            class="inline-flex items-center py-3 px-5 text-sm font-medium text-center text-white bg-[#016452] rounded-lg focus:ring-4 focus:ring-[#014f415e] dark:focus:ring-primary-900 hover:bg-[#014F41]">
                                            {{ __('Isi data diri sebagai pemilik') }}</a>
                                    @endif
                                @endif
                                @if (Auth::user()->tipe_user_id == 12)
                                    @if (App\Models\Penyewa::where('user_id', Auth::user()->id)->exists())
                                        <h1
                                            class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                                            {{ __('Selamat datang, ') }} {{ Auth::user()->name }}!
                                        </h1>
                                    @else
                                        <h1
                                            class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                                            {{ __('Selamat datang, ') }} {{ Auth::user()->name }}!
                                        </h1>
                                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                                            {{ __('Anda belum mengisi data diri Anda. Silahkan lengkapi data diri Anda terlebih dahulu.') }}
                                        </p>
                                        <a href="{{ route('penyewa.create') }}"
                                            class="inline-flex items-center py-3 px-5 text-sm font-medium text-center text-white bg-[#016452] rounded-lg focus:ring-4 focus:ring-[#014f415e] dark:focus:ring-primary-900 hover:bg-[#014F41]">
                                            {{ __('Isi data diri sebagai penyewa') }}</a>
                                    @endif
                                @endif
                                @if (Auth::user()->tipe_user_id != 11 && Auth::user()->tipe_user_id != 12)
                                    <h1
                                        class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                                        {{ __('Selamat datang, ') }} {{ Auth::user()->name }}!
                                    </h1>
                                @endif
                            </div>
                        </div>
                    </section>
                    @if (Auth::user()->tipe_user_id == 11)
                        @if (App\Models\Pemilik::where('user_id', Auth::user()->id)->exists())
                            <div
                                class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-4 rounded-lg p-6 shadow-md sm:rounded-2xl bg-[#01645222]">
                                <a href=""
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Unit') }}</span>
                                </a>
                                <a href="#"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M9 15a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm3.845-1.855a2.4 2.4 0 0 1 1.2-1.226 1 1 0 0 1 1.992-.026c.426.15.809.408 1.111.749a1 1 0 1 1-1.496 1.327.682.682 0 0 0-.36-.213.997.997 0 0 1-.113-.032.4.4 0 0 0-.394.074.93.93 0 0 0 .455.254 2.914 2.914 0 0 1 1.504.9c.373.433.669 1.092.464 1.823a.996.996 0 0 1-.046.129c-.226.519-.627.94-1.132 1.192a1 1 0 0 1-1.956.093 2.68 2.68 0 0 1-1.227-.798 1 1 0 1 1 1.506-1.315.682.682 0 0 0 .363.216c.038.009.075.02.111.032a.4.4 0 0 0 .395-.074.93.93 0 0 0-.455-.254 2.91 2.91 0 0 1-1.503-.9c-.375-.433-.666-1.089-.466-1.817a.994.994 0 0 1 .047-.134Zm1.884.573.003.008c-.003-.005-.003-.008-.003-.008Zm.55 2.613s-.002-.002-.003-.007a.032.032 0 0 1 .003.007ZM4 14a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0v-4a1 1 0 0 1 1-1Zm3-2a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm6.5-8a1 1 0 0 1 1-1H18a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-.796l-2.341 2.049a1 1 0 0 1-1.24.06l-2.894-2.066L6.614 9.29a1 1 0 1 1-1.228-1.578l4.5-3.5a1 1 0 0 1 1.195-.025l2.856 2.04L15.34 5h-.84a1 1 0 0 1-1-1Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data IPL') }}</span>
                                </a>
                                <a href="#"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Diri') }}</span>
                                </a>
                                <a href="{{ route('komplain.create') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Ajukan Komplain') }}</span>
                                </a>
                                <!-- Tambahkan elemen lainnya sesuai kebutuhan -->
                            </div>
                        @endif
                    @endif
                    @if (Auth::user()->tipe_user_id != 11 && Auth::user()->tipe_user_id != 12)
                        <div
                            class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-4 rounded-lg p-6 shadow-md sm:rounded-2xl bg-[#01645222]">
                            @if (Auth::user()->tipe_user_id == 1)
                                <a href="{{ route('akun.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Akun') }}</span>
                                </a>
                            @endif
                            @if (Auth::user()->tipe_user_id == 1 || Auth::user()->tipe_user_id == 2 || Auth::user()->tipe_user_id == 3)
                                <a href="{{ route('pemilik.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Pemilik') }}</span>
                                </a>
                                <a href="{{ route('penyewa.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Penyewa') }}</span>
                                </a>
                                <a href="{{ route('komplain.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Komplain') }}</span>
                                </a>
                                <a href="{{ route('penanganan.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Penanganan') }}</span>
                                </a>
                            @endif
                            @if (Auth::user()->tipe_user_id == 1 || Auth::user()->tipe_user_id == 3)
                                <a href="{{ route('ipl.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M9 15a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm3.845-1.855a2.4 2.4 0 0 1 1.2-1.226 1 1 0 0 1 1.992-.026c.426.15.809.408 1.111.749a1 1 0 1 1-1.496 1.327.682.682 0 0 0-.36-.213.997.997 0 0 1-.113-.032.4.4 0 0 0-.394.074.93.93 0 0 0 .455.254 2.914 2.914 0 0 1 1.504.9c.373.433.669 1.092.464 1.823a.996.996 0 0 1-.046.129c-.226.519-.627.94-1.132 1.192a1 1 0 0 1-1.956.093 2.68 2.68 0 0 1-1.227-.798 1 1 0 1 1 1.506-1.315.682.682 0 0 0 .363.216c.038.009.075.02.111.032a.4.4 0 0 0 .395-.074.93.93 0 0 0-.455-.254 2.91 2.91 0 0 1-1.503-.9c-.375-.433-.666-1.089-.466-1.817a.994.994 0 0 1 .047-.134Zm1.884.573.003.008c-.003-.005-.003-.008-.003-.008Zm.55 2.613s-.002-.002-.003-.007a.032.032 0 0 1 .003.007ZM4 14a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0v-4a1 1 0 0 1 1-1Zm3-2a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm6.5-8a1 1 0 0 1 1-1H18a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-.796l-2.341 2.049a1 1 0 0 1-1.24.06l-2.894-2.066L6.614 9.29a1 1 0 1 1-1.228-1.578l4.5-3.5a1 1 0 0 1 1.195-.025l2.856 2.04L15.34 5h-.84a1 1 0 0 1-1-1Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data IPL') }}</span>
                                </a>
                            @endif
                            @if (Auth::user()->tipe_user_id == 1)
                                <a href="{{ route('tower.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Tower') }}</span>
                                </a>
                                <a href="{{ route('lantai.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Lantai') }}</span>
                                </a>
                                <a href="{{ route('unit.index') }}"
                                    class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-[#016452] px-4 py-6 hover:bg-[#014F41] dark:border-[#014F41] dark:bg-gray-800 dark:hover:bg-[#014F41]">
                                    <svg class="w-[48px] h-[48px] text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-white">{{ __('Data Unit') }}</span>
                                </a>
                            @endif
                            <!-- Tambahkan elemen lainnya sesuai kebutuhan -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
