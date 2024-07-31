<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail penanganan komplain') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan detail penanganan komplain yang dipilih.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form>
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="komplain_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nomor Komplain') }}</label>
                                        <input type="text" name="komplain_id" id="komplain_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ $penanganan->komplain->nomor_laporan }}" readonly>
                                        </input>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="nomor_penanganan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Nomor Penanganan Komplain') }}
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="nomor_penanganan" id="nomor_penanganan"
                                                value="{{ $penanganan->nomor_penanganan }}" readonly
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Nomor penanganan komplain" required>
                                            <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                        <div class="sm:col-span-1">
                                            <label for="time"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Waktu Penanganan') }}</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input type="time" id="time" name="time"
                                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="{{ $penanganan->tanggal_penanganan ? $penanganan->tanggal_penanganan->format('H:i') : '' }}"
                                                    readonly />
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="tanggal_penanganan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Tanggal Penanganan') }}
                                            </label>
                                            <div class="relative max-w">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input id="tanggal_penanganan" name="tanggal_penanganan" type="text"
                                                    datepicker datepicker-format="yyyy-mm-dd" datepicker-buttons
                                                    datepicker-autoselect-today
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Pilih tanggal"
                                                    value="{{ $penanganan->tanggal_penanganan ? $penanganan->tanggal_penanganan->format('Y-m-d') : '' }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="kategori_penanganan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori') }}</label>
                                    <div
                                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'>
                                        @foreach ($penanganan->kategoriPenanganan as $kategori)
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                                {{ $kategori->nama_kategori_penanganan }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="respon_awal"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Respon Awal') }}</label>
                                    <div class="relative">
                                        <textarea id="respon_awal" name="respon_awal" rows="4"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            readonly>{{ $penanganan->respon_awal }}</textarea>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:col-span-2 sm:grid-cols-1 sm:gap-6">
                                        <div class="sm:col-span-2 text-gray-900 text-lg font-semibold">
                                            {{ __('Penugasan') }}</div>
                                        <div class="sm:row-span-2">
                                            <label for="users"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Penanganan Ditugaskan Kepada') }}
                                            </label>
                                            <div
                                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'>
                                                @foreach ($penanganan->users as $penugasan)
                                                    <span
                                                        class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                                        {{ $penugasan->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                        <div class="sm:col-span-2 text-gray-900 text-lg font-semibold">
                                            {{ __('Pengerjaan') }}</div>
                                        <div class="sm:col-span-4">
                                            <label for="pemeriksaan_awal"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pemeriksaan Awal') }}</label>
                                            <div class="relative">
                                                <textarea id="pemeriksaan_awal" name="pemeriksaan_awal" rows="4"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    readonly>{{ $penanganan->pemeriksaan_awal }}</textarea>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-4">
                                            <label for="penyelesaian_komplain"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Penyelesaian Komplain') }}</label>
                                            <div class="relative">
                                                <textarea name="penyelesaian_komplain" id="penyelesaian_komplain" rows="4"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    readonly>{{ $penanganan->penyelesaian_komplain }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="foto_pemeriksaan_awal"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Pemeriksaan Awal') }}</label>
                                    @if ($penanganan->foto_pemeriksaan_awal)
                                        <div>
                                            <img src="{{ asset('storage/foto_pemeriksaan_awal/' . $penanganan->foto_pemeriksaan_awal) }}"
                                                alt="Foto Pemeriksaan Awal" class="w-full h-auto rounded-lg">
                                        </div>
                                    @else
                                        <p class="text-gray-500">{{ __('Tidak ada foto pemeriksaan awal.') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="foto_hasil_perbaikan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Hasil Perbaikan') }}</label>
                                    @if ($penanganan->foto_hasil_perbaikan)
                                        <div>
                                            <img src="{{ asset('storage/foto_hasil_perbaikan/' . $penanganan->foto_hasil_perbaikan) }}"
                                                alt="Foto Hasil Perbaikan" class="w-full h-auto rounded-lg">
                                        </div>
                                    @else
                                        <p class="text-gray-500">{{ __('Tidak ada foto hasil perbaikan.') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="grid gap-4 sm:col-span-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2 text-gray-900 text-lg font-semibold">
                                        {{ __('Persetujuan Selesai') }}
                                    </div>
                                    <div class="sm:row-span-2">
                                        <label for="persetujuan_selesai_tr" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Oleh Tenant Relation') }}</label>
                                        <div class="flex items-center">
                                            <input id="persetujuan_selesai_tr" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            {{ $penanganan->persetujuan_selesai_tr == 1 ? 'checked' : '' }} disabled>
                                            <label for="persetujuan_selesai_tr" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Tenant Relation menyetujui bahwa komplain telah diselesaikan')}}</label>
                                        </div>
                                    </div>
                                    <div class="sm:row-span-2">
                                        <label for="persetujuan_selesai_pelaksana" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Oleh Pelaksana') }}</label>
                                        <div class="flex items-center">
                                            <input id="persetujuan_selesai_pelaksana" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            {{ $penanganan->persetujuan_selesai_pelaksana == 1 ? 'checked' : '' }} disabled>
                                            <label for="persetujuan_selesai_pelaksana" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Pelaksana menyetujui bahwa komplain telah diselesaikan')}}</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <input type="hidden" id="created_by" name="created_by"
                                    value="{{ Auth::user()->id }}">
                                <input type="hidden" id="updated_by" name="updated_by"
                                    value="{{ Auth::user()->id }}"> --}}
                                <div class="sm:col-span-4 items-end">
                                    <a href="{{ route('penanganan.index') }}"
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
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-[#016452] rounded-lg focus:ring-4 focus:ring-[#014f415e] dark:focus:ring-primary-900 hover:bg-[#014F41]">
                                        <svg class="w-[16px] h-[16px] text-white dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7.414A2 2 0 0 0 20.414 6L18 3.586A2 2 0 0 0 16.586 3H5Zm3 11a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v6H8v-6Zm1-7V5h6v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" />
                                            <path fill-rule="evenodd" d="M14 17h-4v-2h4v2Z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Simpan') }}
                                    </button>
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
