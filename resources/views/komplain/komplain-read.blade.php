<x-app-layout>
    {{-- <div>
        <div class="pb-6">
            @include('components.alert')
            @include('components.breadcrumbs', [
                'breadcrumbs' => [
                    ['title' => 'Dashboard', 'url' => Auth::user()->usertype === 'admin' ? route('admin-dashboard') : route('dashboard')],
                    ['title' => 'Data Komplain', 'url' => route('komplain.index')],
                    ['title' => 'Detail Komplain', 'url' => '']
                ]
            ])
        </div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Detail Komplain') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan detail komplain yang dipilih.') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form>
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                        <div class="w-full">
                                            <label for="nomor_laporan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Nomor Laporan') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" name="nomor_laporan" id="nomor_laporan"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Nomor Laporan" value="{{ $komplain->nomor_laporan }}" readonly>
                                                <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="tanggal_laporan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tanggal Laporan') }}</label>
                                            <input type="date" name="tanggal_laporan" id="tanggal_laporan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ $komplain->tanggal_laporan }}" readonly>
                                        </div>
                                        <div class="w-full">
                                            <label for="unit_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ __('Unit') }}
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="unit_name" name="unit_name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    value="{{ $komplain->unit->unit ?? '' }}" readonly>
                                                <input type="hidden" id="unit_id" name="unit_id" value="{{ $komplain->unit_id }}">
                                                <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <label for="kategori_laporan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori Laporan') }}</label>
                                            <input type="text" name="kategori_laporan" id="kategori_laporan"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                value="{{ $komplain->kategori_laporan }}" readonly>
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
                                    <label for="nama_pelapor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Nama Pelapor') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="nama_pelapor" id="nama_pelapor"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ $komplain->nama_pelapor }}" readonly>
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="nomor_kontak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ __('Nomor Kontak') }}
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="nomor_kontak" id="nomor_kontak"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ $komplain->nomor_kontak }}" readonly>
                                        <svg class="w-[16px] h-[16px] text-gray-500 dark:text-white absolute top-1/2 left-3 transform -translate-y-1/2 pointer-events-none"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full"></div>
                                <div class="sm:col-span-4">
                                    <div class=" text-gray-900 text-lg font-semibold">
                                        {{ __('Penerimaan Komplain') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="uraian_komplain" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Uraian Komplain dan Kategori') }}</label>
                                    <textarea name="uraian_komplain" id="uraian_komplain" rows="4"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        readonly>{{ $komplain->uraian_komplain }}</textarea>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Kategori') }}</label>
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach (['Engineering', 'Bocor', 'Safety', 'TR', 'Plumbing', 'Rembes', 'Mekanik', 'HK', 'Marmer', 'Sipil lainnya', 'Access Card/Parkir', 'SEC', 'Parquet', 'Listrik', 'Supervisi', 'FA', 'Sloping', 'AC + Exhaust', 'Pest Control', 'MNC'] as $kategori)
                                            <div class="flex items-center">
                                                <input type="checkbox" name="kategori[]"
                                                    id="kategori_{{ $kategori }}" value="{{ $kategori }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                    @if(in_array($kategori, $komplain->kategori)) checked @endif
                                                    disabled>
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
                                            <label for="respon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Respon') }}</label>
                                            <textarea name="respon" id="respon" rows="4"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                readonly>{{ $komplain->respon }}</textarea>
                                        </div>
                                        <div class="w-full">
                                            <label for="analisis_awal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Analisis Awal') }}</label>
                                            <textarea name="analisis_awal" id="analisis_awal" rows="4"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                readonly>{{ $komplain->analisis_awal }}</textarea>
                                        </div>
                                        <div class="w-full">
                                            <label for="keterangan_selesai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Keterangan Selesai') }}</label>
                                            <textarea name="keterangan_selesai" id="keterangan_selesai" rows="4"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                readonly>{{ $komplain->keterangan_selesai }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="foto_analisis_awal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Analisis Awal')}}</label>
                                    @if ($komplain->foto_analisis_awal)
                                        <div>
                                            <img src="{{ asset('storage/analisis_awal/'.$komplain->foto_analisis_awal) }}" alt="Foto Analisis Awal" class="w-full h-auto rounded-lg">
                                        </div>
                                    @else
                                        <p class="text-gray-500">{{ __('Tidak ada foto analisis awal.')}}</p>
                                    @endif
                                </div>
                                <div class="w-full">
                                    <label for="foto_hasil_perbaikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Foto Hasil Perbaikan')}}</label>
                                    @if ($komplain->foto_hasil_perbaikan)
                                        <div>
                                            <img src="{{ asset('storage/hasil_perbaikan/'.$komplain->foto_hasil_perbaikan) }}" alt="Foto Hasil Perbaikan" class="w-full h-auto rounded-lg">
                                        </div>
                                    @else
                                        <p class="text-gray-500">{{ __('Tidak ada foto hasil perbaikan.')}}</p>
                                    @endif
                                </div>
                                <div class="sm:col-span-4">
                                    <a href="{{ route('komplain.index') }}"
                                        class="inline-flex items-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-GRAY-900 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd" />
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
    </div> --}}
    {{ $komplain->nomor_laporan }}
</x-app-layout>
