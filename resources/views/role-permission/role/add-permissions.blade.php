<x-admin-layout>

    <div class="container mx-auto mt-5">
        <div class="flex flex-wrap">
            <div class="w-full">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="bg-white shadow-md rounded-lg">
                    <div class="px-4 py-3 border-b text-lg font-semibold flex justify-between items-center">
                        <span>Role: {{ $role->name }}</span>
                        <a href="{{ url('roles') }}" class="btn btn-danger float-right text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">Back</a>
                    </div>
                    <div class="p-4">
                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                @error('permission')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror

                                <label for="" class="block mb-2 font-semibold">Permissions</label>

                                <div class="flex flex-wrap">
                                    @foreach ($permissions as $permission)
                                    <div class="w-1/5 mb-2">
                                        <label class="inline-flex items-center">
                                            <input
                                                type="checkbox"
                                                name="permission[]"
                                                value="{{ $permission->name }}"
                                                class="mr-2"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            />
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>