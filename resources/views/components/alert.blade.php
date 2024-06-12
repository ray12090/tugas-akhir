@if (session()->has('danger'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">{{ __('Danger alert!') }}</span> {{ session('danger') }}
    </div>
@endif

@if (session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <span class="font-medium">{{ __('Success!') }}</span> {{ session('success') }}
    </div>
@endif

@if (session()->has('warning'))
    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-200 dark:bg-gray-800 dark:text-yellow-400"
        role="alert">
        <span class="font-medium">{{ __('Warning!') }}</span> {{ session('warning') }}
    </div>
@endif

@if (session()->has('info'))
    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-200 dark:bg-gray-800 dark:text-blue-400" role="alert">
        <span class="font-medium">{{ __('Info!') }}</span> {{ session('info') }}
    </div>
@endif

@if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">{{ __('There were some errors with your submission.') }}</span>
        <ul class="mt-1.5 ml-4 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
