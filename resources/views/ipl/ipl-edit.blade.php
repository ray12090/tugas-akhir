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
                        <form action="{{ route('ipl.update', $ipl->id) }}" method="POST" enctype="multipart/form-data"
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
                                                value="{{ old('tanggal_invoice', $ipl->tanggal_invoice) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>
                                        <div class="w-full">
                                            <label for="jatuh_tempo"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jatuh Tempo') }}
                                            </label>
                                            <input type="date" name="jatuh_tempo" id="jatuh_tempo"
                                                value="{{ old('jatuh_tempo', $ipl->jatuh_tempo) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>

                                        <div class="w-full">
                                            <label for="bulan_ipl"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pembayaran Bulan') }}</label>
                                            <select name="bulan_ipl" id="bulan_ipl"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="Januari" {{ $ipl->bulan_ipl == 'Januari' ? 'selected' : '' }}>Januari</option>
                                                <option value="Februari" {{ $ipl->bulan_ipl == 'Februari' ? 'selected' : '' }}>Februari</option>
                                                <option value="Maret" {{ $ipl->bulan_ipl == 'Maret' ? 'selected' : '' }}>
                                                    Maret</option>
                                                <option value="April" {{ $ipl->bulan_ipl == 'April' ? 'selected' : '' }}>
                                                    April</option>
                                                <option value="Mei" {{ $ipl->bulan_ipl == 'Mei' ? 'selected' : '' }}>Mei
                                                </option>
                                                <option value="Juni" {{ $ipl->bulan_ipl == 'Juni' ? 'selected' : '' }}>
                                                    Juni</option>
                                                <option value="Juli" {{ $ipl->bulan_ipl == 'Juli' ? 'selected' : '' }}>
                                                    Juli</option>
                                                <option value="Agustus" {{ $ipl->bulan_ipl == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                                                <option value="September" {{ $ipl->bulan_ipl == 'September' ? 'selected' : '' }}>September</option>
                                                <option value="Oktober" {{ $ipl->bulan_ipl == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                                                <option value="November" {{ $ipl->bulan_ipl == 'November' ? 'selected' : '' }}>November</option>
                                                <option value="Desember" {{ $ipl->bulan_ipl == 'Desember' ? 'selected' : '' }}>Desember</option>
                                            </select>
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
                                            <select id="pemilik_id" name="pemilik_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="">{{ __('Pilih Pemilik') }}</option>
                                                @foreach($pemiliks as $pemilik)
                                                    <option value="{{ $pemilik->id }}" {{ $ipl->pemilik_id == $pemilik->id ? 'selected' : '' }}>{{ $pemilik->nama_pemilik }}</option>
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
                                                @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}" {{ $ipl->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->nama_unit }}</option>
                                                @endforeach
                                            </select>
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
                                            value="{{ old('tagihan_awal', $ipl->detailTagihanAwal->jumlah ?? '') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    </div>
                                    <div class="w-full">
                                        <label for="titipan_pengelolaan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Titipan Pengelolaan dan Sinking Fund') }}
                                        </label>
                                        <input type="number" id="titipan_pengelolaan" name="titipan_pengelolaan"
                                            value="{{ old('titipan_pengelolaan', $ipl->detailTitipanPengelolaan->jumlah ?? '') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    </div>
                                    <div class="w-full">
                                        <label for="titipan_air"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Titipan Air') }}
                                        </label>
                                        <input type="number" id="titipan_air" name="titipan_air"
                                            value="{{ old('titipan_air', $ipl->detailTitipanAir->jumlah ?? '') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    </div>
                                    <div class="sm:col-span-1"></div>
                                    <div class="w-full">
                                        <label for="iuran_pengelolaan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Iuran Pengelolaan') }}
                                        </label>
                                        <input type="number" id="iuran_pengelolaan" name="iuran_pengelolaan"
                                            value="{{ old('iuran_pengelolaan', $ipl->detailIuranPengelolaan->jumlah ?? '') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    </div>
                                    <div class="w-full">
                                        <label for="dana_cadangan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Dana Cadangan') }}
                                        </label>
                                        <input type="number" id="dana_cadangan" name="dana_cadangan"
                                            value="{{ old('dana_cadangan', $ipl->detailDanaCadangan->jumlah ?? '') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
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
                                                    value="{{ old('meter_air_awal', $ipl->detailTagihanAir->meter_air_awal ?? '') }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            </div>
                                            <div class="w-full">
                                                <label for="meter_air_akhir"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Meter Akhir (m³)') }}
                                                </label>
                                                <input type="number" id="meter_air_akhir" name="meter_air_akhir"
                                                    value="{{ old('meter_air_akhir', $ipl->detailTagihanAir->meter_air_akhir ?? '') }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            </div>
                                            <div class="w-full">
                                                <label for="pemakaian_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Pemakaian (m³)') }}
                                                </label>
                                                <input type="text" id="pemakaian_air" name="pemakaian_air"
                                                    value="{{ old('pemakaian_air', $ipl->detailTagihanAir->pemakaian_air ?? '') }}"
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
                                                    value="{{ $ipl->detailTagihanAir->detailBiayaAir->biaya_air }}">
                                            </div>
                                            <div class="w-full">
                                                <label for="tagihan_air"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Jumlah Tagihan Air') }}
                                                </label>
                                                <input type="text" id="tagihan_air" name="tagihan_air"
                                                    value="{{ old('tagihan_air', $ipl->detailTagihanAir->tagihan_air ?? '') }}"
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
                                                    value="{{ number_format($biaya_admin->biaya_admin, 2, ',', '.') }}"
                                                    disabled>
                                                <input type="hidden" id="biaya_admin_id" name="biaya_admin_id"
                                                    value="{{ $ipl->detailBiayaAdmin->biaya_admin }}">
                                            </div>
                                            <div class="w-full">
                                                <label for="denda"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Denda') }}
                                                </label>
                                                <input type="number" id="denda" name="denda"
                                                    value="{{ old('denda', $ipl->detailDenda->jumlah ?? '') }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                            </div>
                                            <div class="sm:col-span-2"></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="sm:col-span-2"></div>
                                <div class="text-gray-900 text-lg font-bold">
                                    {{ __('Total Akhir') }}: <span
                                        id="total_akhir">{{ number_format($ipl->total, 2, ',', '.') }}</span>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="w-full">
                                    <label for="foto_bukti_pembayaran"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Bukti Pembayaran') }}
                                    </label>

                                    <img src="{{ asset('storage/bukti_pembayaran/' . $ipl->foto_bukti_pembayaran) }}"
                                        alt="Bukti Pembayaran" class="w-40 h-40 object-cover rounded-lg">

                                    <label for="foto_bukti_pembayaran"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Ubah Bukti Pembayaran') }}
                                    </label>

                                    <input type="file" name="foto_bukti_pembayaran" id="foto_bukti_pembayaran"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="foto_bukti_pembayaran">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, JPEG, PNG (MAX.
                                        5MB).</p>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1"></div>
                                <div class="w-full">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Pembayaran') }}</label>
                                    <select name="status" id="status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="Belum Lunas" {{ $ipl->status == 'Belum Lunas' ? 'selected' : '' }}>
                                            Belum Lunas</option>
                                        <option value="Lunas" {{ $ipl->status == 'Lunas' ? 'selected' : '' }}>Lunas
                                        </option>
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
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-[#016452] rounded-lg focus:ring-4 focus:ring-[#014f415e] dark:focus:ring-primary-900 hover:bg-[#014F41]">
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
        document.addEventListener('DOMContentLoaded', function () {
            // Fetching units when the owner is selected
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

            // Initializing variables
            const tagihanAwalInput = document.getElementById('tagihan_awal');
            const titipanPengelolaanInput = document.getElementById('titipan_pengelolaan');
            const titipanAirInput = document.getElementById('titipan_air');
            const iuranPengelolaanInput = document.getElementById('iuran_pengelolaan');
            const danaCadanganInput = document.getElementById('dana_cadangan');
            const meterAirAwalInput = document.getElementById('meter_air_awal');
            const meterAirAkhirInput = document.getElementById('meter_air_akhir');
            const dendaInput = document.getElementById('denda');
            const biayaAir = {{ $biaya_air->biaya_air }}; // Ambil dari database
            const biayaAdmin = {{ $biaya_admin->biaya_admin }}; // Ambil dari database

            // Format number to Indonesian currency style
            function formatNumber(num) {
                return num.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }

            // Update total cost calculation
            function updateTotalAkhir() {
                const tagihanAwal = parseFloat(tagihanAwalInput.value) || 0;
                const titipanPengelolaan = parseFloat(titipanPengelolaanInput.value) || 0;
                const titipanAir = parseFloat(titipanAirInput.value) || 0;
                const iuranPengelolaan = parseFloat(iuranPengelolaanInput.value) || 0;
                const danaCadangan = parseFloat(danaCadanganInput.value) || 0;
                const meterAwal = parseFloat(meterAirAwalInput.value) || 0;
                const meterAkhir = parseFloat(meterAirAkhirInput.value) || 0;
                const denda = parseFloat(dendaInput.value) || 0;

                // Calculate water usage and bill
                const pemakaianAir = meterAkhir - meterAwal;
                const tagihanAir = pemakaianAir * biayaAir;

                // Calculate total cost
                const totalAkhir = tagihanAwal + titipanPengelolaan + titipanAir + iuranPengelolaan + danaCadangan + tagihanAir + biayaAdmin + denda;

                // Update display values
                document.getElementById('total_akhir').textContent = formatNumber(totalAkhir);
                document.getElementById('pemakaian_air').value = formatNumber(pemakaianAir);
                document.getElementById('tagihan_air').value = formatNumber(tagihanAir);
            }

            // Add event listener to all relevant inputs
            document.querySelectorAll('input[type="number"]').forEach(input => {
                input.addEventListener('input', updateTotalAkhir);
            });

            // Initial calculation
            updateTotalAkhir();
        });
    </script>
</x-app-layout>
