
<x-admin-layout>

    <div class="container mx-auto mt-5">
        <a href="{{ url('roles') }}" class="bg-blue-500 text-white px-4 py-2 rounded mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="bg-blue-400 text-white px-4 py-2 rounded mx-1">Permissions</a>
        <a href="{{ url('users') }}" class="bg-yellow-500 text-white px-4 py-2 rounded mx-1">Users</a>
    </div>

    <div class="container mx-auto mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('status') }}</div>
                @endif

                <div class="card bg-white shadow-md rounded mt-3">
                    <div class="card-header border-b border-gray-200 px-4 py-3">
                        <div class="text-lg font-semibold flex justify-between items-center">
                            <span>Roles</span>
                            @can('create role')
                            <a href="{{ url('roles/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded float-right">Add Role</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body px-4 py-2">

                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Id</th>
                                    <th class="py-2 px-4 border-b">Name</th>
                                    <th class="py-2 px-4 border-b" style="width: 40%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $role->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $role->name }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Add / Edit Role Permission</a>

                                        @can('update role')
                                        <a href="{{ url('roles/'.$role->id.'/edit') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Edit</a>
                                        @endcan

                                        @can('delete role')
                                        <a href="{{ url('roles/'.$role->id.'/delete') }}" onclick="return confirm('Are you sure delete this role?');" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Delete</a>
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

