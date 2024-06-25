<x-app-layout>
    <div>
        <div class="pb-6">
            @include('components.alert')
        </div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Edit Pembayaran IPL') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk mengedit data pembayaran IPL.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('ipl.update',$ipl->id) }}" method="POST" enctype="multipart/form-data" 
                            onsubmit="return confirmSave(this);">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-4">
                                    <div class="grid gap-4 sm:grid-cols-6 sm:gap-6">
                                        <div class="w-full">
                                            <label for="nomor_invoice"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('No. Invoice') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="nomor_invoice" name="nomor_invoice"
                                                    placeholder="IPL/MM/YY/NNNNN"
                                                    value="{{ old('nomor_invoice', $ipl->nomor_invoice) }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    readonly>
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
                                                value="{{ old('tanggal_invoice', $ipl->tanggal_invoice) }}" required>
                                        </div>
                                        <div class="w-full">
                                            <label for="jatuh_tempo"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jatuh Tempo') }}
                                            </label>
                                            <input type="date" name="jatuh_tempo" id="jatuh_tempo"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ old('jatuh_tempo', $ipl->jatuh_tempo) }}" required>
                                        </div>

                                        <div class="w-full">
                                            <label for="bulan_ipl"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Pembayaran Bulan') }}
                                            </label>
                                            <input type="text" name="bulan_ipl" id="bulan_ipl"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ old('bulan_ipl', $ipl->bulan_ipl) }}" required>
                                            </div>
                                        <div class="sm:col-span-2"></div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="unit_name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Unit') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="unit_name" name="unit_name" placeholder="X-1234"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ old('unit_name', $ipl->unit->unit ?? '') }}">
                                                    <input type="hidden" id="unit_id" name="unit_id"
                                                    value="{{ old('unit_id', $ipl->unit->unit_id ?? '') }}">
                                                <input type="hidden" id="kepenghunian_id" name="kepenghunian_id">
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
                                                <input type="text" id="unit_size" name="unit_size" placeholder="XX m2"
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
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    readonly>
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
                                <form id="billingForm">
                                    <div class="sm:col-span-4">
                                        <div class="text-gray-900 text-lg font-semibold">
                                            {{ __('Rincian Tagihan') }}
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label for="total_tagihan_belum_dibayar"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Total Tagihan yang Belum Dibayar') }}
                                        </label>
                                        <input type="number" id="total_tagihan_belum_dibayar" name="total_tagihan_belum_dibayar"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{ old('total_tagihan_belum_dibayar', $ipl->total_tagihan_belum_dibayar) }}" required>
                                    </div>
                                    <div class="w-full">
                                        <label for="titipan_pengelolaan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Titipan Pengelolaan dan Sinking Fund') }}
                                        </label>
                                        <input type="number" id="titipan_pengelolaan" name="titipan_pengelolaan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{ old('titipan_pengelolaan', $ipl->titipan_pengelolaan) }}">
                                    </div>
                                    <div class="w-full">
                                        <label for="titipan_air"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Titipan Air') }}
                                        </label>
                                        <input type="number" id="titipan_air" name="titipan_air"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{ old('titipan_air', $ipl->titipan_air) }}">
                                    </div>
                                    <div class="sm:col-span-1"></div>
                                    <div class="w-full">
                                        <label for="iuran_pengelolaan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Iuran Pengelolaan') }}
                                        </label>
                                        <input type="number" id="iuran_pengelolaan" name="iuran_pengelolaan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{ old('iuran_pengelolaan', $ipl->iuran_pengelolaan) }}">
                                    
                                        </div>
                                    <div class="w-full">
                                        <label for="dana_cadangan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Dana Cadangan') }}
                                        </label>
                                        <input type="number" id="dana_cadangan" name="dana_cadangan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{ old('dana_cadangan', $ipl->dana_cadangan) }}">
                                    </div>
                                    <div class="sm:col-span-4">
                                        <div class="text-gray-900 text-md font-semibold">
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
                                                <input type="number" id="meter_air_awal" name="meter_air_awal"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                    value="{{ old('meter_air_awal', $ipl->meter_air_awal) }}" required>
                                            </div>
                                            <div class="w-full">
                                                <label for="meter_air_akhir"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Meter Akhir (m³)') }}
                                                </label>
                                                <input type="number" id="meter_air_akhir" name="meter_air_akhir"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                    value="{{ old('meter_air_akhir', $ipl->meter_air_akhir) }}" required>
                                            </div>
                                            <div class="w-full">
                                                <label for="pemakaian_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Pemakaian (m³)') }}
                                                </label>
                                                <input type="text" id="pemakaian_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    readonly>
                                            </div>
                                            <div class="w-full">
                                                <label for="harga_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Harga Air per m³') }}
                                                </label>
                                                <input type="text" id="harga_air" name="harga_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ number_format($tarif->harga_air, 2, ',', '.') }}"
                                                    readonly>
                                            </div>
                                            <div class="w-full">
                                                <label for="tagihan_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Jumlah Tagihan Air') }}
                                                </label>
                                                <input type="text" id="tagihan_air" name="tagihan_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    readonly>
                                            </div>
                                            <div class="sm:col-span-1"></div>
                                        </div>
                                        <div class="sm:col-span-2"></div>
                                        <div class="sm:col-span-2"></div>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                            <div class="w-full">
                                                <label for="biaya_admin"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Biaya Admin') }}
                                                </label>
                                                <input type="text" id="biaya_admin" name="biaya_admin"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ number_format($tarif->biaya_admin, 2, ',', '.') }}"
                                                    disabled>
                                            </div>
                                            <input type="hidden" name="tarif_id" value="{{ $tarif->id }}">
                                            <div class="w-full">
                                                <label for="denda"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Denda') }}
                                                </label>
                                                <input type="number" id="denda" name="denda"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                    value="{{ old('denda', $ipl->denda) }}">
                                            </div>
                                            <div class="sm:col-span-2"></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="sm:col-span-2"></div>
                                <div class="text-gray-900 text-lg font-bold">
                                    {{ __('Total Akhir') }}: <span id="total_akhir">0</span>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="w-full">
                                    <label for="foto_bukti_pembayaran"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Bukti Pembayaran') }}
                                    </label>
                                    @if ($ipl->foto_bukti_pembayaran)
                                                <div>
                                                    <img src="{{ asset('storage/bukti_pembayaran/'.$ipl->foto_bukti_pembayaran) }}" alt="Foto Bukti Pembayaran" class="w-full h-auto rounded-lg mb-2">
                                                    <input type="file" name="foto_bukti_pembayaran" id="foto_bukti_pembayaran"
                                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="foto_analisis_awal">
                                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, JPEG, PNG (MAX. 5MB).</p>
                                                </div>
                                            @else
                                                <input type="file" name="foto_bukti_pembayaran" id="foto_bukti_pembayaran"
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="foto_analisis_awal">
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, JPEG, PNG (MAX. 5MB).</p>
                                            @endif
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="w-full">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Pembayaran') }}</label>
                                    <select name="status" id="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="Belum Lunas"{{ old('status', $ipl->status) == 'Belum Lunas' ? 'selected' : ''}} >Belum Lunas</option>
                                        <option value="Lunas"{{ old('status', $ipl->status) == 'Lunas' ? 'selected' : ''}} >Lunas</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="sm:col-span-3">
                                    <a href="{{ route('ipl.index') }}"
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
                        </form>
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
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        document.addEventListener('DOMContentLoaded', function () {
            const unitInput = document.getElementById('unit_name');
            const unitIdInput = document.getElementById('unit_id');
            const namaInput = document.getElementById('nama');
            const kepenghunianIdInput = document.getElementById('kepenghunian_id');
            const alamatInput = document.getElementById('alamat');

            const totalTagihanBelumDibayarInput = document.getElementById('total_tagihan_belum_dibayar');
            const titipanPengelolaanInput = document.getElementById('titipan_pengelolaan');
            const titipanAirInput = document.getElementById('titipan_air');
            const iuranPengelolaanInput = document.getElementById('iuran_pengelolaan');
            const danaCadanganInput = document.getElementById('dana_cadangan');
            const meterAirAwalInput = document.getElementById('meter_air_awal');
            const meterAirAkhirInput = document.getElementById('meter_air_akhir');
            const dendaInput = document.getElementById('denda');
            const hargaAir = {{ $tarif->harga_air }}; // Ambil dari database
            const biayaAdmin = {{ $tarif->biaya_admin }}; // Ambil dari database

            // Fungsi format angka ke format xx.xxx,xx
            function formatNumber(num) {
                return num.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }

            function setUnitIdAndFetchOwnerInfo(unitName) {
                unitIdInput.value = ''; // Clear previous value
                kepenghunianIdInput.value = ''; // Clear previous value
                namaInput.value = ''; // Clear previous value
                alamatInput.value = ''; // Clear previous value

                if (unitName.trim().length < 6) {
                    return; // Skip if less than 6 characters
                }

                fetch(`/get-owner-info-by-name/${unitName}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            unitIdInput.value = data.unit.id;
                            kepenghunianIdInput.value = data.kepenghunian.id;
                            namaInput.value = data.nama;
                            alamatInput.value = data.alamat;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching owner info:', error);
                    });
            }

            const debouncedFetch = debounce(setUnitIdAndFetchOwnerInfo, 500);

            unitInput.addEventListener('input', function () {
                debouncedFetch(unitInput.value.trim());
            });

            unitInput.addEventListener('blur', function () {
                if (unitInput.value.trim().length >= 6) {
                    setUnitIdAndFetchOwnerInfo(unitInput.value.trim());
                } else {
                    alert('Unit ID tidak ditemukan. Pastikan unit name yang dimasukkan benar.');
                }
            });

            // Fungsi untuk menghitung dan memperbarui Total Akhir
            function updateTotalAkhir() {
                // Ambil nilai dari setiap input
                const totalTagihan = parseFloat(totalTagihanBelumDibayarInput.value) || 0;
                const titipanPengelolaan = parseFloat(titipanPengelolaanInput.value) || 0;
                const titipanAir = parseFloat(titipanAirInput.value) || 0;
                const iuranPengelolaan = parseFloat(iuranPengelolaanInput.value) || 0;
                const danaCadangan = parseFloat(danaCadanganInput.value) || 0;
                const meterAwal = parseFloat(meterAirAwalInput.value) || 0;
                const meterAkhir = parseFloat(meterAirAkhirInput.value) || 0;
                const denda = parseFloat(dendaInput.value) || 0;

                // Hitung pemakaian air
                const pemakaianAir = meterAkhir - meterAwal;

                // Hitung tagihan air
                const tagihanAir = pemakaianAir * hargaAir;

                // Hitung total biaya admin
                const totalBiayaAdmin = biayaAdmin;

                // Hitung total akhir
                const totalAkhir = totalTagihan + titipanPengelolaan + titipanAir + iuranPengelolaan + danaCadangan + tagihanAir + totalBiayaAdmin + denda;

                // Perbarui nilai pada elemen Total Akhir
                document.getElementById('total_akhir').textContent = formatNumber(totalAkhir);

                // Perbarui nilai pada elemen Pemakaian Air
                document.getElementById('pemakaian_air').value = formatNumber(pemakaianAir);

                // Perbarui nilai pada elemen Tagihan Air
                document.getElementById('tagihan_air').value = formatNumber(tagihanAir);
            }

            // Tambahkan event listener pada semua input untuk memanggil fungsi updateTotalAkhir
            const inputFields = document.querySelectorAll('input[type="number"]');
            inputFields.forEach(input => {
                input.addEventListener('input', updateTotalAkhir);
            });

            // Panggil updateTotalAkhir untuk inisialisasi
            updateTotalAkhir();
        });
    </script>
</x-app-layout>
