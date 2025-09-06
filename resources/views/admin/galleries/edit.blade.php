{{-- resources/views/admin/galleries/edit.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-900">Edit Gallery Image</h1>
            <a href="{{ route('manage-galleries.index') }}" class="text-sm bg-gray-600 hover:bg-gray-800 text-white  px-3 py-2 rounded-md">← Back</a>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('manage-galleries.update', $gallery->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Title *</label>
                    <input type="text" name="title" required value="{{ old('title', $gallery->title) }}"
                           class="mt-1 block border px-3 py-2 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Replace Image</label>
                        <input type="file" name="image" accept="image/*"
                               class="mt-1 block border px-3 py-2 w-full text-sm text-gray-900 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 hover:file:bg-gray-200">
                        <p class="mt-1 text-xs text-gray-500">Leave empty to keep existing image.</p>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 mb-2">Current Image</div>
                        <img src="{{ asset($gallery->image_path) }}" class="h-32 w-full rounded object-cover" alt="">
                    </div>
                </div>

                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $gallery->is_active ? 'checked':'' }}
                           class="rounded h-5 w-5 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-lg text-gray-700">Active</span>
                </label>

                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-3 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <div class="flex items-center gap-3">
                    <button class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Update</button>
                    <a href="{{ route('manage-galleries.index') }}"
                       class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
