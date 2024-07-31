<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Komplain') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Detail data komplain yang diajukan oleh Tenant Relation.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form>
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="jenis_komplain_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori Laporan') }}</label>
                                        <div id="jenis_komplain_id"
                                            class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                            {{ $jenisKomplains->firstWhere('id', $komplain->jenis_komplain_id)->nama_jenis_komplain ?? 'Tidak diketahui' }}
                                        </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="nomor_laporan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nomor Laporan') }}</label>
                                        <div id="nomor_laporan"
                                            class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                            {{ $komplain->nomor_laporan }}
                                        </div>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="status_komplain_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status') }}</label>
                                        <div id="status_komplain_id"
                                            class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                            {{ $statusKomplains->firstWhere('id', $komplain->status_komplain_id)->nama_status_komplain ?? 'Tidak diketahui' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="unit_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nama Unit') }}</label>
                                    <div id="unit_id"
                                        class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                        {{ $units->firstWhere('id', $komplain->unit_id)->nama_unit ?? 'Tidak diketahui' }}
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_laporan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Laporan') }}</label>
                                    <div id="tanggal_laporan"
                                        class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                        {{ $komplain->tanggal_laporan }}
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <div class="text-gray-900 text-lg font-semibold">
                                        {{ __('Identitas Pelapor') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="nama_pelapor"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nama Pelapor') }}</label>
                                    <div id="nama_pelapor"
                                        class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                        {{ $komplain->nama_pelapor }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="no_hp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('No. HP') }}</label>
                                    <div id="no_hp"
                                        class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                        {{ $komplain->no_hp }}
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <div class="text-gray-900 text-lg font-semibold">
                                        {{ __('Isi Komplain') }}
                                    </div>
                                </div>
                                <div id="lokasi-komplain-container" 
                                class="grid gap-4 sm:gap-6 sm:col-span-4 sm:grid-cols-1 bg-[#01645222] rounded-lg p-6 shadow-md sm:rounded-2xl" >
                                    @foreach ($komplain->lokasiKomplains as $index => $lokasi)
                                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 lokasi-komplain-row ">
                                            <div class="sm:col-span-1">
                                                <label for="lokasi_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Lokasi') }}
                                                </label>
                                                <div id="lokasi_komplain_{{ $index }}"
                                                    class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                                    {{ $lokasiKomplains->firstWhere('id', $lokasi->pivot->lokasi_komplain_id)->nama_lokasi_komplain ?? 'Tidak diketahui' }}
                                                </div>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for="uraian_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Uraian Komplain') }}</label>
                                                <div id="uraian_komplain_{{ $index }}"
                                                    class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                                    {{ $lokasi->pivot->uraian_komplain }}
                                                </div>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for="foto_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto') }}</label>
                                                @if ($lokasi->pivot->foto_komplain)
                                                    <div>
                                                        <img src="{{ asset('storage/foto_komplain/' . $lokasi->pivot->foto_komplain) }}"
                                                            alt="Foto Komplain"
                                                            class="w-full h-auto rounded-lg">
                                                    </div>
                                                @else
                                                    <p class="text-gray-500">
                                                        {{ __('Tidak ada foto komplain.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="sm:col-span-4">
                                    <a href="{{ route('komplain.index') }}"
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
            </div>
        </div>
        @include('components.modal', ['type' => 'confirmation'])
    </div>
</x-app-layout>
