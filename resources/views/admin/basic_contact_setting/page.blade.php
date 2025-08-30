<x-admin-layout>
    <div class="py-1 px-3 flex justify-between items-center font-semibold text-2xl text-orange-600">
    Contact Info Setting
    </div>

    <div class="px-3">
        <form action="{{ route('store_contact_settings') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6">

                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold">Contact Telephone</label>
                    <input type="text" name="contact_telephone" value="{{ $settings['contact_telephone'] ?? '' }}" class="w-full p-2 border border-gray-300 rounded-lg mt-1" />
                </div>
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold">Contact Email</label>
                    <input type="text" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full p-2 border border-gray-300 rounded-lg mt-1" />
                </div>
                <div class="space-y-2">
                    <label class="block text-gray-700 font-semibold">Contact Address</label>
                    <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? '' }}" class="w-full p-2 border border-gray-300 rounded-lg mt-1" />
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    Save Info
                </button>
                <a href="{{ route('dashboard') }}" class="bg-rose-500 hover:bg-rose-600 text-white py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </form>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#home_page_bio'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-admin-layout>
