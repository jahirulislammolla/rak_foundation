{{-- resources/views/admin/galleries/index.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h1 class="text-xl font-semibold text-gray-900">Gallery</h1>
            <div class="flex items-center gap-3">
                <form method="GET" class="flex items-center gap-2">
                    <select name="status" class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="active" {{ request('status')==='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ request('status')==='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </form>
                <a href="{{ route('manage-galleries.create') }}"
                   class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-700">+ Add Image</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
        @endif

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Preview</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Created</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($galleries as $g)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-500">{{ $g->id }}</td>
                                <td class="px-4 py-3">
                                    <img src="{{ asset($g->image_path) }}" class="h-14 w-24 rounded object-cover" alt="">
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $g->title }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                        {{ $g->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $g->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $g->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('manage-galleries.edit', $g) }}"
                                           class="inline-flex items-center rounded-md border border-gray-300 px-2.5 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">Edit</a>
                                        <form action="{{ route('manage-galleries.toggle', $g->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="inline-flex items-center rounded-md border border-amber-300 px-2.5 py-1.5 text-xs font-medium text-amber-700 hover:bg-amber-50">
                                                {{ $g->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('manage-galleries.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                                            @csrf @method('DELETE')
                                            <button class="inline-flex items-center rounded-md border border-red-300 px-2.5 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">No items found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3">{{ $galleries->links() }}</div>
        </div>
    </div>
</x-admin-layout>
