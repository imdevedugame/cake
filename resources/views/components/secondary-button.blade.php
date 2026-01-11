<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'px-6 py-2 rounded-full border border-[#C8A27C] text-[#C8A27C] hover:bg-[#F3E9DD] transition'
]) }}>
    {{ $slot }}
</button>
