<x-admin-layout>

    <div class="container mx-auto mt-5">
        <div class="flex flex-col">
            <div class="w-full">

                @if ($errors->any())
                <ul class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="bg-white shadow-md rounded-lg">
                    <div class="px-6 py-4 border-b">
                        <div class="text-lg font-semibold flex justify-between items-center">
                            <span>Create Role</span>
                            <a href="{{ url('roles') }}" class="btn bg-red-500 text-white py-2 px-4 rounded float-right">Back</a>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ url('roles') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="" class="block text-gray-700 text-sm font-bold mb-2">Role Name</label>
                                <input type="text" name="name" class="form-input w-full rounded-md p-2 border border-gray-600  shadow-sm" />
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>
