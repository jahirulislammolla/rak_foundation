<x-admin-layout>
    <div class="py-1 px-3 flex justify-between items-center font-semibold text-2xl text-orange-600">
        Setting
    </div>

    <div class="px-3">
        <form action="{{ route('store_settings') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            @php

            @endphp

            {{-- Image Upload Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($images as $key => $label)
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-semibold">{{ $label }}</label>
                        @if (!empty($settings[$key] ?? ''))
                            <div class="w-full h-40 border rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                <img src="{{ asset($settings[$key]) }}" alt="{{ $label }}" class="max-h-full max-w-full object-contain" />
                            </div>
                        @endif
                        <input type="file" name="{{ $key }}" class="w-full p-2 border border-gray-300 rounded-lg mt-1" />
                    </div>
                @endforeach
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    Save Settings
                </button>
                <a href="{{ route('dashboard') }}" class="bg-rose-500 hover:bg-rose-600 text-white py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
