@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-4 pr-4 py-3 text-[#C8A27C] font-semibold bg-[#FFF4E6] border-l-4 border-[#C8A27C]'
            : 'block pl-4 pr-4 py-3 text-[#4B3A2E] hover:bg-[#F3E9DD] transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
