<div id="formContainer"  class="__formContainer__ bg-gray-600/50 hidden fixed inset-0 overflow-y-auto z-50">
    <div class="max-w-3xl m-4 md:mx-auto md:my-16 z-20 bg-white rounded p-4 space-y-3">
        <div class="flex justify-between items-center">

            <div class="px-3 rounded-md text-green-600 text-2xl font-semibold">
                Create Professional Service
            </div>
            <button 
                type="button"
                class="text-4xl text-rose-500 -mt-2 cursor-pointer" 
                onclick="this.closest('.__formContainer__').classList.add('hidden')"
            >
                &times;
            </button>
        </div>
        <div class="px-3">
            <form action="{{ route('manage-professional-services.store') }}" method="POST" enctype="multipart/form-data" class="mt-5">
                @csrf
    
                <div class="mb-4">
                    <label class="block text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Type</label>
                    <select name="type" id="type" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="">Select Type</option>
                        <option value="1">Professional Memberships</option>
                        <option value="2">Professional Society Services</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Content</label>
                    <textarea name="content" id="content" class="w-full p-2 border border-gray-300 rounded-lg">{{ old('content') }}</textarea>
                </div>
    
                <div class="mb-4">
                    <label class="block text-gray-700">Priority</label>
                    <input type="number" name="priority" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>

                <div class="mb-3 col-span-1">
                    <label class="block text-gray-800 font-semibold">Status</label>
                    <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="1">Active</option>
                        <option value="2">InActive</option>
                    </select>
                </div>
    
                <button type="submit" class="bg-blue-500 text-white py-2 px-3 rounded">Create</button>
                <button 
                    type="button"
                    class="bg-rose-600 text-white py-2 px-3 rounded cursor-pointer ml-2" 
                    onclick="this.closest('.__formContainer__').classList.add('hidden')"
                >
                    Cancel
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>