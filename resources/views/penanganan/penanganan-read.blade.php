<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Penanganan') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nomor Komplain') }}</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            {{ $penanganan->komplain->nomor_laporan }}
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nomor Penanganan Komplain') }}</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            {{ $penanganan->nomor_penanganan }}
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Respon Awal') }}</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            {{ $penanganan->respon_awal }}
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Pemeriksaan Awal') }}</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            {{ $penanganan->pemeriksaan_awal }}
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Penyelesaian Komplain') }}</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            {{ $penanganan->penyelesaian_komplain }}
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Pemeriksaan Awal') }}</label>
                        <div>
                            @if ($penanganan->foto_pemeriksaan_awal)
                                <img class="h-24 w-24 object-cover rounded-lg"
                                    src="{{ asset('storage/foto_pemeriksaan_awal/' . $penanganan->foto_pemeriksaan_awal) }}"
                                    alt="Foto Pemeriksaan Awal">
                            @else
                                <img class="h-24 w-24 object-cover rounded-lg"
                                    src="{{ asset('storage/images/no_photo.jpg') }}" alt="No Photo">
                            @endif
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Hasil Perbaikan') }}</label>
                        <div>
                            @if ($penanganan->foto_hasil_perbaikan)
                                <img class="h-24 w-24 object-cover rounded-lg"
                                    src="{{ asset('storage/foto_hasil_perbaikan/' . $penanganan->foto_hasil_perbaikan) }}"
                                    alt="Foto Hasil Perbaikan">
                            @else
                                <img class="h-24 w-24 object-cover rounded-lg"
                                    src="{{ asset('storage/images/no_photo.jpg') }}" alt="No Photo">
                            @endif
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Penanganan') }}</label>
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            {{ $penanganan->tanggal_penanganan }}
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('penanganan.index') }}" class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Kembali') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
