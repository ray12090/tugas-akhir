<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Edit Penyewa') }}
                </div>
                <div class="text-gray-500 text-sm font-regular">
                    {{ __('Di bawah merupakan formulir untuk mengedit data penyewa. Formulir ini dapat diisi oleh Tenant Relation') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('penyewa.update', $penyewa->id) }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return confirmSave(this);">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="nik"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('NIK') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="nik" id="nik" value="{{ $penyewa->nik }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Nomor Induk Kependudukan Penyewa" required>
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">

                                    <div class="sm:col-span-1">
                                        <label for="agama_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Agama') }}</label>
                                        <select name="agama_id" id="agama_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($detailAgamas as $detailAgama)
                                                <option value="{{ $detailAgama->id }}"
                                                    {{ $penyewa->agama_id == $detailAgama->id ? 'selected' : '' }}>
                                                    {{ $detailAgama->nama_agama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="perkawinan_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status Perkawinan') }}</label>
                                        <select name="perkawinan_id" id="perkawinan_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($detailPerkawinans as $detailPerkawinan)
                                                <option value="{{ $detailPerkawinan->id }}"
                                                    {{ $penyewa->perkawinan_id == $detailPerkawinan->id ? 'selected' : '' }}>
                                                    {{ $detailPerkawinan->status_perkawinan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="user_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email Penyewa') }}</label>
                                        <select name="user_id" id="user_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="" textonly>{{ __('Belum ada akun') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $penyewa->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="nama_penyewa"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Nama Penyewa') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="nama_penyewa" id="nama_penyewa"
                                            value="{{ $penyewa->nama_penyewa }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Nama lengkap penyewa" required>
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="no_hp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('No. HP') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="no_hp" id="no_hp"
                                            value="{{ $penyewa->no_hp }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="123-1234-5678" required>
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:col-span-1 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="tempat_lahir_id" id="labelTempatLahir"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Tempat Lahir') }}
                                        </label>
                                        <button id="dropdownSearchButtonTempatLahir"
                                            data-dropdown-toggle="dropdownSearchTempatLahir"
                                            class="w-full text-gray-900 bg-gray-50 border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-small rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 focus:outline-none"
                                            type="button">
                                            {{ $penyewa->tempatLahir->name ?? __('Pilih Tempat Lahir') }}
                                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                            </svg>
                                        </button>
                                        <div id="dropdownSearchTempatLahir"
                                            class="z-10 hidden bg-white rounded-lg w-60 dark:bg-gray-700 outline-gray-300 outline outline-1">
                                            <div class="p-3">
                                                <label for="tempat_lahir_search"
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
                                                    <input type="text" id="tempat_lahir_search"
                                                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Cari Kabupaten/Kota">
                                                </div>
                                            </div>
                                            <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownSearchButtonTempatLahir">
                                                @foreach ($detailTempatLahir as $kota)
                                                    <li>
                                                        <div
                                                            class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                            <input id="tempat_lahir_id_{{ $kota->id }}"
                                                                type="radio" value="{{ $kota->id }}"
                                                                name="tempat_lahir_id"
                                                                {{ $penyewa->tempat_lahir_id == $kota->id ? 'checked' : '' }}
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                            <label for="tempat_lahir_id_{{ $kota->id }}"
                                                                class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                {{ $kota->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="jenis_kelamin"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Jenis Kelamin') }}
                                        </label>
                                        <ul
                                            class="w-auto text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="laki-laki" type="radio" value="Laki-laki"
                                                        name="jenis_kelamin"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                        {{ $penyewa->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                                                    <label for="laki-laki"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        {{ __('Laki-laki') }}
                                                    </label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                                <div class="flex items-center ps-3">
                                                    <input id="perempuan" type="radio" value="Perempuan"
                                                        name="jenis_kelamin"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                        {{ $penyewa->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                                    <label for="perempuan"
                                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        {{ __('Perempuan') }}
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_lahir"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Lahir') }}</label>
                                    <div class="relative max-w">
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
                                        <input id="tanggal_lahir" name="tanggal_lahir" type="text" datepicker
                                            datepicker-format="yyyy-mm-dd" datepicker-buttons
                                            datepicker-autoselect-today
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="YYYY-MM-DD" value="{{ $penyewa->tanggal_lahir }}" required>
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-5 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="warga_negara_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Warga Negara') }}</label>
                                        <select name="warga_negara_id" id="warga_negara_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($detailKewarganegaraans as $detailKewarganegaraan)
                                                <option value="{{ $detailKewarganegaraan->id }}"
                                                    {{ $penyewa->warga_negara_id == $detailKewarganegaraan->id ? 'selected' : '' }}>
                                                    {{ $detailKewarganegaraan->status_kewarganegaraan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="alamat_provinsi_id" id="labelAlamatProvinsi"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Alamat (diisi ulang)') }}</label>
                                        <select name="alamat_provinsi_id" id="alamat_provinsi_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="">{{ __('Pilih Provinsi') }}</option>
                                            @foreach ($detailAlamatProvinsi as $provinsi)
                                                <option value="{{ $provinsi->id }}"
                                                    {{ $penyewa->alamat_provinsi_id == $provinsi->id ? 'selected' : '' }}>
                                                    {{ $provinsi->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="alamat_kabupaten_id" id="labelAlamatKabupaten"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></br></label>
                                        <select name="alamat_kabupaten_id" id="alamat_kabupaten_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            disabled>
                                            <option value="">{{ __('Pilih Kabupaten') }}</option>
                                        </select>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="alamat_kecamatan_id" id="labelAlamatKecamatan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></br></label>
                                        <select name="alamat_kecamatan_id" id="alamat_kecamatan_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            disabled>
                                            <option value="">{{ __('Pilih Kecamatan') }}</option>
                                        </select>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <label for="alamat_village_id" id="labelAlamatVillage"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></br></label>
                                        <select name="alamat_village_id" id="alamat_village_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            disabled>
                                            <option value="">{{ __('Pilih Kelurahan') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="alamat"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Jalan') }}</label>
                                    <div class="relative">
                                        <textarea id="alamat" name="alamat" rows="4"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ $penyewa->alamat }}</textarea>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="foto_ktp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto KTP') }}</label>
                                    @if ($penyewa->foto_ktp)
                                        <div>
                                            <img src="{{ asset('storage/foto_ktp/' . $penyewa->foto_ktp) }}"
                                                alt="Foto KTP" class="w-auto h-64 rounded-lg">
                                        </div>
                                    @else
                                        <p class="text-gray-500">
                                            {{ __('Tidak ada foto KTP.') }}
                                        </p>
                                    @endif
                                    <input type="file" id="foto_ktp" name="foto_ktp"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-2">
                                </div>
                                <div id="unit-container" class="sm:col-span-3">
                                    <div class="mb-4 text-lg font-bold text-gray-900 dark:text-white sm:col-span-4">
                                        {{ __('Unit Penyewa') }}
                                    </div>
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 mb-4">
                                        <div class="sm:col-span-1">
                                            <label for="unit_id" id="labelUnit"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Unit') }}
                                            </label>
                                            <select name="unit_id" id="unit_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}"
                                                        {{ $penyewa->unit_id == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->nama_unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <label for="awal_sewa"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Awal Sewa') }}
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
                                                <input id="awal_sewa" name="awal_sewa" type="text" datepicker
                                                    datepicker-format="yyyy-mm-dd" datepicker-buttons
                                                    datepicker-orientation="{auto}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="YYYY-MM-DD"
                                                    value="{{ $penyewa->awal_sewa }}"required>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <label for="akhir_sewa"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Akhir Sewa') }}
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
                                                <input id="akhir_sewa" name="akhir_sewa" type="text" datepicker
                                                    datepicker-format="yyyy-mm-dd" datepicker-buttons
                                                    datepicker-orientation="{auto}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="YYYY-MM-DD" value="{{ $penyewa->akhir_sewa }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-4 items-end">
                                <a href="{{ route('penyewa.index') }}"
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
                                    <svg class="w-[16px] h-[16px] text-white dark:text-white mr-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
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
        document.addEventListener("DOMContentLoaded", function() {
            // Search functionality for "Tempat Lahir"
            const searchInputTempatLahir = document.getElementById('tempat_lahir_search');
            const listItemsTempatLahir = document.querySelectorAll('#dropdownSearchTempatLahir ul li');
            searchInputTempatLahir.addEventListener('input', function() {
                const filter = searchInputTempatLahir.value.toLowerCase();
                listItemsTempatLahir.forEach(function(item) {
                    const text = item.textContent || item.innerText;
                    if (text.toLowerCase().includes(filter)) {
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });

        // Dropdown for "Tempat Lahir"
        const dropdownButtonTempatLahir = document.getElementById('dropdownSearchButtonTempatLahir');
        const radiosTempatLahir = document.getElementsByName('tempat_lahir_id');
        radiosTempatLahir.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    dropdownButtonTempatLahir.innerHTML = this.nextElementSibling.textContent +
                        ' <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" /></svg>';
                }
            });
        });

        // Fetch Kabupaten, Kecamatan, Kelurahan based on selected values
        const provinsiSelect = document.getElementById('alamat_provinsi_id');
        const kabupatenSelect = document.getElementById('alamat_kabupaten_id');
        const kecamatanSelect = document.getElementById('alamat_kecamatan_id');
        const kelurahanSelect = document.getElementById('alamat_village_id');

        provinsiSelect.addEventListener('change', function() {
            const provinsiId = this.value;
            if (provinsiId) {
                fetch(`/api/get-kabupaten/${provinsiId}`)
                    .then(response => response.json())
                    .then(data => {
                        kabupatenSelect.innerHTML =
                            '<option value="">{{ __('Pilih Kabupaten') }}</option>';
                        data.forEach(kabupaten => {
                            kabupatenSelect.innerHTML +=
                                `<option value="${kabupaten.id}">${kabupaten.name}</option>`;
                        });
                        kabupatenSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching kabupaten:', error);
                        kabupatenSelect.innerHTML =
                            '<option value="">{{ __('Error fetching data') }}</option>';
                        kabupatenSelect.disabled = true;
                    });
            } else {
                kabupatenSelect.innerHTML = '<option value="">{{ __('Pilih Kabupaten') }}</option>';
                kabupatenSelect.disabled = true;
                kecamatanSelect.innerHTML = '<option value="">{{ __('Pilih Kecamatan') }}</option>';
                kecamatanSelect.disabled = true;
                kelurahanSelect.innerHTML = '<option value="">{{ __('Pilih Kelurahan') }}</option>';
                kelurahanSelect.disabled = true;
            }
        });

        kabupatenSelect.addEventListener('change', function() {
            const kabupatenId = this.value;
            if (kabupatenId) {
                fetch(`/api/get-kecamatan/${kabupatenId}`)
                    .then(response => response.json())
                    .then(data => {
                        kecamatanSelect.innerHTML =
                            '<option value="">{{ __('Pilih Kecamatan') }}</option>';
                        data.forEach(kecamatan => {
                            kecamatanSelect.innerHTML +=
                                `<option value="${kecamatan.id}">${kecamatan.name}</option>`;
                        });
                        kecamatanSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching kecamatan:', error);
                        kecamatanSelect.innerHTML =
                            '<option value="">{{ __('Error fetching data') }}</option>';
                        kecamatanSelect.disabled = true;
                    });
            } else {
                kecamatanSelect.innerHTML = '<option value="">{{ __('Pilih Kecamatan') }}</option>';
                kecamatanSelect.disabled = true;
                kelurahanSelect.innerHTML = '<option value="">{{ __('Pilih Kelurahan') }}</option>';
                kelurahanSelect.disabled = true;
            }
        });

        kecamatanSelect.addEventListener('change', function() {
            const kecamatanId = this.value;
            if (kecamatanId) {
                fetch(`/api/get-kelurahan/${kecamatanId}`)
                    .then(response => response.json())
                    .then(data => {
                        kelurahanSelect.innerHTML =
                            '<option value="">{{ __('Pilih Kelurahan') }}</option>';
                        data.forEach(kelurahan => {
                            kelurahanSelect.innerHTML +=
                                `<option value="${kelurahan.id}">${kelurahan.name}</option>`;
                        });
                        kelurahanSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching kelurahan:', error);
                        kelurahanSelect.innerHTML =
                            '<option value="">{{ __('Error fetching data') }}</option>';
                        kelurahanSelect.disabled = true;
                    });
            } else {
                kelurahanSelect.innerHTML = '<option value="">{{ __('Pilih Kelurahan') }}</option>';
                kelurahanSelect.disabled = true;
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('no_hp');

            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Hanya biarkan angka
                value = value.slice(0, 15); // Batasi maksimum 15 digit
                const length = value.length;

                if (length > 3 && length <= 7) {
                    value = `${value.slice(0, 3)}-${value.slice(3)}`;
                } else if (length > 7 && length <= 11) {
                    value = `${value.slice(0, 3)}-${value.slice(3, 7)}-${value.slice(7)}`;
                } else if (length > 11) {
                    value =
                        `${value.slice(0, 3)}-${value.slice(3, 7)}-${value.slice(7, 11)}-${value.slice(11, 15)}`;
                }
                e.target.value = value;
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi untuk mengaktifkan atau menonaktifkan dropdown provinsi
            function toggleProvinsiDropdown() {
                const wargaNegaraId = document.getElementById('warga_negara_id').value;
                const provinsiDropdown = document.getElementById('alamat_provinsi_id');

                if (wargaNegaraId !== '1') { // Misal id 1 adalah Indonesia
                    provinsiDropdown.disabled = true;
                    provinsiDropdown.value = ''; // Reset pilihan
                    document.getElementById('alamat_kabupaten_id').disabled = true;
                    document.getElementById('alamat_kecamatan_id').disabled = true;
                    document.getElementById('alamat_village_id').disabled = true;
                } else {
                    provinsiDropdown.disabled = false;
                }
            }

            // Inisialisasi dropdown provinsi saat DOM siap
            toggleProvinsiDropdown();

            // Event listener untuk perubahan di dropdown warga negara
            document.getElementById('warga_negara_id').addEventListener('change', toggleProvinsiDropdown);
        });
    </script>
</x-app-layout>
