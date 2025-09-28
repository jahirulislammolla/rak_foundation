{{-- resources/views/admin/focus-areas/_form.blade.php --}}
@php
    $isEdit = $isEdit ?? false;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium">Title</label>
        <input name="title"
               x-on:input="if(!$refs.slug.value){ $refs.slug.value = $event.target.value.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-') }"
               value="{{ old('title', $item->title) }}"
               class="mt-1 w-full rounded border px-3 py-2" required>
        @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div x-data class="relative">
        <label class="text-sm font-medium">Slug (optional)</label>
        <input x-ref="slug" name="slug"
               value="{{ old('slug', $item->slug) }}"
               class="mt-1 w-full rounded border px-3 py-2">
        @error('slug')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Order</label>
        <input type="number" name="order" value="{{ old('order', $item->order ?? 0) }}"
               class="mt-1 w-full rounded border px-3 py-2">
        @error('order')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-1">
        <label class="text-sm font-medium">Short description</label>
        <input name="short_description" value="{{ old('short_description', $item->short_description) }}"
               class="mt-1 w-full rounded border px-3 py-2" maxlength="255">
        @error('short_description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-medium">Full description</label>
        <textarea name="description" id="description" rows="6"
                  class="mt-1 w-full rounded border px-3 py-2">{{ old('description', $item->description) }}</textarea>
        @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-1">
        <label class="text-sm font-medium">Image</label>
        <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
        @error('image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    @if($isEdit && $item->image)
        <div>
            <label class="text-sm font-medium block">Current image</label>
            <img src="{{ asset( $item->image) }}" alt="" class="mt-1 w-32 h-32 rounded object-cover border">
        </div>
    @endif
    {{-- Status select --}}
    <div>
        <label class="text-sm font-medium">Status</label>
        @php
            // old() না থাকলে model-এর is_active (bool) থেকে int কাস্ট
            $status = old('is_active', isset($item) ? (int) $item->is_active : 1);
        @endphp
        <select name="is_active" class="mt-1 w-full rounded border px-3 py-2">
            <option value="1" {{ (string)$status === '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ (string)$status === '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('is_active')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('manage-focus-area.index') }}" class="rounded border px-4 py-2">Cancel</a>
    <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
        {{ $isEdit ? 'Update' : 'Save' }}
    </button>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
