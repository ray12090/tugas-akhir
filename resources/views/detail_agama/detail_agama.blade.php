<x-app-layout>
    <div>
        @include('components.alert')
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="px-6 pt-6">
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Data Agama') }}
                </div>
                <div class="text-gray-500 text-sm font-regular">
                    {{ __('Di bawah merupakan tabel data agama. Isi tabel ini dapat ditambah, lihat, ubah, dan hapus oleh Admin.') }}
                </div>
            </div>
            <div
                class="flex flex-col md:flex-row items-stretch md:items-center px-2 space-y-3 md:space-y-0 justify-between mx-4 py-4 dark:border-gray-700">
                <div class="w-full md:w-1/2">
                    <form method="GET" action="{{ route('detail_agama.index') }}" class="flex items-center">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="simple-search" placeholder="{{ __('Cari') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <a href="{{ route('detail_agama.create') }} " type="button" id="createProductButton"
                        data-modal-toggle="createProductModal"
                        class="flex items-center justify-center text-white bg-[#016452] hover:bg-[#014F41] focus:ring-4 focus:ring-[#014f415e] font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-[#016452] focus:outline-none dark:focus:ring-[#014F41]">
                        <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        {{ __('Tambah Data Agama') }}
                    </a>
                </div>
            </div>
            <div class="overflow-x-scroll">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="p-4">
                                <a
                                    href="{{ route('detail_agama.index', ['sort_by' => 'nama_agama', 'sort_order' => $sort_by === 'nama_agama' && $sort_order === 'asc' ? 'desc' : 'asc']) }}">
                                    {{ __('Nama Agama') }}
                                    @if ($sort_by === 'nama_agama')
                                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $sort_order === 'asc' ? 'm8 10 4 4 4-4' : 'm16 14-4-4-4 4' }}">
                                            </path>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 text-center">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agamas as $agama)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $agama->nama_agama }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center space-x-4 justify-center">
                                        <a href="{{ route('detail_agama.show', $agama->id) }}"
                                            class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-4 h-4 mr-2 -ml-0.5">
                                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                            </svg>
                                            {{ __('Lihat') }}
                                        </a>
                                        <a href="{{ route('detail_agama.edit', $agama->id) }}"
                                            class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-[#016452] rounded-lg hover:bg-[#014F41] focus:ring-4 focus:outline-none focus:ring-[#014f415e] dark:bg-primary-600 dark:hover:bg-[#016452] dark:focus:ring-[#014F41]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ __('Ubah') }}
                                        </a>

                                        <form action="{{ route('detail_agama.destroy', $agama->id) }}" method="POST"
                                            onsubmit="return confirmDelete(this, '{{ $agama->nama_agama }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ __('Hapus') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @include('components.modal', ['type' => 'delete'])
            </div>

            {{-- Pagination --}}
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $agamas->firstItem() }}</span>
                    to
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $agamas->lastItem() }}</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $agamas->total() }}</span>
                </span>

                <ul class="inline-flex items-stretch -space-x-px">
                    <!-- Previous Page Link -->
                    @if ($agamas->onFirstPage())
                        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $agamas->previousPageUrl() }}" rel="prev"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    @endif

                    <!-- Pagination Elements -->
                    @foreach ($agamas->links()->elements[0] as $page => $url)
                        @if ($page == $agamas->currentPage())
                            <li>
                                <a href="#" aria-current="page"
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-[#014f415e] hover:bg-primary-100 hover:text-[#016452] dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    <!-- Next Page Link -->
                    @if ($agamas->hasMorePages())
                        <li>
                            <a href="{{ $agamas->nextPageUrl() }}" rel="next"
                                class="flex items-center justify-center h-full py-1.5 px-3 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    @else
                        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span
                                class="flex items-center justify-center h-full py-1.5 px-3 text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        <script>
            function toggleModal(modalId) {
                const modal = document.getElementById(modalId);
                modal.classList.toggle('hidden');
            }

            function confirmDelete(form, namaPenghuni) {
                const deleteModal = document.getElementById('deleteModal');
                const deleteModalText = document.getElementById('deleteModalText');
                const confirmDeleteButton = document.getElementById('confirmDeleteButton');

                // Set nomor_laporan in modal text
                deleteModalText.textContent = `{{ __('Hapus Data ') }}${namaPenghuni}`;
                toggleModal('deleteModal'); // Show the modal

                confirmDeleteButton.onclick = function () {
                    form.submit();
                };
                return false; // Prevent the default form submission
            }
        </script>
</x-app-layout>