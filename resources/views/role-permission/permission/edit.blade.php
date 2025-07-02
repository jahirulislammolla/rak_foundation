<x-admin-layout>

    <div class="container mx-auto mt-5">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3 lg:w-1/2">

                @if ($errors->any())
                <ul class="bg-yellow-200 text-yellow-800 p-4 rounded-md mb-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="bg-white shadow-md rounded-md">
                    <div class="bg-gray-800 text-white px-4 py-3 rounded-t-md">
                        <h4 class="text-lg font-semibold flex justify-between items-center">
                            <span>Edit Permission</span>
                            <a href="{{ url('permissions') }}" class="btn btn-danger float-end bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Back</a>
                        </h4>
                    </div>
                    <div class="p-6">
                        <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-semibold mb-2">Permission Name</label>
                                <input type="text" name="name" value="{{ $permission->name }}" class="w-full px-4 py-2 border border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-admin-layout>
