<x-app-layout>
    <div>
        <div class="pb-6">
            @include('components.alert')
            {{-- @include('components.breadcrumbs', [
                'breadcrumbs' => [
                    ['title' => 'Dashboard', 'url' => Auth::user()->usertype === 'admin' ? route('admin-dashboard') : route('dashboard')],
                    ['title' => 'Data Kepenghunian', 'url' => route('kepenghunian.index')],
                    ['title' => 'Tambah Kepenghunian', 'url' => '']
                ]
            ]) --}}
        </div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Tambah data penghuni') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk menambah data penghuni. Isi formulir ini dapat diisi oleh Tenant Relation') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('kepenghunian.store') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return confirmSave(this);">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                <div class="sm:col-span-1 grid gap-4 sm:grid-cols-3 sm:gap-6">
                                    <div class="w-full">
                                        <label for="unit_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('No. Unit') }}
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="unit_name" name="unit_name" placeholder="X-1234"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <input type="hidden" id="unit_id" name="unit_id">
                                            <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label for="tanggal_huni"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Huni') }}</label>
                                        <input type="date" name="tanggal_huni" id="tanggal_huni"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            required>
                                    </div>
                                    <div class="w-full mb-4">
                                        <label for="status"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Status') }}</label>
                                        <select name="status" id="status"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            onchange="toggleMasaHuniInput()">
                                            <option value="Pemilik">Pemilik</option>
                                            <option value="Penyewa">Penyewa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="sm:col-span-3 ">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Identitas Penghuni') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <div class="w-full">
                                        <label for="nama"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Nama Penghuni') }}
                                        </label>
                                        <div class="relative">
                                            <input type="text" name="nama" id="nama"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Nama Penghuni" required>
                                            <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1">
                                    <div class="w-full">
                                        <label for="no_hp"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('No. HP') }}
                                        </label>
                                        <div class="relative">
                                            <input type="number" name="no_hp" id="no_hp"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Nomor HP" min="0" required>
                                            <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-1">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="tempat_lahir"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tempat Lahir') }}</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Tempat Lahir" required>
                                        </div>
                                        <div class="w-full">
                                            <label for="tanggal_lahir"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Lahir') }}</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>
                                        <div class="w-full">
                                            <label for="warga_negara"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Warga Negara') }}</label>
                                            <select name="warga_negara" id="warga_negara"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="WNI">WNI</option>
                                                <option value="WNA">WNA</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="w-full">
                                    <label for="no_ktp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('No. KTP') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="no_ktp" id="no_ktp"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="16 Digit Nomor KTP" required maxlength="16" pattern="\d{16}"
                                            oninput="this.value = this.value.replace(/\D/g, '').slice(0, 16);">
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="w-full">
                                    <label for="agama"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Agama') }}</label>
                                    <select name="agama" id="agama"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="w-full">
                                    <label for="alamat"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Alamat') }}</label>
                                    <textarea name="alamat" id="alamat" rows="6"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Alamat Sesuai KTP"></textarea>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="w-full hidden" id="masaHuniContainer">
                                    <label for="masa_huni"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Masa Huni') }}</label>
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input name="awal_sewa" id="awal_sewa" type="date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Awal Sewa">
                                        </div>
                                        <span class="mx-4 text-gray-500">to</span>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </div>
                                            <input name="akhir_sewa" id="akhir_sewa" type="date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Akhir Sewa">
                                        </div>

                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <a href="{{ route('kepenghunian.index') }}"
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
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
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
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal', ['type' => 'confirmation'])
    </div>
    <script>
        function toggleMasaHuniInput() {
            const statusSelect = document.getElementById('status');
            const masaHuniContainer = document.getElementById('masaHuniContainer');
            const selectedValue = statusSelect.value;

            if (selectedValue === 'Penyewa') {
                masaHuniContainer.classList.remove('hidden');
            } else {
                masaHuniContainer.classList.add('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            const unitInput = document.getElementById('unit_name');
            const unitIdInput = document.getElementById('unit_id');
            const units = @json($units->pluck('unit', 'id'));

            // Function to set the unit ID
            function setUnitId(unitName) {
                unitIdInput.value = ''; // Clear previous value

                const matchedUnit = Object.entries(units).find(([id, unit]) => unit.toLowerCase() === unitName.toLowerCase());

                if (matchedUnit) {
                    unitIdInput.value = matchedUnit[0];
                }
            }

            // Event listener for input changes
            unitInput.addEventListener('input', function () {
                setUnitId(unitInput.value.trim());
            });

            // Event listener for blur event to handle input after typing
            unitInput.addEventListener('blur', function () {
                setUnitId(unitInput.value.trim());

                // Provide feedback if no match is found
                if (!unitIdInput.value) {
                    alert('Unit ID tidak ditemukan. Pastikan unit name yang dimasukkan benar.');
                }
            });
        });
    </script>


</x-app-layout>
