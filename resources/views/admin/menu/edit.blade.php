
<x-admin-layout>
    <div class="py-1 px-3 flex justify-between align-center font-semibold text-2xl text-orange-600">
        Update Publication
    </div>
    <div class="px-3">
        <form action="{{ route('manage-publications.update', $publication->id) }}" method="POST"  enctype="multipart/form-data" class="mt-5"> 
            @csrf
            @method('PUT')
    
            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <textarea name="title" id="title" cols="10" rows="2" 
                class="w-full p-2 border border-gray-300 rounded-lg" required>{{ $publication->title }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4 col-span-1">
                    <label class="block text-gray-700">Type</label>
                    <select name="type" id="type" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="1">Journal</option>
                        <option value="2">Conference</option>
                    </select>     
                </div>
        
                <div class="mb-4 col-span-1">
                    <label class="block text-gray-700">Year</label>
                    <input type="number" name="year" value="{{ $publication->year }}" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Writer</label>
                <input type="text" name="writer" value="{{ $publication->writer }}" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700">Publisher</label>
                <input type="text" name="publisher" value="{{ $publication->publisher }}" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Link</label>
                <input type="url" name="link" value="{{ $publication->link }}" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
    
            <div class="grid grid-cols-2 gap-4 items-center">
                <div class="mb-4 col-span-1">
                    <label class="block text-gray-700">File</label>
                    <input type="file" name="file" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <a href="{{ asset($publication->file) }}" target="_blank" class="edit_publication ml-3 px-3 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white">Pdf File</a>
                </div>
            </div>
            <button type="submit" class="bg-orange-500 text-white py-2 px-3 rounded">Update</button>
            <a href="{{ route('manage-publications.index') }}"
                class="edit_publication ml-3 px-3 py-2 rounded bg-sky-500 hover:bg-blue-400 text-white">
                Back
            </a>
        </form>
    </div>
</x-admin-layout>
