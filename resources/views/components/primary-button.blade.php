<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#016452] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#014F41] focus:bg-[#016452] active:bg-[#014F41] focus:outline-none focus:ring-2 focus:ring-[#014f415e] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
