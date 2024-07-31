<x-app-layout>
    <div>
        <div class="pb-6">
            @include('components.alert')
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
                        <form action="{{ route('ipl.store') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return confirmSave(this);">
                            @csrf
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
                                                    value="{{ old('nomor_invoice', $nextInvoiceNumber) }}"
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
                                            <div class="relative max-w sm:col-span-1">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input id="tanggal_invoice" name="tanggal_invoice" type="text"
                                                    datepicker datepicker-format="yyyy-mm-dd" datepicker-buttons
                                                    datepicker-autoselect-today
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="jatuh_tempo"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jatuh Tempo') }}
                                            </label>
                                            <div class="relative max-w sm:col-span-1">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input id="jatuh_tempo" name="jatuh_tempo" type="text"
                                                    datepicker datepicker-format="yyyy-mm-dd" datepicker-buttons
                                                    datepicker-autoselect-today
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="bulan_ipl"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pembayaran Bulan') }}</label>
                                            <select name="bulan_ipl" id="bulan_ipl"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="pemilik_id"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Pemilik') }}
                                            </label>
                                            <select id="pemilik_id" name="pemilik_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="">{{ __('Pilih Pemilik') }}</option>
                                                @foreach ($pemiliks as $pemilik)
                                                    <option value="{{ $pemilik->id }}">{{ $pemilik->nama_pemilik }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-full">
                                            <label for="unit_id"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Unit') }}
                                            </label>
                                            <select id="unit_id" name="unit_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="">{{ __('Pilih Unit') }}</option>
                                                <!-- Unit akan dimuat secara dinamis berdasarkan pemilik yang dipilih -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <form id="billingForm">
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
                                                    step="0.01"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            </div>
                                            <div class="w-full">
                                                <label for="meter_air_akhir"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Meter Akhir (m³)') }}
                                                </label>
                                                <input type="number" id="meter_air_akhir" name="meter_air_akhir"
                                                    step="0.01"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            </div>
                                            <div class="w-full">
                                                <label for="pemakaian_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Pemakaian (m³)') }}
                                                </label>
                                                <input type="text" id="pemakaian_air" name="pemakaian_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    readonly>
                                            </div>
                                            <div class="w-full">
                                                <label for="biaya_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Harga Air per m³') }}
                                                </label>
                                                <input type="text" id="biaya_air" name="biaya_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ number_format($biaya_air->biaya_air, 2, ',', '.') }}"
                                                    readonly>
                                                <input type="hidden" id="biaya_air_id" name="biaya_air_id"
                                                    value="{{ $biaya_air->id }}">
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
                                        </div>
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
                                                    value="{{ number_format($biaya_admin->biaya_admin, 2, ',', '.') }}"
                                                    disabled>
                                                <input type="hidden" id="biaya_admin_id" name="biaya_admin_id"
                                                    value="{{ $biaya_admin->id }}">
                                            </div>
                                            <div class="sm:col-span-2"></div>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-4">
                                        <div class="text-gray-900 text-lg font-semibold">
                                            {{ __('Rincian Tagihan') }}
                                        </div>
                                    </div>
                                    <div id="tagihan-container"
                                        class="grid gap-4 sm:gap-6 sm:col-span-4 sm:grid-cols-1 rounded-lg p-6 shadow-md sm:rounded-2xl bg-gray-100">
                                        <div class="grid gap-4 sm:grid-cols-4 sm:gap-6 tagihan-row">
                                            <div class="sm:col-span-1">
                                                <label for="jenis_tagihan_0"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Jenis Tagihan') }}
                                                </label>
                                                <select id="jenis_tagihan_0" name="jenis_tagihan[0][jenis_tagihan_id]"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option selected disabled>{{ __('Pilih jenis tagihan') }}
                                                    </option>
                                                    @foreach ($jenisTagihans as $tagihan)
                                                        <option value="{{ $tagihan->id }}">
                                                            {{ $tagihan->nama_jenis_tagihan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for="jumlah_0"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Jumlah') }}
                                                </label>
                                                <input type="number" id="jumlah_0" name="jenis_tagihan[0][jumlah]"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for=""
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></br></label>
                                                <button type="button" id="tambah-tagihan-btn"
                                                    class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                    {{ __('Tambah tagihan lainnya') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-gray-900 text-lg font-bold sm:col-span-4">
                                    {{ __('Total Akhir') }}: <span id="total_akhir">0</span>
                                </div>
                                <div class="w-full">
                                    <label for="foto_bukti_pembayaran"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Bukti Pembayaran') }}
                                    </label>
                                    <input type="file" name="foto_bukti_pembayaran" id="foto_bukti_pembayaran"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="foto_bukti_pembayaran">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, JPEG, PNG (MAX.
                                        5MB).</p>
                                </div>
                                <div class="w-full">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Pembayaran') }}</label>
                                    <select name="status" id="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="Belum Lunas">Belum Lunas</option>
                                        <option value="Lunas">Lunas</option>
                                    </select>
                                </div>
                                <input type="hidden" id="total" name="total" value="">
                                <div class="sm:col-span-4">
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
    <!-- </div>
    @include('components.modal', ['type' => 'confirmation'])
    </div> -->
    <script>
        document.getElementById('pemilik_id').addEventListener('change', function () {
            var pemilikId = this.value;
            var unitSelect = document.getElementById('unit_id');
            unitSelect.innerHTML = '<option value="">Pilih Unit</option>';

            if (pemilikId) {
                fetch(`/api/pemilik/${pemilikId}/units`)
                    .then(response => response.json())
                    .then(data => {
                        data.units.forEach(unit => {
                            var option = document.createElement('option');
                            option.value = unit.id;
                            option.text = unit.nama_unit;
                            unitSelect.add(option);
                        });
                    })
                    .catch(error => console.error('Error fetching units:', error));
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const meterAirAwalInput = document.getElementById('meter_air_awal');
            const meterAirAkhirInput = document.getElementById('meter_air_akhir');
            const pemakaianAirInput = document.getElementById('pemakaian_air');
            const tagihanAirInput = document.getElementById('tagihan_air');
            const totalAkhirSpan = document.getElementById('total_akhir');
            const totalTagihanInput = document.getElementById('total');
            const biayaAir = parseFloat('{{ $biaya_air->biaya_air }}'); // Dari database
            const biayaAdmin = parseFloat('{{ $biaya_admin->biaya_admin }}'); // Dari database

            function formatNumber(num) {
                return num.toLocaleString('id-ID', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function hitungPemakaianAir() {
                const meterAwal = parseFloat(meterAirAwalInput.value) || 0;
                const meterAkhir = parseFloat(meterAirAkhirInput.value) || 0;
                return meterAkhir - meterAwal;
            }

            function hitungTagihanAir(pemakaianAir) {
                return pemakaianAir * biayaAir;
            }

            function hitungTotalAkhir() {
                const pemakaianAir = hitungPemakaianAir();
                const tagihanAir = hitungTagihanAir(pemakaianAir);
                let totalAkhir = tagihanAir + biayaAdmin;

                document.querySelectorAll('.tagihan-row').forEach((row, index) => {
                    const jumlahInput = row.querySelector(`input[name="jenis_tagihan[${index}][jumlah]"]`);
                    const jumlah = parseFloat(jumlahInput.value) || 0;
                    totalAkhir += jumlah;
                });

                pemakaianAirInput.value = formatNumber(pemakaianAir);
                tagihanAirInput.value = formatNumber(tagihanAir);
                totalAkhirSpan.textContent = formatNumber(totalAkhir);
                totalTagihanInput.value = totalAkhir; // Set hidden input value
            }

            meterAirAwalInput.addEventListener('input', hitungTotalAkhir);
            meterAirAkhirInput.addEventListener('input', hitungTotalAkhir);
            document.querySelectorAll('.tagihan-row input[type="number"]').forEach(input => {
                input.addEventListener('input', hitungTotalAkhir);
            });

            document.getElementById('tambah-tagihan-btn').addEventListener('click', function () {
                var container = document.getElementById('tagihan-container');
                var index = container.children.length;

                var newRow = document.createElement('div');
                newRow.classList.add('grid', 'gap-4', 'sm:grid-cols-4', 'sm:gap-6', 'tagihan-row');
                var newTagihan = `
                    <div class="sm:col-span-1">
                        <label for="jenis_tagihan_${index}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('Jenis Tagihan') }}
                        </label>
                        <select id="jenis_tagihan_${index}" name="jenis_tagihan[${index}][jenis_tagihan_id]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>{{ __('Pilih jenis tagihan') }}</option>
                            @foreach ($jenisTagihans as $tagihan)
                                <option value="{{ $tagihan->id }}">
                                    {{ $tagihan->nama_jenis_tagihan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="jumlah_${index}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Jumlah') }}</label>
                        <input type="number" id="jumlah_${index}" name="jenis_tagihan[${index}][jumlah]" rows="2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="sm:col-span-1">
                        <label for=""
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></br></label>
                        <button type="button" class="hapus-tagihan-btn flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            {{ __('Hapus') }}
                        </button>
                    </div>
                `;
                newRow.innerHTML = newTagihan;
                container.appendChild(newRow);

                newRow.querySelector('.hapus-tagihan-btn').addEventListener('click', function () {
                    newRow.remove();
                    hitungTotalAkhir();
                });

                newRow.querySelector(`input[name="jenis_tagihan[${index}][jumlah]"]`).addEventListener(
                    'input', hitungTotalAkhir);
            });

            hitungTotalAkhir();
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            var today = new Date();
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
            var dateToday = today.getFullYear() + "-" + month + "-" + day;
            document.getElementById("tanggal_invoice").value = dateToday;

            today.setDate(today.getDate() + 10);
            var dayDue = ("0" + today.getDate()).slice(-2);
            var monthDue = ("0" + (today.getMonth() + 1)).slice(-2);
            var dateDue = today.getFullYear() + "-" + monthDue + "-" + dayDue;
            document.getElementById("jatuh_tempo").value = dateDue;

            var monthSelect = document.getElementById("bulan_ipl");
            monthSelect.selectedIndex = today.getMonth(); // Set bulan IPL ke bulan saat ini
        });
    </script>


</x-app-layout>