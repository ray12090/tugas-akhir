<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kepenghunian') }}
        </h2>
    </x-slot>
    <div>
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div class="container mx-auto p-4">
                <h2 class="text-2xl font-bold mb-4">Tambah Komplain</h2>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-2 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('komplain.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nomor_laporan" class="block text-sm font-medium text-gray-700">Nomor
                                Laporan</label>
                            <input type="text" name="nomor_laporan" id="nomor_laporan" class="mt-1 block w-full"
                                value="{{ old('nomor_laporan') }}" required>
                            @error('nomor_laporan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="tanggal_laporan" class="block text-sm font-medium text-gray-700">Tanggal
                                Laporan</label>
                            <input type="date" name="tanggal_laporan" id="tanggal_laporan" class="mt-1 block w-full"
                                value="{{ old('tanggal_laporan') }}" required>
                            @error('tanggal_laporan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="tower" class="block text-sm font-medium text-gray-700">Tower</label>
                            <input type="text" name="tower" id="tower" class="mt-1 block w-full"
                                value="{{ old('tower') }}" required>
                            @error('tower')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                            <input type="text" name="unit" id="unit" class="mt-1 block w-full"
                                value="{{ old('unit') }}" required>
                            @error('unit')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="kategori_laporan" class="block text-sm font-medium text-gray-700">Kategori
                                Laporan</label>
                            <select name="kategori_laporan" id="kategori_laporan" class="mt-1 block w-full" required>
                                <option value="Komplain">Komplain</option>
                                <option value="Saran">Saran</option>
                            </select>
                            @error('kategori_laporan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="nama_pelapor" class="block text-sm font-medium text-gray-700">Nama
                                Pelapor</label>
                            <input type="text" name="nama_pelapor" id="nama_pelapor" class="mt-1 block w-full"
                                value="{{ old('nama_pelapor') }}" required>
                            @error('nama_pelapor')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="nomor_kontak" class="block text-sm font-medium text-gray-700">Nomor
                                Kontak</label>
                            <input type="text" name="nomor_kontak" id="nomor_kontak" class="mt-1 block w-full"
                                value="{{ old('nomor_kontak') }}" required>
                            @error('nomor_kontak')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="uraian_komplain" class="block text-sm font-medium text-gray-700">Uraian
                                Komplain</label>
                            <textarea name="uraian_komplain" id="uraian_komplain" class="mt-1 block w-full" rows="4" required>{{ old('uraian_komplain') }}</textarea>
                            @error('uraian_komplain')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <div class="grid grid-cols-3 gap-2">
                                @foreach (['Engineering', 'Bocor', 'Safety', 'TR', 'Plumbing', 'Rembes', 'Mekanik', 'HK', 'Marmer', 'Sipil lainnya', 'Access Card/Parkir', 'SEC', 'Parquet', 'Listrik', 'Supervisi', 'FA', 'Sloping', 'AC + Exhaust', 'Pest Control', 'MNC'] as $category)
                                    <div>
                                        <input type="checkbox" name="kategori[]" value="{{ $category }}"
                                            id="kategori_{{ $category }}"
                                            @if (is_array(old('kategori')) && in_array($category, old('kategori'))) checked @endif>
                                        <label for="kategori_{{ $category }}"
                                            class="ml-1 text-sm font-medium text-gray-700">{{ $category }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('kategori')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="respon" class="block text-sm font-medium text-gray-700">Respon</label>
                            <textarea name="respon" id="respon" class="mt-1 block w-full" rows="2">{{ old('respon') }}</textarea>
                            @error('respon')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="analisis_awal" class="block text-sm font-medium text-gray-700">Analisis
                                Awal</label>
                            <textarea name="analisis_awal" id="analisis_awal" class="mt-1 block w-full" rows="2">{{ old('analisis_awal') }}</textarea>
                            @error('analisis_awal')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="keterangan_selesai" class="block text-sm font-medium text-gray-700">Keterangan
                                Selesai</label>
                            <textarea name="keterangan_selesai" id="keterangan_selesai" class="mt-1 block w-full" rows="2">{{ old('keterangan_selesai') }}</textarea>
                            @error('keterangan_selesai')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="foto_analisis_awal" class="block text-sm font-medium text-gray-700">Foto
                                Analisis
                                Awal</label>
                            <input type="file" name="foto_analisis_awal" id="foto_analisis_awal"
                                class="mt-1 block w-full">
                            @error('foto_analisis_awal')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="foto_hasil_perbaikan" class="block text-sm font-medium text-gray-700">Foto
                                Hasil
                                Perbaikan</label>
                            <input type="file" name="foto_hasil_perbaikan" id="foto_hasil_perbaikan"
                                class="mt-1 block w-full">
                            @error('foto_hasil_perbaikan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                        <a href="{{ route('komplain.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
