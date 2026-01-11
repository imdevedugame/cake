<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'px-6 py-2 rounded-full bg-red-400 text-white hover:bg-red-500 transition'
]) }}>
    {{ $slot }}
</button>
