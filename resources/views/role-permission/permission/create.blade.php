<x-admin-layout>
    <div class="container mx-auto mt-5">
        <div class="flex justify-center">
            <div class="w-full max-w-3xl">

                @if ($errors->any())
                <ul class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <li class="list-disc list-inside">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-800 p-3">
                        <div class="text-white font-bold text-lg flex justify-between items-center">
                            <span>Create Permission</span>
                            <a href="{{ url('permissions') }}" class="bg-red-500 text-white px-5 py-2 rounded float-right">Back</a>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ url('permissions') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Permission Name</label>
                                <input type="text" name="name" class="form-input mt-1 p-2 border border-gray-600 block w-full rounded-md shadow-sm" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
