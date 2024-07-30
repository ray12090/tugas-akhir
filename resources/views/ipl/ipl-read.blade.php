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
                <div class="text-gray-500 text-sm font-regular">
                    {{ __('Berikut adalah rincian data pembayaran IPL.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                            <div class="sm:col-span-4">
                                <div class="grid gap-4 sm:grid-cols-6 sm:gap-6">
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('No. Invoice') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $ipl->nomor_invoice }}</p>
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Tanggal Invoice') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $ipl->tanggal_invoice }}</p>
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Jatuh Tempo') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $ipl->jatuh_tempo }}</p>
                                    </div>
                                    <div class="w-full sm:col-span-1">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pembayaran Bulan') }}</label>
                                        <p class="text-gray-900 dark:text-white">{{ $ipl->bulan_ipl }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Pemilik') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $ipl->pemilik->nama_pemilik }}</p>
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Unit') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $ipl->unit->nama_unit }}</p>
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
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Meter Awal (m³)') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $detailTagihanAir->meter_air_awal }}</p>
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Meter Akhir (m³)') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $detailTagihanAir->meter_air_akhir }}</p>
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Pemakaian (m³)') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ $detailTagihanAir->pemakaian_air }}</p>
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Harga Air per m³') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ number_format($biaya_air->biaya_air, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Jumlah Tagihan Air (Rp)') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ number_format($detailTagihanAir->tagihan_air, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Biaya Admin') }}
                                        </label>
                                        <p class="text-gray-900 dark:text-white">{{ number_format($biaya_admin->biaya_admin, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="sm:col-span-2"></div>
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <div class="text-gray-900 text-lg font-semibold">
                                    {{ __('Rincian Tagihan') }}
                                </div>
                            </div>
                            <div id="tagihan-container" class="grid gap-4 sm:gap-6 sm:col-span-4 sm:grid-cols-1 rounded-lg p-6 shadow-md sm:rounded-2xl bg-gray-100">
                                @foreach ($detailTagihans as $index => $detailTagihan)
                                    <div class="grid gap-4 sm:grid-cols-4 sm:gap-6 tagihan-row">
                                        <div class="sm:col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jenis Tagihan') }}
                                            </label>
                                            <p class="text-gray-900 dark:text-white">{{ $detailTagihan->jenisTagihan->nama_jenis_tagihan }}</p>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Jumlah (Rp)') }}
                                            </label>
                                            <p class="text-gray-900 dark:text-white">{{ number_format($detailTagihan->jumlah, 2, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-gray-900 text-lg font-bold sm:col-span-4">
                                {{ __('Total Akhir') }}: <span id="total_akhir">Rp{{ number_format($ipl->total, 2, ',', '.') }}</span>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('Bukti Pembayaran') }}
                                </label>
                                @if ($ipl->foto_bukti_pembayaran)
                                    <div>
                                        <img src="{{ asset('storage/bukti_pembayaran/' . $ipl->foto_bukti_pembayaran) }}" alt="Foto Bukti Pembayaran" class="w-auto h-48 rounded-lg hover:object-scale-down">
                                    </div>
                                @else
                                    <p class="text-gray-500">
                                        {{ __('Tidak ada foto bukti pembayaran.') }}
                                    </p>
                                @endif
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Pembayaran') }}</label>
                                <p class="text-gray-900 dark:text-white">{{ $ipl->status }}</p>
                            </div>
                            <div class="sm:col-span-4">
                                <a href="{{ route('ipl.index') }}" class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd" />
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
