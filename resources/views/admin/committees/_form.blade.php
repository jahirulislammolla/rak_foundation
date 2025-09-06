@php /** @var \App\Models\Committee $committee */ @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium">Name</label>
        <input name="name" class="mt-1 w-full rounded border px-3 py-2"
               value="{{ old('name', $committee->name) }}" required>
        @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Designation</label>
        <input name="designation" class="mt-1 w-full rounded border px-3 py-2"
               value="{{ old('designation', $committee->designation) }}" required>
        @error('designation')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="text-sm font-medium">Contact</label>
        <input name="contact" class="mt-1 w-full rounded border px-3 py-2"
               value="{{ old('contact', $committee->contact) }}" >
        @error('contact')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-medium">Short description</label>
        <input name="short_description" maxlength="255" class="mt-1 w-full rounded border px-3 py-2"
               value="{{ old('short_description', $committee->short_description) }}">
        @error('short_description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Priority</label>
        <input type="number" name="priority" min="1" class="mt-1 w-full rounded border px-3 py-2"
               value="{{ old('priority', $committee->priority ?? 1) }}">
        @error('priority')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Photo</label>
        <input type="file" name="photo" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
        @error('photo')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    @if($committee->photo_url)
        <div class="md:col-span-2">
            <label class="text-sm font-medium block mb-1">Current photo</label>
            <img src="{{ $committee->photo_url }}" class="h-16 w-16 rounded object-cover border" alt="">
            <div class="mt-2 flex items-center gap-2">
                <input type="checkbox" id="remove_photo" name="remove_photo" value="1">
                <label for="remove_photo" class="text-sm">Remove photo</label>
            </div>
        </div>
    @endif
</div>
