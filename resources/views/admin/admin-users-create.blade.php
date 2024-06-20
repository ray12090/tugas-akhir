<x-app-layout>
    <div>
        <div class="pb-6">
            @include('components.alert')
            @include('components.breadcrumbs', [
                'breadcrumbs' => [
                    [
                        'title' => 'Dashboard',
                        'url' =>
                            Auth::user()->usertype === 'admin' ? route('admin-dashboard') : route('dashboard'),
                    ],
                    ['title' => 'Data Akun', 'url' => route('akun.index')],
                    ['title' => 'Tambah Akun', 'url' => ''],
                ],
            ])
        </div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Tambah Akun') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk menambah data akun. Isi formulir ini dapat diisi oleh Admin') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return confirmSave(this);">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="w-full">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Nama') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="name" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            required>
                                    </div>
                                </div>
                                <div class="sm:col-span-3"></div>
                                <div class="w-full">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Email') }}
                                    </label>
                                    <input type="text" name="email" id="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required>
                                </div>
                                <div class="sm:col-span-3"></div>
                                <div class="w-full">
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Password') }}
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                </div>
                                <div class="sm:col-span-3"></div>
                                <div class="w-full">
                                    <label for="usertype"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tipe Akun') }}</label>
                                    <select name="usertype" id="usertype"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled class="text-gray-400">Pilih Tipe Akun</option>
                                        <option value="admin">Admin</option>
                                        <option value="eg">Engineering</option>
                                        <option value="fa">Finance</option>
                                        <option value="tr">Tenant Relation</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-3"></div>
                                <div class="sm:col-span-3">
                                    <a href="{{ route('akun.index') }}"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Batal') }}
                                    </a>
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                        <svg class="w-[16px] h-[16px] text-white dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7.414A2 2 0 0 0 20.414 6L18 3.586A2 2 0 0 0 16.586 3H5Zm3 11a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v6H8v-6Zm1-7V5h6v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M14 17h-4v-2h4v2Z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('components.modal', ['type' => 'confirmation'])
    </div>
</x-app-layout>
