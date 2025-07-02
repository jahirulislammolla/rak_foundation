<x-admin-layout>

    <div class="container mx-auto mt-5">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                <ul class="bg-yellow-500 text-white p-3 rounded mb-3">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card border border-gray-300 shadow-lg rounded-lg">
                    <div class="card-header bg-gray-200 p-4 rounded-t-lg">
                        <div class="text-lg font-semibold flex justify-between items-center">
                            <span>Edit Role</span>
                            <a href="{{ url('roles') }}" class="btn bg-red-500 text-white py-2 px-4 rounded float-right">Back</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ url('roles/'.$role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="" class="block text-sm font-medium text-gray-700">Role Name</label>
                                <input type="text" name="name" value="{{ $role->name }}" class="form-input mt-1 p-2 border border-gray-600 block w-full rounded-md  shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn bg-blue-500 text-white py-2 px-4 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
