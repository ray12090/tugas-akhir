<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Penyewa') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Berikut adalah detail informasi dari penyewa yang dipilih.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden mt-4">
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form>
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Unit') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->unit->nama_unit }}">
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('NIK') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->nik }}">
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="warga_negara_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Warga Negara') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->detailKewarganegaraan->status_kewarganegaraan }}">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="agama_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Agama') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->detailAgama->nama_agama }}">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="perkawinan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Perkawinan') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->detailPerkawinan->status_perkawinan }}">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email Penyewa') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->user ? $penyewa->user->email : 'Belum ada akun' }}">
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="nama_penyewa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nama Penyewa') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->nama_penyewa }}">
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('No. HP') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->no_hp }}">
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tempat_lahir_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tempat Lahir') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->detailTempatLahir->nama_kota }}">
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Lahir') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->tanggal_lahir }}">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Alamat') }}</label>
                                    <textarea readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $penyewa->alamat }}</textarea>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="awal_sewa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Awal Sewa') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->awal_sewa }}">
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="akhir_sewa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Akhir Sewa') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $penyewa->akhir_sewa }}">
                                </div>
                                <div class="sm:col-span-4 items-end">
                                    <a href="{{ route('penyewa.index') }}" class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Kembali') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>