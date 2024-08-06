<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-8 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div class="w-full">
                <h1
                    class="mb-3 text-2xl text-center font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                    {{ __('Unit dan IPL') }}
                </h1>
                <div class="mb-3 text-gray-500 text-sm font-regular text-center">
                    {{ __('Di sini Anda dapat melihat detail informasi hunian dan tagihan IPL') }}
                </div>
            </div>
            <div
                class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-1 rounded-lg p-6 shadow-md sm:rounded-2xl bg-[#01645222]">
                @if ($pemilik->unit->isEmpty())
                    <p>Pemilik ini tidak memiliki unit.</p>
                @else
                    <ul>
                        @foreach ($pemilik->unit as $index => $unit)
                            <ul>
                                <li class="mb-6">
                                    <button type="button"
                                        class="flex items-center p-4 text-base font-medium text-gray-900 bg-[#016452] hover:bg-[#014F41] rounded-t-lg dark:text-white dark:hover:bg-gray-700 group w-full"
                                        aria-controls="data-master-{{ $index }}" data-collapse-toggle="data-master-{{ $index }}">
                                        <svg class="w-6 h-6 text-white transition duration-75"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="flex-1 ms-4 text-left rtl:text-right whitespace-nowrap text-white">
                                            {{ $unit->nama_unit }}
                                        </span>
                                        <svg class="w-3 h-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <ul id="data-master-{{ $index }}" class="hidden pb-2 rounded-b-lg space-y-2 bg-[#016452bb]">
                                        <li>
                                            <a href="{{ route('ipl.showIPL', ['unit_id' => $unit->id]) }}"
                                                class="flex items-center w-full p-2 text-white transition duration-75 pl-11 group hover:bg-[#014F41] dark:text-white dark:hover:bg-gray-700">{{ __('Tagihan IPL') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('ipl.history', ['unit_id' => $unit->id]) }}"
                                                class="flex items-center w-full p-2 text-white transition duration-75 pl-11 group hover:bg-[#014F41] dark:text-white dark:hover:bg-gray-700">{{ __('Riwayat Tagihan') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll('button[data-collapse-toggle]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = document.getElementById(this.getAttribute('data-collapse-toggle'));
                    if (target.classList.contains('hidden')) {
                        target.classList.remove('hidden');
                    } else {
                        target.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-app-layout>
