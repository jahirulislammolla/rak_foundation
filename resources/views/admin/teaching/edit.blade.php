<x-admin-layout>
    <div class="py-1 px-3 flex justify-between align-center font-semibold text-2xl text-orange-600">
        Update Teaching
    </div>
    <div class="py-1 px-3 flex justify-between align-center text-lg text-green-600">
        @if(Session::has('success'))
        <div class="alert alert-danger">
        {{ Session::get('success')}}
        </div>
        @endif
    </div>
    <div class="px-3">
        <form action="{{ route('manage-teachings.update', $teaching->id) }}" method="POST" enctype="multipart/form-data" class="mt-5">
            @csrf
            @method('PUT')
            @php
                $types = [
                    1 => "Assistant Professor",
                    2 => "Lecturer",
                    3 => "Teaching Assistant",
                    4 => "Course Instructor / Sessional Lecturer",
                    5 => "Guest Lectures",
                ];
            @endphp
            <div class="mb-4">
                <label class="block text-gray-700">Type</label>
                <select name="type" id="type" class="w-full p-2 border border-gray-300 rounded-lg">
                    @foreach ($types as $key => $type)   
                    <option value="{{ $key }}" {{ $teaching->type == $key ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ $teaching->title }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Content</label>
                <textarea name="content" id="content" class="w-full p-2 border border-gray-300 rounded-lg">{{ $teaching->content }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Priority</label>
                <input type="number" name="priority" value="{{ $teaching->priority }}" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="mb-3 col-span-1">
                <label class="block text-gray-800 font-semibold">Status</label>
                <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="1" {{ $teaching->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ $teaching->status == 2 ? 'selected' : '' }}>InActive</option>
                </select>
            </div>

            <button type="submit" class="bg-orange-500 text-white py-2 px-3 rounded">Update</button>
            <a href="{{ route('manage-teachings.index') }}" class="edit_teaching ml-3 px-3 py-2 rounded bg-sky-500 hover:bg-blue-400 text-white">Back</a>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-admin-layout>
