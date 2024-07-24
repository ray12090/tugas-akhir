<x-app-layout>
    <div>
        <div class="pb-6">
            @include('components.alert')
        </div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Pembayaran IPL') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan detail data pembayaran IPL penghuni yang dipilih') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form> 
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
                                                    value="{{ $ipl->nomor_invoice }}"
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
                                            <input type="text" name="tanggal_invoice" id="tanggal_invoice"
                                                value="{{ $ipl->tanggal_invoice }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                readonly>
                                        </div>
                                        <div class="w-full">
                                            <label for="jatuh_tempo"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jatuh Tempo') }}
                                            </label>
                                            <input type="text" name="jatuh_tempo" id="jatuh_tempo"
                                                value="{{ $ipl->jatuh_tempo }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                readonly>
                                        </div>

                                        <div class="w-full">
                                            <label for="bulan_ipl"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pembayaran Bulan') }}</label>
                                            <input type="text" name="bulan_ipl" id="bulan_ipl"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ $ipl->bulan_ipl }}" readonly >
                                        </div>
                                        <div class="sm:col-span-2"></div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="pemilik_id"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Pemilik') }}
                                            </label>
                                            <input type="text" id="pemilik_id" name="pemilik_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ $ipl->pemilik->nama_pemilik }}" readonly>
                                            
                                        </div>
                                        <div class="w-full">
                                            <label for="unit_id"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Unit') }}
                                            </label>
                                            <input id="unit_id" name="unit_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ $ipl->unit->nama_unit }}" readonly>
                                                <!-- Unit akan dimuat secara dinamis berdasarkan pemilik yang dipilih -->
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
                                        <label for="tagihan_awal"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Total Tagihan yang Belum Dibayar') }}
                                        </label>
                                        <input type="number" id="tagihan_awal" name="tagihan_awal"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{$ipl->detailTagihanAwal->jumlah}}" readonly >
                                    </div>
                                    <div class="w-full">
                                        <label for="titipan_pengelolaan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Titipan Pengelolaan dan Sinking Fund') }}
                                        </label>
                                        <input type="number" id="titipan_pengelolaan" name="titipan_pengelolaan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{$ipl->detailTitipanPengelolaan->jumlah}}" readonly >
                                    </div>
                                    <div class="w-full">
                                        <label for="titipan_air"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Titipan Air') }}
                                        </label>
                                        <input type="number" id="titipan_air" name="titipan_air"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{$ipl->detailTitipanAir->jumlah}}" readonly >
                                    </div>
                                    <div class="sm:col-span-1"></div>
                                    <div class="w-full">
                                        <label for="iuran_pengelolaan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Iuran Pengelolaan') }}
                                        </label>
                                        <input type="number" id="iuran_pengelolaan" name="iuran_pengelolaan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{$ipl->detailIuranPengelolaan->jumlah}}" readonly >
                                    </div>
                                    <div class="w-full">
                                        <label for="dana_cadangan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Dana Cadangan') }}
                                        </label>
                                        <input type="number" id="dana_cadangan" name="dana_cadangan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            value="{{$ipl->detailDanaCadangan->jumlah}}" readonly >
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
                                                    value="{{$ipl->detailTagihanAir->meter_air_awal}}" readonly >
                                            </div>
                                            <div class="w-full">
                                                <label for="meter_air_akhir"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Meter Akhir (m³)') }}
                                                </label>
                                                <input type="number" id="meter_air_akhir" name="meter_air_akhir"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                    value="{{$ipl->detailTagihanAir->meter_air_akhir}}" readonly >
                                            </div>
                                            <div class="w-full">
                                                <label for="pemakaian_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Pemakaian (m³)') }}
                                                </label>
                                                <input type="text" id="pemakaian_air" name="pemakaian_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ $ipl->detailTagihanAir->pemakaian_air }}" readonly>
                                            </div>
                                            <div class="w-full">
                                                <label for="biaya_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Harga Air per m³') }}
                                                </label>
                                                <input type="text" id="biaya_air" name="biaya_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ $ipl->detailTagihanAir->detailBiayaAir->biaya_air }}" readonly>
                                                    
                                            </div>
                                            <div class="w-full">
                                                <label for="tagihan_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Jumlah Tagihan Air') }}
                                                </label>
                                                <input type="text" id="tagihan_air" name="tagihan_air"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ $ipl->detailTagihanAir->tagihan_air }}"
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
                                                    value="{{ $ipl->detailBiayaAdmin->biaya_admin }}" readonly>
                                            </div>
                                            <div class="w-full">
                                                <label for="denda"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Denda') }}
                                                </label>
                                                <input type="number" id="denda" name="denda"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                    value="{{ $ipl->detailDenda->jumlah }}" readonly>
                                            </div>
                                            <div class="sm:col-span-2"></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="sm:col-span-2"></div>
                                <div class="text-gray-900 text-lg font-bold">
                                    {{ __('Total Akhir') }}: <span id="total">{{$ipl->total}}</span>
                                    
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="w-full">
                                    <label for="foto_bukti_pembayaran"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Bukti Pembayaran') }}
                                    </label>
                                    <img src="{{ asset('storage/bukti_pembayaran/' . $ipl->foto_bukti_pembayaran) }}" alt="Bukti Pembayaran"
                                        class="w-40 h-40 object-cover rounded-lg">
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="w-full">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Pembayaran') }}</label>
                                    <input name="status" id="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="{{ $ipl->status }}" readonly>
                                    
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="sm:col-span-4">
                                    <a href="{{ route('ipl.index') }}"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Kembali') }}
                                    </a>
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
</x-app-layout>