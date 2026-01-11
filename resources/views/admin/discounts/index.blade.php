@extends('admin.layouts.app')

@section('title','Discount Preview')

@section('content')
<h1 class="text-2xl font-bold mb-8">Discount Preview</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">

  <table class="w-full text-sm">
    <thead class="bg-gray-100 text-gray-700">
      <tr>
        <th class="px-6 py-4 text-left">Title</th>
        <th class="px-6 py-4 text-center">Percent</th>
        <th class="px-6 py-4 text-center">Date</th>
        <th class="px-6 py-4 text-center">Status</th>
        <th class="px-6 py-4 text-center">Action</th>
      </tr>
    </thead>

    <tbody class="divide-y">
      @foreach($discounts as $discount)
        <tr class="hover:bg-gray-50">

          {{-- TITLE --}}
          <td class="px-6 py-4">
            <p class="font-semibold text-gray-800">
              {{ $discount->title }}
            </p>
            <p class="text-xs text-gray-500 line-clamp-2">
              {{ $discount->description }}
            </p>
          </td>

          {{-- PERCENT --}}
          <td class="px-6 py-4 text-center">
            <span class="bg-red-600 text-white text-xs px-3 py-1 rounded-full">
              {{ $discount->percent }}%
            </span>
          </td>

          {{-- DATE --}}
          <td class="px-6 py-4 text-center text-xs text-gray-600">
            {{ $discount->start_date }} <br>
            <span class="text-gray-400">—</span> <br>
            {{ $discount->end_date }}
          </td>

          {{-- STATUS --}}
          <td class="px-6 py-4 text-center">
            <form method="POST"
                  action="{{ route('admin.discounts.toggle', $discount->id) }}">
              @csrf
              @method('PATCH')

              <button
                type="submit"
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full
                       text-xs font-semibold transition
                       {{ $discount->status === 'published'
                          ? 'bg-green-600 text-white hover:bg-green-700'
                          : 'bg-gray-300 text-gray-700 hover:bg-gray-400' }}">

                {{-- DOT --}}
                <span class="w-2 h-2 rounded-full
                  {{ $discount->status === 'published'
                      ? 'bg-white'
                      : 'bg-gray-500' }}">
                </span>

                {{ ucfirst($discount->status) }}
              </button>
            </form>
          </td>

          {{-- ACTION --}}
          <td class="px-6 py-4 text-center">
            @if($discount->status === 'published')
              <a href="{{ route('admin.discounts.preview', $discount->id) }}"
                 target="_blank"
                 class="inline-flex items-center gap-1
                        text-blue-600 text-xs hover:underline">
                Preview →
              </a>
            @else
              <span class="text-xs text-gray-400 italic">
                Draft
              </span>
            @endif
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>

</div>
@endsection
