<button {{ $attributes->merge(['class' =>
    'px-5 py-2 bg-[#C8A27C] hover:bg-[#B8926E] text-white rounded-full transition shadow'
]) }}>
    {{ $slot }}
</button>
