<a {{ $attributes->merge([
    'class' => 'block px-4 py-2 text-sm text-[#4B3A2E] hover:bg-[#F3E9DD] transition rounded'
]) }}>
    {{ $slot }}
</a>
