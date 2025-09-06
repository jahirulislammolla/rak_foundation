
<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        {{-- Header --}}
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h1 class="text-xl font-semibold text-gray-900">Events</h1>
            <div class="flex items-center gap-3">
                <form method="GET" class="flex items-center gap-2">
                    <select name="status" class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3"
                            onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="active" {{ request('status')==='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ request('status')==='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </form>
                <a href="{{ route('manage-events.create') }}"
                   class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                    + Create Event
                </a>
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table Card --}}
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Start</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Featured</th>
                            <th class="px-4 py-3">Priority</th>
                            <th class="px-4 py-3">Banner</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($events as $event)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-500">{{ $event->id }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $event->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $event->slug }}</div>
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $event->start_at?->format('d M Y, h:i A') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                        {{ $event->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $event->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                        {{ $event->is_featured ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $event->is_featured ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $event->priority }}</td>
                                <td class="px-4 py-3">
                                    @if($event->banner_path)
                                        <img src="{{ asset($event->banner_path) }}" class="h-10 w-18 rounded object-cover" alt="">
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('manage-events.edit', $event->id) }}"
                                           class="inline-flex items-center rounded-md border border-gray-300 px-2.5 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">
                                            Edit
                                        </a>

                                        <form action="{{ route('manage-events.toggle', $event->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button
                                              class="inline-flex items-center rounded-md border border-amber-300 px-2.5 py-1.5 text-xs font-medium text-amber-700 hover:bg-amber-50">
                                                {{ $event->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('manage-events.destroy', $event->id) }}" method="POST"
                                              onsubmit="return confirm('Delete this event?')">
                                            @csrf @method('DELETE')
                                            <button
                                              class="inline-flex items-center rounded-md border border-red-300 px-2.5 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-8 text-center text-gray-500">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-4 py-3">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
