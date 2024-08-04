<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Edit Biaya Admin') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('detail_biaya_admin.update', $detailBiayaAdmin->id) }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return confirmSave(this);">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-4 sm:grid-cols-4 gap-6">
                                <div class="sm:col-span-1">
                                    <label for="biaya_admin"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Biaya Admin') }}
                                    </label>
                                    <div class="relative">
                                        <input type="number" step="0.01" name="biaya_admin" id="biaya_admin"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ $detailBiayaAdmin->biaya_admin }}" required>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_awal_berlaku"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Tanggal Awal Berlaku') }}
                                    </label>
                                    <div class="relative">
                                        <input id="tanggal_awal_berlaku" name="tanggal_awal_berlaku" type="text"
                                            datepicker datepicker-format="yyyy-mm-dd" datepicker-buttons
                                            datepicker-autoselect-today
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ \Carbon\Carbon::parse($detailBiayaAdmin->tanggal_awal_berlaku)->format('Y-m-d') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="tanggal_akhir_berlaku"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Tanggal Akhir Berlaku (Opsional)') }}
                                    </label>
                                    <div class="relative">
                                        <input id="tanggal_akhir_berlaku" name="tanggal_akhir_berlaku" type="text"
                                            datepicker datepicker-format="yyyy-mm-dd" datepicker-buttons
                                            datepicker-autoselect-today
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ $detailBiayaAdmin->tanggal_akhir_berlaku ? \Carbon\Carbon::parse($detailBiayaAdmin->tanggal_akhir_berlaku)->format('Y-m-d') : '' }}"
                                            placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="sm:col-span-4 items-end">
                                <a href="{{ route('detail_biaya_admin.index') }}"
                                    class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Kembali') }}
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-center text-white bg-[#016452] rounded-lg focus:ring-4 focus:ring-[#014f415e] dark:focus:ring-primary-900 hover:bg-[#014F41]">
                                    <svg class="w-[16px] h-[16px] text-white dark:text-white mr-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
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
    </div>
    @include('components.modal', ['type' => 'confirmation'])
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById("tanggal_awal_berlaku").addEventListener('change', function () {
            var tanggalAwal = new Date(this.value);
            var tanggalAkhirInput = document.getElementById("tanggal_akhir_berlaku");
            var tanggalAkhir = new Date(tanggalAkhirInput.value);

            if (tanggalAkhir < tanggalAwal) {
                tanggalAkhirInput.value = this.value;
            }
        });

        document.getElementById("tanggal_akhir_berlaku").addEventListener('change', function () {
            var tanggalAkhir = new Date(this.value);
            var tanggalAwalInput = document.getElementById("tanggal_awal_berlaku");
            var tanggalAwal = new Date(tanggalAwalInput.value);

            if (tanggalAkhir < tanggalAwal) {
                this.value = tanggalAwalInput.value;
            }
        });
    });
</script>