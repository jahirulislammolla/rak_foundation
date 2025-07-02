<x-admin-layout>
    <div class="container mx-auto mt-5">
        <div class="flex justify-center">
            <div class="w-full lg:max-w-4xl">
    
                @if ($errors->any())
                <ul class="bg-yellow-100 text-yellow-700 p-4 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
    
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class=" px-6 py-4">
                        <div class="text-lg font-semibold flex justify-between items-center">
                            <span>Create User</span>
                            <a href="{{ url('users') }}" class="bg-red-500 text-white px-4 py-2 rounded float-right hover:bg-red-600">Back</a>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ url('users') }}" method="POST">
                            @csrf
    
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Name</label>
                                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500" />
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Email</label>
                                <input type="text" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500" />
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Password</label>
                                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500" />
                            </div>
                            <div class="mb-4">
                                <label for="roles" class="block text-gray-700">Roles</label>
                                <select name="roles[]" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-admin-layout>
