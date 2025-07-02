<div id="formContainer"  class="__formContainer__ bg-gray-600/50 hidden fixed inset-0 overflow-y-auto z-50">
    <div class="max-w-3xl m-4 md:mx-auto md:my-16 z-20 bg-white rounded p-4 space-y-3">
        <div class="flex justify-between items-center">

            <div class="px-3 rounded-md text-green-600 text-2xl font-semibold">
                Create Publication
            </div>
            <button 
                type="button"
                class="text-4xl text-rose-500 -mt-2 cursor-pointer" 
                onclick="this.closest('.__formContainer__').classList.add('hidden')"
            >
                &times;
            </button>
        </div>
        <div class="px-2">
            <form action="{{ route('manage-publications.store') }}" method="POST" class="mt-3"  enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="block text-gray-800 font-semibold">Title</label>
                    <textarea name="title" id="content" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3 col-span-1">
                        <label class="block text-gray-800 font-semibold">Type</label>
                        <select name="type" id="type" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="1">Journal</option>
                            <option value="2">Conference</option>
                        </select>     
                    </div>
            
                    <div class="mb-3 col-span-1">
                        <label class="block text-gray-800 font-semibold">Year</label>
                        <input type="number" name="year" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
        
                <div class="mb-3">
                    <label class="block text-gray-800 font-semibold">Writer</label>
                    <input type="text" name="writer" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
        
                <div class="mb-3">
                    <label class="block text-gray-800 font-semibold">Publisher</label>
                    <input type="text" name="publisher" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
        
                <div class="mb-3">
                    <label class="block text-gray-800 font-semibold">Link </label>
                    <input type="url" name="link" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-800 font-semibold">Pdf File</label>
                    <input type="file" name="file" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>

                <div class="mb-3 col-span-1">
                    <label class="block text-gray-800 font-semibold">Status</label>
                    <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="1">Active</option>
                        <option value="2">InActive</option>
                    </select>     
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-3 rounded">Save</button>
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