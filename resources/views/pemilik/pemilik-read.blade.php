<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Pemilik') }}
                </div>
                <div class="text-gray-500 text-sm font-regular">
                    {{ __('Berikut adalah detail data pemilik yang telah diisi oleh Tenant Relation.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="nik"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('NIK') }}
                                </label>
                                <p
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    {{ $pemilik->nik }}
                                </p>
                            </div>
                            <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-1">
                                    <label for="warga_negara_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Warga Negara') }}
                                    </label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailKewarganegaraan->status_kewarganegaraan }}
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="agama_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Agama') }}
                                    </label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailAgama->nama_agama }}
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="perkawinan_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Status Perkawinan') }}
                                    </label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailPerkawinan->status_perkawinan }}
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="user_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Email Pemilik') }}
                                    </label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->user->email ?? 'Belum ada akun' }}
                                    </p>
                                </div>
                            </div>
                            <div class="sm:col-span-1">
                                <label for="nama_pemilik"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('Nama Pemilik') }}
                                </label>
                                <p
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    {{ $pemilik->nama_pemilik }}
                                </p>
                            </div>
                            <div class="sm:col-span-1">
                                <label for="no_hp"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('No. HP') }}
                                </label>
                                <p
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    {{ $pemilik->no_hp }}
                                </p>
                            </div>
                            <div class="grid gap-4 sm:col-span-1 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-1">
                                    <label for="tempat_lahir_id" id="labelTempatLahir"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Tempat Lahir') }}
                                    </label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailTempatLahir->name }}
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="jenis_kelamin"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Jenis Kelamin') }}
                                    </label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->jenis_kelamin }}
                                    </p>
                                </div>
                            </div>
                            <div class="sm:col-span-1">
                                <label for="tanggal_lahir"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Lahir') }}</label>
                                <p
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    {{ $pemilik->tanggal_lahir }}
                                </p>
                            </div>
                            <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-1">
                                    <label for="alamat_provinsi_id" id="labelAlamatProvinsi"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Provinsi') }}</label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailAlamatProvinsi->name }}
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="alamat_kabupaten_id" id="labelAlamatKabupaten"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kabupaten') }}</label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailAlamatKabupaten->name }}
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="alamat_kecamatan_id" id="labelAlamatKecamatan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kecamatan') }}</label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailAlamatKecamatan->name }}
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="alamat_village_id" id="labelAlamatVillage"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kelurahan') }}</label>
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->detailAlamatVillages->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="alamat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Alamat Sesuai KTP') }}</label>
                                <div class="relative">
                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        {{ $pemilik->alamat }}
                                    </p>
                                </div>
                            </div>
                            <div class="grid gap-4 sm:col-span-2 sm:grid-cols-3 sm:gap-6">
                                <div class="sm:col-span-1">
                                    <label for="unit_id" id="labelUnit"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Unit') }}</label>
                                    @foreach ($pemilik->unit as $unit)
                                        <p
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            {{ $unit->nama_unit }}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="awal_huni" id="labelAwalHuni"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Awal Huni') }}</label>
                                    @foreach ($pemilik->unit as $unit)
                                        <p
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            {{ $unit->pivot->awal_huni }}
                                        </p>
                                    @endforeach
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="akhir_huni" id="labelAkhirHuni"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Akhir Huni') }}</label>
                                    @foreach ($pemilik->unit as $unit)
                                        <p
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            {{ $unit->pivot->akhir_huni ?? '-' }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <a href="{{ route('pemilik.index') }}"
                                    class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
