<div>

    @if($label)
        <label class="block mb-1 text-sm font-medium text-slate-700">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
    >

    {{-- Validation Error --}}
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    {{-- Custom Error (optional manual pass) --}}
    @if($error)
        <p class="text-red-500 text-xs mt-1">{{ $error }}</p>
    @endif

</div>