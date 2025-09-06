{{-- resources/views/admin/events/edit.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-900">Edit Event</h1>
            <a href="{{ route('manage-events.index') }}"
               class="text-sm text-gray-600 hover:text-gray-800">← Back to list</a>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('manage-events.update', $event->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')
                @include('admin.events._form', ['event' => $event])
                <div class="flex items-center gap-3">
                    <button class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        Update
                    </button>
                    <a href="{{ route('manage-events.index') }}"
                       class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
