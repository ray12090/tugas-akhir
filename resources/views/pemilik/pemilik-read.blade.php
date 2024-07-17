<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Pemilik') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Berikut adalah detail informasi dari pemilik yang dipilih.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden mt-4">
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form>
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="unit_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Unit') }}</label>
                                        <div
                                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'>
                                        @foreach ($pemilik->unit as $unit)
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                                {{ $unit->nama_unit }}
                                            </span>
                                        @endforeach
                                        </div>                                       
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('NIK') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->nik }}">
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="warga_negara_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Warga Negara') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->detailKewarganegaraan->status_kewarganegaraan }}">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="agama_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Agama') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->detailAgama->nama_agama }}">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="perkawinan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Perkawinan') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->detailPerkawinan->status_perkawinan }}">
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email pemilik') }}</label>
                                        <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->user ? $pemilik->user->email : 'Belum ada akun' }}">
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nama pemilik') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->nama_pemilik }}">
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('No. HP') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->no_hp }}">
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tempat_lahir_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tempat Lahir') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->detailTempatLahir->nama_kota }}">
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Lahir') }}</label>
                                    <input type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $pemilik->tanggal_lahir }}">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Alamat') }}</label>
                                    <textarea readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $pemilik->alamat }}</textarea>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="awal_huni" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Awal Huni') }}</label>
                                    @if($pemilik->unit->isNotEmpty())
                                        @foreach ($pemilik->unit as $unit)
                                            <div class="mb-2">
                                            <span class="block text-gray-600 dark:text-gray-300">{{ $unit->nama_unit }} : {{ $unit->pivot->awal_huni }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-600 dark:text-gray-300">Tidak ada unit terkait.</span>
                                    @endif                                
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="akhir_huni" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Akhir Huni') }}</label>
                                    @if($pemilik->unit->isNotEmpty())
                                        @foreach ($pemilik->unit as $unit)
                                            <div class="mb-2">
                                                <span class="block text-gray-600 dark:text-gray-300">{{ $unit->nama_unit }} : {{ $unit->pivot->akhir_huni }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="sm:col-span-4 items-end">
                                    <a href="{{ route('pemilik.index') }}" class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
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
