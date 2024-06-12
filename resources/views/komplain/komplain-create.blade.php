<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kepenghunian') }}
        </h2>
    </x-slot>
    <div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Tambah komplain') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk menambah data komplain. Isi formulir ini dapat diisi oleh Tenant Relation') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('komplain.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                        <div class="w-full">
                                            <label for="nomor_laporan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nomor Laporan') }}</label>
                                            <input type="text" name="nomor_laporan" id="nomor_laporan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="123456" required>
                                        </div>
                                        <div class="w-full">
                                            <label for="tanggal_laporan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Laporan') }}</label>
                                            <input type="date" name="tanggal_laporan" id="tanggal_laporan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                required>
                                        </div>
                                        <div class="w-full">
                                            <label for="unit_name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Unit') }}</label>
                                            <div class="relative">
                                                <input type="text" id="unit_name" name="unit_name"
                                                    placeholder="X-1234"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <input type="hidden" id="unit_id" name="unit_id">
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="kategori_laporan"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori Laporan') }}</label>
                                            <select name="kategori_laporan" id="kategori_laporan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="Keluhan">Keluhan</option>
                                                <option value="Permintaan">Permintaan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:col-span-2"></div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Identitas Pelapor') }}
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="nama_pelapor"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nama Pelapor') }}</label>
                                    <input type="text" name="nama_pelapor" id="nama_pelapor"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan nama pelapor" required>
                                </div>
                                <div class="w-full">
                                    <label for="nomor_kontak"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nomor Kontak') }}</label>
                                    <input type="text" name="nomor_kontak" id="nomor_kontak"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Masukkan nomor telepon pelapor" required>
                                </div>
                                <div class="w-full"></div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Penerimaan Komplain') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="uraian_komplain"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Uraian Komplain dan Kategori') }}</label>
                                    <textarea name="uraian_komplain" id="uraian_komplain" rows="4"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Tulis uraian komplain di sini" required></textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    {{-- <label for="kategori"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori') }}</label> --}}
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach (['Engineering', 'Bocor', 'Safety', 'TR', 'Plumbing', 'Rembes', 'Mekanik', 'HK', 'Marmer', 'Sipil lainnya', 'Access Card/Parkir', 'SEC', 'Parquet', 'Listrik', 'Supervisi', 'FA', 'Sloping', 'AC + Exhaust', 'Pest Control', 'MNC'] as $kategori)
                                            <div class="flex items-center">
                                                <input type="checkbox" name="kategori[]"
                                                    id="kategori_{{ $kategori }}" value="{{ $kategori }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="kategori_{{ $kategori }}"
                                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $kategori }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Keterangan') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-4">
                                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                                        <div class="w-full">
                                            <label for="respon"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Respon') }}</label>
                                            <textarea name="respon" id="respon" rows="4"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Tulis respon di sini"></textarea>
                                        </div>
                                        <div class="w-full">
                                            <label for="analisis_awal"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Analisis Awal') }}</label>
                                            <textarea name="analisis_awal" id="analisis_awal" rows="4"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Tulis analisis pertama di sini"></textarea>
                                        </div>
                                        <div class="w-full">
                                            <label for="keterangan_selesai"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Keterangan Selesai') }}</label>
                                            <textarea name="keterangan_selesai" id="keterangan_selesai" rows="4"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Tulis keterangan selesai di sini"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                {{ __('Submit Komplain') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const unitInput = document.getElementById('unit_name');
            const unitIdInput = document.getElementById('unit_id');
            const units = {!! $units->pluck('unit', 'id') !!};

            unitInput.addEventListener('input', function() {
                const inputValue = unitInput.value.trim().toLowerCase();

                // Clear previous value
                unitIdInput.value = '';

                if (!inputValue) return;

                const matchedUnit = Object.entries(units).find(([id, unit]) => unit.toLowerCase() ===
                    inputValue);

                if (matchedUnit) {
                    const [id, unit] = matchedUnit;
                    unitIdInput.value = id;
                }
            });
        });
    </script>
</x-app-layout>
