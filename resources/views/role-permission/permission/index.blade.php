<x-admin-layout>

    <div class="container mx-auto mt-5">
        <a href="{{ url('roles') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="btn btn-info bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mx-1">Permissions</a>
        <a href="{{ url('users') }}" class="btn btn-warning bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mx-1">Users</a>
    </div>

    <div class="container mx-auto mt-2">
        <div class="row">
            <div class="w-full">

                @if (session('status'))
                    <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4">{{ session('status') }}</div>
                @endif

                <div class="card bg-white shadow-md rounded mt-3">
                    <div class="card-header px-6 py-3 border-b border-gray-200">
                        <div class="text-lg font-semibold flex justify-between items-center">
                            <span>Permissions</span>
                            @can('create permission')
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right">Add Permission</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-6">

                        <table class="table-auto w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th class="border-b px-4 py-2">Id</th>
                                    <th class="border-b px-4 py-2">Name</th>
                                    <th class="border-b px-4 py-2 w-1/3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td class="border-t px-4 py-2">{{ $permission->id }}</td>
                                    <td class="border-t px-4 py-2">{{ $permission->name }}</td>
                                    <td class="border-t px-4 py-2">
                                        @can('update permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                        @endcan

                                        @can('delete permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/delete') }}" onclick="return confirm('Are you sure delete this permission?');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mx-2">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
