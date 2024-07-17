<x-app-layout>
    <div>
        @include('components.alert')
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-2xl">
            <div>
                <div class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    {{ __('Tambah Unit') }}
                </div>
                <div class="text-gray-500 text-sm font-reguler">
                    {{ __('Di bawah merupakan formulir untuk menambah data unit. Isi formulir ini dapat diisi oleh Tenant Relation') }}
                </div>
            </div>
            <div class="relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between py-4 dark:border-gray-700">
                    <div class="w-full">
                        <form action="{{ route('unit.store') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return confirmSave(this);">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-4 sm:gap-6">
                                <div class="sm:col-span-1">
                                    <label for="tower_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tower') }}</label>
                                    <select name="tower_id" id="tower_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="">{{ __('Pilih Tower') }}</option>
                                        @foreach ($towers as $tower)
                                            <option value="{{ $tower->id }}"
                                                data-nama-tower="{{ $tower->nama_tower }}">{{ $tower->nama_tower }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="lantai_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Lantai') }}</label>
                                    <select name="lantai_id" id="lantai_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="">{{ __('Pilih Lantai') }}</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="unit-range"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Rentang Unit') }}</label>
                                    <div class="flex space-x-2">
                                        <input type="number" id="unit-start"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Mulai">
                                        <span class="self-center">{{ __('-') }}</span>
                                        <input type="number" id="unit-end"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Akhir">
                                    </div>
                                    <button type="button" id="generate-unit-range"
                                        class="inline-flex items-center py-2.5 px-5 mt-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">{{ __('Generate Unit') }}</button>
                                </div>
                                <div class="sm:col-span-1">
                                    <label for="units"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Unit') }}</label>
                                    <div id="unit-container">
                                        <input type="text" name="units[]" value=""
                                            class="unit-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Masukkan nama unit">
                                    </div>
                                    <button type="button" id="add-unit"
                                        class="inline-flex items-center py-2.5 px-5 mt-2 mb-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">+
                                        {{ __('Tambah Unit') }}</button>
                                </div>
                                <div class="sm:col-span-4 items-end">
                                    <a href="{{ route('unit.index') }}"
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
        document.getElementById('tower_id').addEventListener('change', function() {
            var towerId = this.value;
            var lantaiSelect = document.getElementById('lantai_id');
            lantaiSelect.innerHTML = '<option value="">{{ __('Pilih Lantai') }}</option>';

            if (towerId) {
                fetch(`/get-lantais/${towerId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(lantai => {
                            var option = document.createElement('option');
                            option.value = lantai.id;
                            option.textContent = lantai.nama_lantai;
                            option.setAttribute('data-nama-lantai', lantai
                            .nama_lantai); // Add data attribute for lantai name
                            lantaiSelect.appendChild(option);
                        });
                    });
            }
            updateUnitValues(); // Update unit values when tower is changed
        });

        document.getElementById('lantai_id').addEventListener('change', function() {
            updateUnitValues(); // Update unit values when lantai is changed
        });

        document.getElementById('add-unit').addEventListener('click', function() {
            var container = document.getElementById('unit-container');
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'units[]';
            input.placeholder = 'Masukkan nama unit';
            input.className =
                'unit-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500';
            container.appendChild(input);
            updateUnitValues(); // Update unit values for new input
        });

        document.getElementById('generate-unit-range').addEventListener('click', function() {
            var start = parseInt(document.getElementById('unit-start').value);
            var end = parseInt(document.getElementById('unit-end').value);
            var container = document.getElementById('unit-container');

            if (!isNaN(start) && !isNaN(end) && start <= end) {
                container.innerHTML = ''; // Clear existing inputs
                for (var i = start; i <= end; i++) {
                    var input = document.createElement('input');
                    input.type = 'text';
                    input.name = 'units[]';
                    input.value = i < 10 ? '0' + i : i; // Ensure two-digit format for units
                    input.className =
                        'unit-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500';
                    container.appendChild(input);
                }
                updateUnitValues(); // Update unit values for new range inputs
            } else {
                alert('Rentang unit tidak valid.');
            }
        });

        function updateUnitValues() {
            var towerSelect = document.getElementById('tower_id');
            var lantaiSelect = document.getElementById('lantai_id');
            var towerName = towerSelect.options[towerSelect.selectedIndex].text;
            var lantaiName = lantaiSelect.options[lantaiSelect.selectedIndex].text;
            var unitInputs = document.getElementsByClassName('unit-input');

            if (towerName && lantaiName) {
                lantaiName = lantaiName.padStart(2, '0'); // Ensure two-digit format for lantai
                Array.from(unitInputs).forEach(function(input) {
                    var unitValue = input.value.replace(/^.*-.*/, ''); // Remove existing prefix
                    input.value = `${towerName}-${lantaiName}${unitValue}`;
                });
            }
        }
    </script>
</x-app-layout>
