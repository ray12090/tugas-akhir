<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Tambah penanganan') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk menambah data penanganan. Isi formulir ini dapat diisi oleh Tenant Relation') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('penanganan.store') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return confirmSave(this);">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="komplain_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nomor Komplain') }}</label>
                                        <select name="komplain_id" id="komplain_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($komplains as $komplain)
                                                <option value="{{ $komplain->id }}">{{ $komplain->nomor_laporan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="nomor_penanganan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Nomor Penanganan Komplain') }}
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="nomor_penanganan" id="nomor_penanganan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Nomor penanganan komplain" readonly>
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
                                                    required />
                                            </div>
                                        </div>
                                        <div class="sm:col-span-3">
                                            <label for="tanggal_penanganan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Penanganan') }}</label>
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
                                                    placeholder="Pilih tanggal" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="kategori_penanganan_id" id="labelKategoriPenanganan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Kategori Penanganan') }}
                                    </label>
                                    <button id="dropdownSearchButtonKategoriPenanganan"
                                        data-dropdown-toggle="dropdownSearchKategoriPenanganan"
                                        class="text-gray-900 bg-gray-50 border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-small rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 focus:outline-none"
                                        type="button">{{ __('Pilih Kategori') }}
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <div id="dropdownSearchKategoriPenanganan"
                                        class="z-10 hidden bg-white rounded-lg w-60 dark:bg-gray-700 outline-gray-300 outline outline-1">
                                        <div class="p-3">
                                            <label for="kategori_penanganan_search"
                                                class="sr-only">{{ __('Search') }}</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                    </svg>
                                                </div>
                                                <input type="text" id="kategori_penanganan_search"
                                                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Cari Kategori">
                                            </div>
                                        </div>
                                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownSearchButtonKategoriPenanganan">
                                            @foreach ($kategoriPenanganans as $kategori)
                                                <li>
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="kategori_penanganan_id_{{ $kategori->id }}"
                                                            type="checkbox" value="{{ $kategori->id }}"
                                                            name="kategori_penanganan_id[]"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="kategori_penanganan_id_{{ $kategori->id }}"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                            {{ $kategori->nama_kategori_penanganan }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="respon_awal"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Respon Awal') }}</label>
                                    <div class="relative">
                                        <textarea id="respon_awal" name="respon_awal" rows="4"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                                    </div>
                                </div>
                                <div class="sm:col-span-4 text-gray-900 text-lg font-semibold">
                                    {{ __('Penugasan') }}</div>
                                <div class="sm:col-span-1">
                                    <label for="users_id" id="labelUsers"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Penanganan ini ditugaskan kepada') }}
                                    </label>
                                    <button id="dropdownSearchButtonUsers" data-dropdown-toggle="dropdownSearchUsers"
                                        class="text-gray-900 bg-gray-50 border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-small rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 focus:outline-none"
                                        type="button">{{ __('Pilih User') }}
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <div id="dropdownSearchUsers"
                                        class="z-10 hidden bg-white rounded-lg w-60 dark:bg-gray-700 outline-gray-300 outline outline-1">
                                        <div class="p-3">
                                            <label for="users_search" class="sr-only">{{ __('Search') }}</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                    </svg>
                                                </div>
                                                <input type="text" id="users_search"
                                                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Cari Nama">
                                            </div>
                                        </div>
                                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownSearchButtonUsers">
                                            @foreach ($users as $user)
                                                <li>
                                                    <div
                                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input id="users_id_{{ $user->id }}" type="checkbox"
                                                            value="{{ $user->id }}" name="users_id[]"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="users_id_{{ $user->id }}"
                                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                            {{ $user->name }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="sm:col-span-4 text-gray-900 text-lg font-semibold">
                                    {{ __('Pengerjaan') }}</div>
                                <div class="sm:col-span-2">
                                    <label for="pemeriksaan_awal"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pemeriksaan Awal') }}</label>
                                    <div class="relative">
                                        <textarea id="pemeriksaan_awal" name="pemeriksaan_awal" rows="4"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="penyelesaian_komplain"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Penyelesaian Komplain') }}</label>
                                    <div class="relative">
                                        <textarea name="penyelesaian_komplain" id="penyelesaian_komplain" rows="4"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="foto_pemeriksaan_awal"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Pemeriksaan Awal') }}</label>
                                    <input type="file" name="foto_pemeriksaan_awal" id="foto_pemeriksaan_awal"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="foto_pemeriksaan_awal">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, JPEG, PNG
                                        (MAX. 5MB).</p>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="foto_hasil_perbaikan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Hasil Perbaikan') }}</label>
                                    <input type="file" name="foto_hasil_perbaikan" id="foto_hasil_perbaikan"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="foto_hasil_perbaikan">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, JPEG, PNG
                                        (MAX. 5MB).</p>
                                </div>
                                <div class="grid gap-4 sm:col-span-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2 text-gray-900 text-lg font-semibold">
                                        {{ __('Persetujuan Selesai') }}
                                    </div>
                                    <div class="sm:row-span-2">
                                        <label for="persetujuan_selesai_tr"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Oleh Tenant Relation') }}</label>
                                        <div class="flex items-center">
                                            <input id="persetujuan_selesai_tr" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                disabled>
                                            <label for="persetujuan_selesai_tr"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Tenant Relation menyetujui bahwa komplain telah diselesaikan') }}</label>
                                        </div>
                                    </div>
                                    <div class="sm:row-span-2">
                                        <label for="persetujuan_selesai_pelaksana"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Oleh Pelaksana') }}</label>
                                        <div class="flex items-center">
                                            <input id="persetujuan_selesai_pelaksana" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                disabled>
                                            <label for="persetujuan_selesai_pelaksana"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Pelaksana menyetujui bahwa komplain telah diselesaikan') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="created_by" name="created_by"
                                    value="{{ Auth::user()->id }}">
                                <input type="hidden" id="updated_by" name="updated_by"
                                    value="{{ Auth::user()->id }}">
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
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
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

    <script>
        const searchInputKategoriPenanganan = document.getElementById('kategori_penanganan_search');
        const listItemsKategoriPenanganan = document.querySelectorAll('#dropdownSearchKategoriPenanganan ul li');

        searchInputKategoriPenanganan.addEventListener('input', function() {
            const filter = searchInputKategoriPenanganan.value.toLowerCase();
            listItemsKategoriPenanganan.forEach(function(item) {
                const text = item.textContent || item.innerText;
                if (text.toLowerCase().includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
        const searchInputUser = document.getElementById('users_search');
        const listItemsUser = document.querySelectorAll('#dropdownSearchUsers ul li');

        searchInputUser.addEventListener('input', function() {
            const filter = searchInputUser.value.toLowerCase();
            listItemsUser.forEach(function(item) {
                const text = item.textContent || item.innerText;
                if (text.toLowerCase().includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/generate-nomor-penanganan')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nomor_penanganan').value = data.nomor_penanganan;
                })
                .catch(error => console.error('Error fetching nomor penanganan:', error));
        });
        document.addEventListener('DOMContentLoaded', (event) => {
            var today = new Date();
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
            var dateToday = today.getFullYear() + "-" + month + "-" + day;
            document.getElementById("tanggal_penanganan").value = dateToday;
        });
        document.addEventListener('DOMContentLoaded', function() {
            var now = new Date();
            var hours = String(now.getHours()).padStart(2, '0');
            var minutes = String(now.getMinutes()).padStart(2, '0');
            var currentTime = hours + ':' + minutes;
            document.getElementById('time').value = currentTime;
        });
    </script>
</x-app-layout>
