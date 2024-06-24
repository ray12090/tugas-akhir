<x-app-layout>
    <div>
        <div class="pb-6">
            @include('components.alert')
            {{-- @include('components.breadcrumbs', [
                'breadcrumbs' => [
                    ['title' => 'Dashboard', 'url' => Auth::user()->usertype === 'admin' ? route('admin-dashboard') : route('dashboard')],
                    ['title' => 'Data Kepenghunian', 'url' => route('kepenghunian.index')],
                    ['title' => 'Tambah Kepenghunian', 'url' => '']
                ]
            ]) --}}
        </div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Tambah Pembayaran IPL') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk menambah data pembayaran IPL. Isi formulir ini dapat diisi oleh Finance') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form>
                            {{-- <form action="{{ route('ipl.store') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return confirmSave(this);"> --}}
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                        <div class="w-full">
                                            <label for="nomor_invoice"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('No. Invoice') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="nomor_invoice" name="nomor_invoice"
                                                    placeholder="IPL/DD/YY/NNNNN"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="tanggal_invoice"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Tanggal Invoice') }}
                                            </label>
                                            <input type="date" name="tanggal_invoice" id="tanggal_invoice"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>
                                        <div class="w-full">
                                            <label for="jatuh_tempo"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jatuh Tempo') }}
                                            </label>
                                            <input type="date" name="jatuh_tempo" id="jatuh_tempo"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>
                                        <div class="w-full">
                                    <label for="bulan_ipl"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Pembayaran Bulan') }}
                                    </label>
                                    <input type="text" name="bulan_ipl"
                                        id="bulan_ipl"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="unit_name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Unit') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="unit_name" name="unit_name"
                                                    placeholder="X-1234"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <input type="hidden" id="unit_id" name="unit_id">
                                                <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="unit_size"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Luas Unit') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="unit_size" name="unit_size"
                                                    placeholder="XX m2"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    disabled>
                                                <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full"></div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="nama"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Nama') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="nama" name="nama"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="alamat"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Alamat') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="alamat" name="alamat" disabled
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Rincian Tagihan') }}
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="total_tagihan_belum_dibayar"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Total Tagihan yang Belum Dibayar') }}
                                    </label>
                                    <input type="text" name="total_tagihan_belum_dibayar"
                                        id="total_tagihan_belum_dibayar"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                <div class="w-full">
                                    <label for="titipan_pengelolaan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Titipan Pengelolaan dan Sinking Fund') }}
                                    </label>
                                    <input type="text" name="titipan_pengelolaan" id="titipan_pengelolaan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                <div class="w-full">
                                    <label for="titipan_air"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Titipan Air') }}
                                    </label>
                                    <input type="text" name="titipan_air" id="titipan_air"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                <div class="sm:col-span-1"></div>
                                <div class="w-full">
                                    <label for="iuran_pengelolaan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Iuran Pengelolaan') }}
                                    </label>
                                    <input type="text" name="iuran_pengelolaan" id="iuran_pengelolaan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                <div class="w-full">
                                    <label for="dana_cadangan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Dana Cadangan') }}
                                    </label>
                                    <input type="text" name="dana_cadangan" id="dana_cadangan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-md font-semibold">
                                        {{ __('Pemakaian Air Bersih') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <div class="grid gap-4 sm:grid-cols-6 sm:gap-6">
                                        <div class="w-full">
                                            <label for="meter_air_awal"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Meter Awal (m³)') }}
                                            </label>
                                            <input type="text" name="meter_air_awal" id="meter_air_awal"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                >
                                        </div>
                                        <div class="w-full">
                                            <label for="meter_air_akhir"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Meter Akhir (m³)') }}
                                            </label>
                                            <input type="text" name="meter_air_akhir" id="meter_air_akhir"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                >
                                        </div>
                                        <div class="w-full">
                                            <label for="pemakaian_air"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Pemakaian (m³)') }}
                                            </label>
                                            <input type="text" name="pemakaian_air" id="pemakaian_air"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                readonly>
                                        </div>
                                        <div class="w-full">
                                            <label for="harga_air"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Harga Air per m³') }}
                                            </label>
                                            <input type="text" name="pemakaian_air" id="pemakaian_air"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ number_format($tarif->harga_air, 2, ',', '.') }}" readonly>
                                        </div>
                                        <div class="w-full">
                                            <label for="tagihan_air"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jumlah Tagihan Air') }}
                                            </label>
                                            <input type="text" name="tagihan_air" id="tagihan_air"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="biaya_admin"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Biaya Admin') }}
                                            </label>
                                            <input type="text" name="biaya_admin" id="biaya_admin"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ number_format($tarif->biaya_admin, 2, ',', '.') }}" disabled>
                                        </div>
                                        <div class="w-full">
                                            <label for="denda"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Denda') }}
                                            </label>
                                            <input type="text" name="denda" id="denda"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="w-full">
                                    <label for="analisis_awal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Analisis Awal') }}</label>
                                    <textarea name="analisis_awal" id="analisis_awal" rows="4"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Tulis analisis pertama di sini"></textarea>
                                </div>
                                <input type="hidden" name="tarif_id" value="{{ $tarif->id }}">
                                <div class="sm:col-span-3">
                                    <a href="{{ route('kepenghunian.index') }}"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Batal') }}
                                    </a>
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                        <svg class="w-[16px] h-[16px] text-white dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
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
    <script>
        function toggleMasaHuniInput() {
            const statusSelect = document.getElementById('status');
            const masaHuniContainer = document.getElementById('masaHuniContainer');
            const selectedValue = statusSelect.value;

            if (selectedValue === 'Penyewa') {
                masaHuniContainer.classList.remove('hidden');
            } else {
                masaHuniContainer.classList.add('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const unitInput = document.getElementById('unit_name');
            const unitIdInput = document.getElementById('unit_id');
            const units = @json($units->pluck('unit', 'id'));

            // Function to set the unit ID
            function setUnitId(unitName) {
                unitIdInput.value = ''; // Clear previous value

                const matchedUnit = Object.entries(units).find(([id, unit]) => unit.toLowerCase() === unitName
                    .toLowerCase());

                if (matchedUnit) {
                    unitIdInput.value = matchedUnit[0];
                }
            }

            // Event listener for input changes
            unitInput.addEventListener('input', function() {
                setUnitId(unitInput.value.trim());
            });

            // Event listener for blur event to handle input after typing
            unitInput.addEventListener('blur', function() {
                setUnitId(unitInput.value.trim());

                // Provide feedback if no match is found
                if (!unitIdInput.value) {
                    alert('Unit ID tidak ditemukan. Pastikan unit name yang dimasukkan benar.');
                }
            });
        });
    </script>


</x-app-layout>
