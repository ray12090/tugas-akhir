<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Edit Komplain') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk mengedit data komplain. Isi formulir ini dapat diisi oleh Tenant Relation') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('komplain.update', $komplain->id) }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return confirmSave(this);">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="grid gap-4 sm:col-span-2 sm:grid-cols-4 sm:gap-6">
                                    <div class="sm:col-span-1">
                                        <label for="jenis_komplain_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori Laporan') }}</label>
                                        <select name="jenis_komplain_id" id="jenis_komplain_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($jenisKomplains as $jenis)
                                                <option value="{{ $jenis->id }}"
                                                    {{ $komplain->jenis_komplain_id == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama_jenis_komplain }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="nomor_laporan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Nomor Laporan') }}
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="nomor_laporan" id="nomor_laporan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ $komplain->nomor_laporan }}" readonly>
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
                                        <label for="status_komplain_id" id="labelStatusKomplain"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status') }}</label>
                                        <select name="status_komplain_id" id="status_komplain_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($statusKomplains as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $komplain->status_komplain_id == $status->id ? 'selected' : '' }}>
                                                    {{ $status->nama_status_komplain }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="unit_id" id="labelUnit"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nama Unit') }}</label>
                                    <select name="unit_id" id="unit_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ $komplain->unit_id == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->nama_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_laporan"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Tanggal Laporan') }}
                                    </label>
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
                                        <input id="tanggal_laporan" name="tanggal_laporan" type="text" datepicker
                                            datepicker-format="yyyy-mm-dd" datepicker-buttons
                                            datepicker-autoselect-today
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            value="{{ $komplain->tanggal_laporan }}">
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Identitas Pelapor') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="nama_pelapor"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Nama Pelapor') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="nama_pelapor" id="nama_pelapor"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Nama lengkap pelapor" value="{{ $komplain->nama_pelapor }}"
                                            required>
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="no_hp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('No. HP') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="no_hp" id="no_hp"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Nomor handphone pelapor" value="{{ $komplain->no_hp }}"
                                            required>
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Isi Komplain') }}
                                    </div>
                                </div>
                                <div id="lokasi-komplain-container" class="sm:col-span-3">
                                    @foreach ($komplain->lokasiKomplains as $index => $lokasi)
                                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 lokasi-komplain-row">
                                            <div class="sm:col-span-1">
                                                <label for="lokasi_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ __('Lokasi') }}
                                                </label>
                                                <select id="lokasi_komplain_{{ $index }}"
                                                    name="lokasi_komplain[{{ $index }}][lokasi_id]"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    @foreach ($lokasiKomplains as $lokasiOption)
                                                        <option value="{{ $lokasiOption->id }}"
                                                            {{ $lokasi->pivot->lokasi_komplain_id == $lokasiOption->id ? 'selected' : '' }}>
                                                            {{ $lokasiOption->nama_lokasi_komplain }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for="uraian_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Uraian Komplain') }}</label>
                                                <textarea id="uraian_komplain_{{ $index }}" name="lokasi_komplain[{{ $index }}][uraian_komplain]"
                                                    rows="2"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ $lokasi->pivot->uraian_komplain }}</textarea>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <label for="foto_komplain_{{ $index }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto') }}</label>
                                                    @if ($lokasi->pivot->foto_komplain)
                                                        <div>
                                                            <img src="{{ asset('storage/foto_komplain/' . $lokasi->pivot->foto_komplain) }}"
                                                                alt="Foto Komplain"
                                                                class="w-auto h-48 rounded-lg hover:object-scale-down">
                                                        </div>
                                                    @else
                                                        <p class="text-gray-500">
                                                            {{ __('Tidak ada foto komplain.') }}
                                                        </p>
                                                    @endif
                                                <input type="file" id="foto_komplain_{{ $index }}"
                                                    name="lokasi_komplain[{{ $index }}][foto_komplain]"
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-2">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="sm:col-span-1">
                                    <label for=""
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></br></label>
                                    <button type="button" id="tambah-lokasi-btn"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                        {{ __('Tambah lokasi lainnya') }}
                                    </button>
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
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                        <svg class="w-[16px] h-[16px] text-white dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7.414A2 2 0 0 0 20.414 6L18 3.586A2 2 0 0 0 16.586 3H5Zm3 11a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v6H8v-6Zm1-7V5h6v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" />
                                            <path fill-rule="evenodd" d="M14 17h-4v-2h4v2Z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Perbarui') }}
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
    <style>
        .span-container {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            padding: 10px;
        }

        .uraian-container,
        .foto-container {
            margin-top: 10px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdownRadioButton');
            const dropdownMenu = document.getElementById('dropdownDefaultRadio');

            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });

        // Handle the addition of new complaint locations
        document.getElementById('tambah-lokasi-btn').addEventListener('click', function() {
            var container = document.getElementById('lokasi-komplain-container');
            var index = container.children.length; // Get current index based on number of existing children

            // Create new elements for a new location complaint
            var newRow = document.createElement('div');
            newRow.classList.add('grid', 'gap-4', 'sm:grid-cols-3', 'sm:gap-6', 'lokasi-komplain-row');

            var newLokasi = `
                <div class="sm:col-span-1">
                    <label for="lokasi_komplain_${index}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Lokasi') }}</label>
                    <select id="lokasi_komplain_${index}" name="lokasi_komplain[${index}][lokasi_id]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>{{ __('Pilih lokasi') }}</option>
                        @foreach ($lokasiKomplains as $lokasi)
                            <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi_komplain }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-1">
                    <label for="uraian_komplain_${index}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Uraian Komplain') }}</label>
                    <textarea id="uraian_komplain_${index}" name="lokasi_komplain[${index}][uraian_komplain]"
                        rows="2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                </div>
                <div class="sm:col-span-1">
                    <label for="foto_komplain_${index}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto') }}</label>
                    <input type="file" id="foto_komplain_${index}" name="lokasi_komplain[${index}][foto_komplain]"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-2">
                </div>
            `;

            newRow.innerHTML = newLokasi;
            container.appendChild(newRow);
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetch('/generate-nomor-laporan')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nomor_laporan').value = data.nomor_laporan;
                })
                .catch(error => console.error('Error fetching nomor laporan:', error));
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            var today = new Date();
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
            var dateToday = today.getFullYear() + "-" + month + "-" + day;
            document.getElementById("tanggal_laporan").value = dateToday;
        });
    </script>
</x-app-layout>
