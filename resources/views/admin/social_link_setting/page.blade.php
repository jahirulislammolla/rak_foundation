<x-admin-layout>
    <div class="py-1 px-3 flex justify-between items-center font-semibold text-2xl text-orange-600">
        Social Link Setting
    </div>

    <div class="px-3">
        <form action="{{ route('store_social_link_settings') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            {{-- Image Upload Section --}}
            <div class="grid grid-cols-1 gap-6">
                @foreach ($socials as $key => $label)
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-semibold">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" value="{{ $settings[$key] ?? '' }}" class="w-full p-2 border border-gray-300 rounded-lg mt-1" />
                    </div>
                @endforeach
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    Save social Link
                </button>
                <a href="{{ route('dashboard') }}" class="bg-rose-500 hover:bg-rose-600 text-white py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
