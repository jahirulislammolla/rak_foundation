{{-- resources/views/admin/events/partials/_form.blade.php --}}
@php
    $ev = $event ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="md:col-span-2 space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700">Title *</label>
            <input type="text" name="title" required
                   value="{{ old('title', $ev->title ?? '') }}"
                   class="mt-1 block p-2 border w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
        </div>

        <div class="grid grid-cols-1 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location"
                       value="{{ old('location', $ev->location ?? '') }}"
                       class="mt-1 block p-2 border w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Priority</label>
                    <input type="number" name="priority"
                           value="{{ old('priority', $ev->priority ?? 1) }}"
                           class="mt-1 block p-2 border w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
                </div>
                <div class="flex items-center gap-6 mt-7">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', ($ev->is_active ?? true)) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Active</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', ($ev->is_featured ?? false)) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Featured</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700">Start At *</label>
                <input type="datetime-local" name="start_at" required
                       value="{{ old('start_at', isset($ev->start_at) ? $ev->start_at->format('Y-m-d\TH:i') : '') }}"
                       class="mt-1 block p-2 border w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">End At</label>
                <input type="datetime-local" name="end_at"
                       value="{{ old('end_at', isset($ev->end_at) ? $ev->end_at->format('Y-m-d\TH:i') : '') }}"
                       class="mt-1 block p-2 border w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Short Description</label>
            <textarea name="short_description" rows="2"
                      class="mt-1 block p-2 border w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('short_description', $ev->short_description ?? '') }}</textarea>
        </div>

    </div>

    <div class="space-y-4">
        <label class="block text-sm font-medium text-gray-700">Banner (600×400px)</label>
        <input type="file" name="banner" accept="image/*"
               class="block w-full text-sm text-gray-900 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 file:text-gray-700 hover:file:bg-gray-200"/>

        @if($ev && $ev->banner_path)
            <div class="rounded-lg border border-gray-200 p-3">
                <div class="text-xs text-gray-500 mb-2">Current Banner</div>
                <img src="{{ asset($ev->banner_path) }}" class="h-36 w-full rounded object-cover" alt="">
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-3 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
