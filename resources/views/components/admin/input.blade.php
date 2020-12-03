<label class="block text-sm">
    <span class="text-gray-700 dark:text-gray-400">{{ $label }}</span>
    <input {{ $disabled }} class="mb-6 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
    dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="{{ $name }}" value="{{ $value }}"/>
</label>
