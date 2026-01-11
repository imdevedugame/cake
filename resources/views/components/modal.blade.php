@props(['id', 'maxWidth' => '2xl'])

<x-modal :id="$id" :maxWidth="$maxWidth">
    <div class="p-6 bg-white rounded-xl border border-[#E8DCC9] shadow">
        {{ $slot }}
    </div>
</x-modal>
