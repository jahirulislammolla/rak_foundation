{{-- resources/views/admin/focus-areas/edit.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Edit Focus Area</h1>
            <a href="{{ route('manage-focus-area.index') }}" class="text-sm py-2 px-3 bg-blue-600 rounded-md text-white">Back to list</a>
        </div>

        <div class="rounded-2xl bg-white p-6 border">
            <form method="POST" action="{{ route('manage-focus-area.update', $item) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.focus-areas._form', ['item' => $item, 'isEdit' => true])
            </form>
        </div>
    </div>
</x-admin-layout>
