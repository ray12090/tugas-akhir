<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Penanganan Komplain') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    <div class="flex mb-2">
                        <span class="text-gray-500 dark:text-white w-1/6">{{ __('No. Laporan Komplain') }}</span>
                        <span class="w-1/8 font-bold">: {{ $penanganan->komplain->nomor_laporan }}</span>
                    </div>
                    <div class="flex mb-2">
                        <span class="text-gray-500 dark:text-white w-1/6">{{ __('No. Penanganan Komplain') }}</span>
                        <span class="w-1/8">: {{ $penanganan->nomor_penanganan }}</span>
                    </div>
                    <div class="flex mb-2">
                        <span class="text-gray-500 dark:text-white w-1/6">{{ __('No. Unit') }}</span>
                        <span class="w-1/8">: {{ $penanganan->komplain->unit->nama_unit }}</span>
                    </div>
                    <div class="flex mb-2">
                        <span class="text-gray-500 dark:text-white w-1/6">{{ __('Tanggal Laporan Komplain') }}</span>
                        <span class="w-1/8">: {{ $penanganan->komplain->tanggal_laporan }}</span>
                    </div>
                    <div class="flex mb-2">
                        <span class="text-gray-500 dark:text-white w-1/6">{{ __('Nama Pelapor') }}</span>
                        <span class="w-1/8">: {{ $penanganan->komplain->nama_pelapor }}</span>
                    </div>
                    <div class="flex mb-2">
                        <span class="text-gray-500 dark:text-white w-1/6">{{ __('No. HP Pelapor') }}</span>
                        <span class="w-1/8">: {{ $penanganan->komplain->no_hp }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __('Detail laporan pengerjaan komplain oleh yang ditugaskan.') }}</span>
                    </div>
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                            <div class="sm:col-span-4 text-gray-900 text-lg font-semibold">
                                {{ __('Penugasan') }}
                            </div>
                            <div class="grid gap-4 sm:col-span-4 sm:grid-cols-8 sm:gap-6">
                                <div class="sm:col-span-1">
                                    <label for="status_komplain_id" id="labelStatusKomplain"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status') }}</label>
                                    <div class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                        {{ $penanganan->komplain->statusKomplain->nama_status_komplain }}
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="time"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Waktu Penanganan') }}</label>
                                    <div class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                        {{ \Carbon\Carbon::parse($penanganan->tanggal_penanganan)->format('H:i') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_penanganan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Penanganan') }}</label>
                                    <div class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                        {{ \Carbon\Carbon::parse($penanganan->tanggal_penanganan)->format('Y-m-d') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="users_id" id="labelUsers"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Ditugaskan kepada') }}</label>
                                    <div id="selected-users"
                                        class="relative flex flex-wrap gap-2 bg-gray-50 border border-gray-300 p-2.5 text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        @foreach ($penanganan->users as $user)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $user->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="kategori_penanganan_id" id="labelKategoriPenanganan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori Penanganan') }}</label>
                                    <div class="relative flex flex-wrap gap-2 bg-gray-50 border border-gray-300 p-2.5 text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        @foreach ($penanganan->kategoriPenanganan as $kategori)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $kategori->nama_kategori_penanganan }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="sm:col-span-3">
                                <label for="penanganan_by"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Penanganan Oleh:') }}</label>
                                <div id="selected-users-nontr"
                                    class="relative flex flex-wrap gap-2 bg-gray-50 border border-gray-300 p-2.5 text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @foreach ($penanganan->users as $user)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $user->name }}</span>
                                    @endforeach
                                </div>
                            </div> --}}
                            <div class="sm:col-span-4">
                                <div class="text-gray-900 text-lg font-semibold">
                                    {{ __('Detail Komplain') }}
                                </div>
                            </div>
                            <div id="lokasi-komplain-container"
                                class="grid gap-4 sm:gap-6 sm:col-span-4 sm:grid-cols-1 rounded-lg sm:rounded-2xl pb-6">
                                @foreach ($penanganan->komplain->lokasiKomplains as $index => $lokasi)
                                    @if ($lokasi->id == $penanganan->lokasi_komplain_id)
                                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 lokasi-komplain-row ">
                                            <div class="sm:col-span-1">
                                                <label for="lokasi_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Lokasi') }}
                                                </label>
                                                <div id="lokasi_komplain_{{ $index }}"
                                                    class="bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border">
                                                    {{ $lokasi->nama_lokasi_komplain }}
                                                </div>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for="uraian_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Uraian Komplain') }}</label>
                                                <textarea id="uraian_komplain_{{ $index }}" disabled rows="4"
                                                    class="w-full bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border border-gray-200">{{ $lokasi->pivot->uraian_komplain ?? 'Tidak diketahui' }}</textarea>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for="foto_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto') }}</label>
                                                @if ($lokasi->pivot->foto_komplain ?? false)
                                                    <div>
                                                        <img src="{{ asset('storage/foto_komplain/' . $lokasi->pivot->foto_komplain) }}"
                                                            alt="Foto Komplain" class="w-auto h-80 rounded-lg">
                                                    </div>
                                                @else
                                                    <p class="text-gray-500">
                                                        {{ __('Tidak ada foto komplain.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                            <div class="sm:col-span-4">
                                <label for="respon_awal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Respon Awal') }}</label>
                                <textarea id="respon_awal" disabled rows="4"
                                    class="w-full bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border border-gray-200">{{ $penanganan->respon_awal }}</textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="pemeriksaan_awal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pemeriksaan Awal') }}</label>
                                <textarea id="pemeriksaan_awal" disabled rows="4"
                                    class="w-full bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border border-gray-200">{{ $penanganan->pemeriksaan_awal }}</textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="penyelesaian_komplain"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Penyelesaian Komplain') }}</label>
                                <textarea id="penyelesaian_komplain" disabled rows="4"
                                    class="w-full bg-gray-50 text-sm text-gray-900 dark:text-white p-2.5 rounded-lg border border-gray-200">{{ $penanganan->penyelesaian_komplain }}</textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="foto_pemeriksaan_awal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Pemeriksaan Awal') }}</label>
                                @if ($penanganan->foto_pemeriksaan_awal)
                                    <img src="{{ asset('storage/foto_pemeriksaan_awal/' . $penanganan->foto_pemeriksaan_awal) }}"
                                        class="mt-2" alt="Foto Pemeriksaan Awal" style="max-height: 320px;">
                                @else
                                    <p class="text-gray-500">{{ __('Tidak ada foto pemeriksaan awal.') }}</p>
                                @endif
                            </div>
                            <div class="sm:col-span-2">
                                <label for="foto_hasil_perbaikan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Hasil Perbaikan') }}</label>
                                @if ($penanganan->foto_hasil_perbaikan)
                                    <img src="{{ asset('storage/foto_hasil_perbaikan/' . $penanganan->foto_hasil_perbaikan) }}"
                                        class="mt-2" alt="Foto Hasil Perbaikan" style="max-height: 320px;">
                                @else
                                    <p class="text-gray-500">{{ __('Tidak ada foto hasil perbaikan.') }}</p>
                                @endif
                            </div>
                            <div class="grid gap-4 sm:col-span-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2 text-gray-900 text-lg font-semibold">
                                    {{ __('Persetujuan Selesai') }}</div>
                                <div class="sm:row-span-2">
                                    <label for="persetujuan_selesai_tr"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Oleh Tenant Relation') }}</label>
                                    <div class="flex items-center">
                                        <input id="persetujuan_selesai_tr" type="checkbox" value="1"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            disabled {{ $penanganan->persetujuan_selesai_tr ? 'checked' : '' }}>
                                        <label for="persetujuan_selesai_tr"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ __('Tenant Relation menyetujui bahwa komplain telah diselesaikan') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="sm:row-span-2">
                                    <label for="persetujuan_selesai_pelaksana"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Oleh Pelaksana') }}</label>
                                    <div class="flex items-center">
                                        <input id="persetujuan_selesai_pelaksana" type="checkbox" value="1"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            disabled {{ $penanganan->persetujuan_selesai_pelaksana ? 'checked' : '' }}>
                                        <label for="persetujuan_selesai_pelaksana"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ __('Pelaksana menyetujui bahwa komplain telah diselesaikan') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-4 items-end">
                                <a href="{{ route('penanganan.index') }}"
                                    class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
