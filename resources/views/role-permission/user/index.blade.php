<x-admin-layout>

    <div class="container mx-auto mt-5">
        <a href="{{ url('roles') }}" class="btn bg-blue-500 text-white py-2 px-4 rounded mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="btn bg-blue-400 text-white py-2 px-4 rounded mx-1">Permissions</a>
        <a href="{{ url('users') }}" class="btn bg-yellow-500 text-white py-2 px-4 rounded mx-1">Users</a>
    </div>

    <div class="container mx-auto mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success bg-green-500 text-white p-2 rounded">{{ session('status') }}</div>
                @endif

                <div class="card mt-3 border border-gray-300 shadow-lg rounded-lg">
                    <div class="card-header bg-gray-200 p-3 rounded-t-lg">
                        <div class="text-lg font-semibold flex justify-between items-center">
                            <span>Users</span>
                            @can('create role')
                            <a href="{{ url('users/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded float-right">Add User</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body p-4">

                        <table class="table-auto w-full text-left border-collapse">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border-b-2 p-2">Id</th>
                                    <th class="border-b-2 p-2">Name</th>
                                    <th class="border-b-2 p-2">Email</th>
                                    <th class="border-b-2 p-2">Roles</th>
                                    <th class="border-b-2 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="border-b p-2">{{ $user->id }}</td>
                                    <td class="border-b p-2">{{ $user->name }}</td>
                                    <td class="border-b p-2">{{ $user->email }}</td>
                                    <td class="border-b p-2">
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <span class="bg-blue-500 text-white py-1 px-2 rounded mx-1">{{ $rolename }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="border-b p-2">
                                        @can('update user')
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn bg-green-500 text-white py-1 px-3 rounded">Edit</a>
                                        @endcan

                                        @can('delete user')
                                        <a href="{{ url('users/'.$user->id.'/delete') }}" onclick="return confirm('Are you sure delete this user?');" class="btn bg-red-500 text-white py-1 px-3 rounded mx-2">Delete</a>
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
