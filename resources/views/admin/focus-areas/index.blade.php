{{-- resources/views/admin/focus-areas/index.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">

        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold">Focus Areas</h1>
            <a href="{{ route('manage-focus-area.create') }}"
               class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                + Add Focus Area
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl border bg-white">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Order</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Title</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Slug</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Active</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @foreach($items as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->order }}</td>
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $item->title }}</div>
                            <div class="text-xs text-gray-500 line-clamp-1">{{ $item->short_description }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->slug }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2 py-0.5 text-xs
                                {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $item->is_active ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('manage-focus-area.edit', $item) }}"
                               class="mr-2 rounded bg-amber-500 px-3 py-1.5 text-white hover:bg-amber-600">Edit</a>

                            <form class="inline"
                                  action="{{ route('manage-focus-area.destroy', $item) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this item?')">
                                @csrf @method('DELETE')
                                <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-3">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
