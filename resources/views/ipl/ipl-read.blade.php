@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp

<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div class="relative sm:rounded-lg overflow-hidden">
                @if (Auth::user()->tipe_user_id == 11 || Auth::user()->tipe_user_id == 12)
                    <div class="text-gray-900 text-sm font-reguler mb-2 grid sm:grid-cols-2">
                        <div class="mb-2 grid sm:col-span-2 sm:grid-cols-3">
                            <div class="sm:col-span-1 mb-12">
                                <img src="{{ asset('storage/images/Landmark-Residence-Logo.png') }}" alt="Foto Unit"
                                    class="w-auto h-32 rounded-lg">
                            </div>
                            <div class="sm:col-span-1 mb-12 text-center">
                                <h1
                                    class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                                    {{ __('Tagihan') }}</h1>
                                <span
                                    class="text-gray-900 dark:text-white sm:col-span-1">{{ __('P3SRSS Landmark Bandung') }}</br></span>
                                <span
                                    class="text-gray-900 dark:text-white sm:col-span-1">{{ __('Jl. Industri No. 15, Bandung, 40172') }}</span>
                            </div>
                        </div>
                        <div class="mb-2 grid sm:grid-cols-1">
                            <div class="sm:col-span-1 mb-6">
                                @if (Auth::user()->tipe_user_id == 11)
                                    <span
                                        class="mb-3 text-2xl font-semibold leading-tight tracking-tight text-gray-900 dark:text-white md:text-3xl">
                                        {{ $ipl->pemilik->nama_pemilik }}
                                    </span>
                                @endif
                                @if (Auth::user()->tipe_user_id == 12)
                                    <span
                                        class="mb-3 text-2xl font-semibold leading-tight tracking-tight text-gray-900 dark:text-white md:text-3xl">
                                        {{ $ipl->unit->penyewa->nama_penyewa }}
                                    </span>
                                @endif
                            </div>
                            <div class="sm:col-span-1 mb-2">
                                <span
                                    class="text-gray-900 dark:text-white sm:col-span-1">{{ __('Tanggal Invoice: ') }}</span>
                                <span class="font-bold sm:col-span-1">
                                    {{ Carbon::parse($ipl->tanggal_invoice)->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <div class="sm:col-span-1 mb-2">
                                <span
                                    class="text-gray-900 dark:text-white sm:col-span-1">{{ __('Nomor Invoice: ') }}</span>
                                <span class="font-bold sm:col-span-1">{{ $ipl->nomor_invoice }}</span>
                            </div>
                        </div>
                        <div class="mb-2 grid sm:grid-cols-1 justify-end items-end text-right">
                            @if (Auth::user()->tipe_user_id == 11)
                                <span class="inline-block align-bottom text-right">
                                    <span class="mb-2 block">{{ $ipl->pemilik->alamat }}</span>
                                    <span class="mb-2 block">Kel. {{ $ipl->pemilik->detailAlamatVillages->name }}, Kec.
                                        {{ $ipl->pemilik->detailAlamatKecamatan->name }}</span>
                                    <span class="mb-2 block">{{ $ipl->pemilik->detailAlamatKabupaten->name }}</span>
                                    <span class="mb-2 block">{{ $ipl->pemilik->user->email }}</span>
                                </span>
                            @endif
                            @if (Auth::user()->tipe_user_id == 12)
                                <span class="inline-block align-bottom text-right">
                                    <span class="mb-2 block">{{ $ipl->unit->penyewa->alamat }}</span>
                                    <span class="mb-2 block">Kel. {{ $ipl->unit->penyewa->detailAlamatVillage->name }},
                                        Kec.
                                        {{ $ipl->unit->penyewa->detailAlamatKecamatan->name }}</span>
                                    <span
                                        class="mb-2 block">{{ $ipl->unit->penyewa->detailAlamatKabupaten->name }}</span>
                                    <span class="mb-2 block">{{ $ipl->unit->penyewa->user->email }}</span>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 overflow-visible">
                            <caption
                                class="py-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                {{ __('Rincian Tagihan Air') }}
                            </caption>
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="p-4 rounded-tl-lg">
                                        <a>
                                            {{ __('Tagihan') }}
                                        </a>
                                    </th>
                                    <th class="text-end p-4 rounded-tl-lg">
                                        <a>
                                            {{ __('Meter Awal') }}
                                        </a>
                                    </th>
                                    <th class="text-end p-4">
                                        <a>
                                            {{ __('Meter Akhir') }}
                                        </a>
                                    </th>
                                    <th class="text-end p-4">
                                        <a>
                                            {{ __('Pemakaian Air') }}
                                        </a>
                                    </th>
                                    <th class="p-4 text-end">
                                        <a>
                                            {{ __('Biaya Air per m³') }}
                                        </a>
                                    </th>
                                    <th class="p-4 text-end rounded-tr-lg">
                                        <a>
                                            {{ __('Total Tagihan Air') }}
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ __('Tagihan Air') }}
                                    </td>
                                    <td
                                        class="text-end px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ $ipl->detailTagihanAir->meter_air_awal }}
                                    </td>
                                    <td
                                        class="text-end px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ $ipl->detailTagihanAir->meter_air_akhir }}
                                    </td>
                                    <td
                                        class="text-end px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ $ipl->detailTagihanAir->pemakaian_air }} m³
                                    </td>
                                    <td
                                        class="text-end px-4 py-3 font-bold text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        Rp{{ number_format($biaya_air->biaya_air, 2, ',', '.') }}
                                    </td>
                                    <td
                                        class="text-end px-4 py-3 font-bold text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        Rp{{ number_format($ipl->detailTagihanAir->tagihan_air, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 overflow-auto">
                            <caption
                                class="py-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                {{ __('Semua Tagihan') }}
                            </caption>
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="p-4 rounded-tl-lg">
                                        <a>
                                            {{ __('No') }}
                                        </a>
                                    </th>
                                    <th class="p-4">
                                        <a>
                                            {{ __('Tagihan') }}
                                        </a>
                                    </th>
                                    <th class="p-4 text-end rounded-tr-lg">
                                        <a>
                                            {{ __('Jumlah') }}
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ipl->detailJenisTagihan as $index => $jenisTagihan)
                                    <tr>
                                        <td
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                            {{ $index + 1 }}
                                        </td>
                                        <td
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                            {{ $jenisTagihan->nama_jenis_tagihan }}
                                        </td>
                                        <td
                                            class="text-end px-4 py-3 font-bold text-gray-900 whitespace-nowrap dark:text-white border-b">
                                            Rp{{ number_format($jenisTagihan->pivot->jumlah, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ $ipl->detailJenisTagihan->count() + 1 }}
                                    </td>
                                    <td
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ __('Biaya Administrasi') }}
                                    </td>
                                    <td
                                        class="text-end px-4 py-3 font-bold text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        Rp{{ number_format($ipl->detailBiayaAdmin->biaya_admin, 2, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ $ipl->detailJenisTagihan->count() + 2 }}
                                    </td>
                                    <td
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        {{ __('Tagihan Air') }}
                                    </td>
                                    <td
                                        class="text-end px-4 py-3 font-bold text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        Rp{{ number_format($ipl->detailTagihanAir->tagihan_air, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 overflow-visible">
                            <caption
                                class="py-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                {{ __('Total Tagihan') }}
                            </caption>
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="p-4 rounded-tl-lg">
                                        <a>
                                            {{ __('Informasi Pembayaran') }}
                                        </a>
                                    </th>
                                    <th class="p-4">
                                        <a>
                                            {{ __('Jatuh Tempo') }}
                                        </a>
                                    </th>
                                    <th class="text-end p-4 rounded-tr-lg">
                                        <a>
                                            {{ __('Total Tagihan') }}
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        class="text-left px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b">
                                        <span>{{ __('Mandiri: ') }}</span><span
                                            class="font-bold">{{ __('1310014338240') }}</span></br>
                                        <span>{{ __('CIMB: ') }}</span><span
                                            class="font-bold">{{ __('800147933800') }}</span>
                                        <span
                                            class="block text-sm mt-4">{{ __('Berikan keterangan transfer berupa:') }}</span>
                                        <span
                                            class="block text-sm font-bold">{{ __('Kode Tower - Nomor Lantai dan Nomor Unit') }}</span>
                                        <span class="block text-sm">{{ __('Contoh X-0101') }}</span>
                                    </td>
                                    <td
                                        class="px-4 py-6 font-bold text-gray-900 whitespace-nowrap dark:text-white border-b text-2xl md:text-3xl">
                                        {{ Carbon::parse($ipl->jatuh_tempo)->translatedFormat('d F Y') }}
                                    </td>
                                    <td
                                        class="text-end px-4 py-6 font-bold text-red-700 whitespace-nowrap dark:text-white border-b text-2xl md:text-3xl">
                                        Rp{{ number_format($ipl->total, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2 py-5 ">
                        <span
                            class="text-gray-900 dark:text-white sm:col-span-1 text-sm font-bold">{{ __('Catatan:') }}</span>
                        <span
                            class="block text-sm">{{ __('Untuk konfirmasi atau pertanyaan, kontak kami pada:') }}</span>
                        <span class="block text-sm">{{ __('No. Telp: 022-3000-0444') }}</span>
                        <span class="block text-sm">{{ __('WhatsApp: 0815-1313-8444') }}</span>
                        <span class="block text-sm">{{ __('Email   : bp.landmarkresidence@gmail.com') }}</span>
                    </div>
                @else
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
                                            value="{{ $ipl->nomor_invoice }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            readonly>
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="tanggal_invoice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Tanggal Invoice') }}
                                    </label>
                                    <div class="relative max-w sm:col-span-1">
                                        <input id="tanggal_invoice" name="tanggal_invoice" type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            value="{{ $ipl->tanggal_invoice }}" readonly>
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="jatuh_tempo"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Jatuh Tempo') }}
                                    </label>
                                    <div class="relative max-w sm:col-span-1">
                                        <input id="jatuh_tempo" name="jatuh_tempo" type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            value="{{ $ipl->jatuh_tempo }}" readonly>
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full sm:col-span-1">
                                    <label for="bulan_ipl"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tagihan Bulan') }}</label>
                                    <select name="bulan_ipl" id="bulan_ipl"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        disabled>
                                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                            <option value="{{ $bulan }}"
                                                {{ $ipl->bulan_ipl == $bulan ? 'selected' : '' }}>
                                                {{ $bulan }}
                                            </option>
                                        @endforeach
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
                                    <input type="text" id="pemilik_id" name="pemilik_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="{{ $ipl->pemilik->nama_pemilik }}" readonly>
                                </div>
                                <div class="w-full">
                                    <label for="unit_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Unit') }}
                                    </label>
                                    <input type="text" id="unit_id" name="unit_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="{{ $ipl->unit->nama_unit }}" readonly>
                                </div>
                            </div>
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
                                    <input type="text" id="meter_air_awal" name="meter_air_awal"
                                        value="{{ $detailTagihanAir->meter_air_awal }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        readonly>
                                </div>
                                <div class="w-full">
                                    <label for="meter_air_akhir"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Meter Akhir (m³)') }}
                                    </label>
                                    <input type="text" id="meter_air_akhir" name="meter_air_akhir"
                                        value="{{ $detailTagihanAir->meter_air_akhir }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        readonly>
                                </div>
                                <div class="w-full">
                                    <label for="pemakaian_air"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Pemakaian (m³)') }}
                                    </label>
                                    <input type="text" id="pemakaian_air" name="pemakaian_air"
                                        value="{{ $detailTagihanAir->pemakaian_air }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        readonly>
                                </div>
                                <div class="w-full">
                                    <label for="biaya_air"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Biaya Air per m³') }}
                                    </label>
                                    <input type="text" id="biaya_air" name="biaya_air"
                                        value="{{ number_format($biaya_air->biaya_air, 2, ',', '.') }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        readonly>
                                </div>
                                <div class="w-full">
                                    <label for="tagihan_air"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Jumlah Tagihan Air (Rp)') }}
                                    </label>
                                    <input type="text" id="tagihan_air" name="tagihan_air"
                                        value="{{ $detailTagihanAir->tagihan_air }}"
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
                                        value="{{ number_format($biaya_admin->biaya_admin, 2, ',', '.') }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <div class="text-gray-900 text-lg font-semibold">
                                {{ __('Rincian Tagihan') }}
                            </div>
                        </div>
                        <div id="tagihan-container"
                            class="grid gap-4 sm:gap-6 sm:col-span-4 sm:grid-cols-1 rounded-lg p-6 shadow-md sm:rounded-2xl bg-[#01645222]">
                            @foreach ($ipl->detailJenisTagihan as $index => $jenisTagihan)
                                <div class="grid gap-4 sm:grid-cols-4 sm:gap-6 tagihan-row">
                                    <div class="sm:col-span-1">
                                        <label for="jenis_tagihan_{{ $index }}"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Jenis Tagihan') }}
                                        </label>
                                        <input type="text" id="jenis_tagihan_{{ $index }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ $jenisTagihan->nama_jenis_tagihan }}" readonly>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="jumlah_{{ $index }}"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Jumlah (Rp)') }}
                                        </label>
                                        <input type="text" id="jumlah_{{ $index }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ number_format($jenisTagihan->pivot->jumlah, 2, ',', '.') }}"
                                            readonly>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-gray-900 text-lg font-bold sm:col-span-4">
                            {{ __('Total Akhir') }}: <span
                                id="total_akhir">Rp{{ number_format($ipl->total, 2, ',', '.') }}</span>
                        </div>
                        <div class="w-full">
                            <label for="foto_bukti_pembayaran"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('Bukti Pembayaran') }}
                            </label>
                            @if ($ipl->foto_bukti_pembayaran)
                                <div>
                                    <img src="{{ asset('storage/bukti_pembayaran/' . $ipl->foto_bukti_pembayaran) }}"
                                        alt="Foto Bukti Pembayaran"
                                        class="w-auto h-48 rounded-lg hover:object-scale-down">
                                </div>
                            @else
                                <p class="text-gray-500">
                                    {{ __('Tidak ada foto bukti pembayaran.') }}
                                </p>
                            @endif
                        </div>
                        <div class="w-full">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Tagihan') }}</label>
                            <input type="text" id="status" name="status" value="{{ $ipl->status }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                readonly>
                        </div>
                        <div class="sm:col-span-4">
                            <a href="{{ route('ipl.index') }}"
                                class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
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
                @endif
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
