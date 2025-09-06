<x-admin-layout>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <h1 class="text-2xl font-bold">Works / News</h1>
      <a href="{{ route('manage-works.create') }}" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">+ Add</a>
    </div>

    @if(session('success'))
      <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-xl border bg-white">
      <table class="min-w-full divide-y">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">Priority</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Title</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Category</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Published</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y">
        @foreach($works as $w)
          <tr>
            <td class="px-4 py-3">{{ $w->priority }}</td>
            <td class="px-4 py-3">
              <div class="font-medium">{{ $w->title }}</div>
              <div class="text-xs text-gray-500 line-clamp-1">{{ $w->excerpt }}</div>
            </td>
            <td class="px-4 py-3">{{ optional($w->category)->name ?: '—' }}</td>
            <td class="px-4 py-3">
              @if($w->published_at)
                <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs text-green-700">
                  {{ $w->published_at->format('d M Y') }}
                </span>
              @else
                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-600">Draft</span>
              @endif
            </td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('manage-works.edit', $w) }}"
                 class="mr-2 rounded bg-amber-500 px-3 py-1.5 text-white hover:bg-amber-600">Edit</a>

              <form class="inline" action="{{ route('manage-works.destroy', $w) }}" method="POST"
                    onsubmit="return confirm('Delete this item?')">
                @csrf @method('DELETE')
                <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="p-3">{{ $works->links() }}</div>
    </div>
  </div>
</x-admin-layout>
