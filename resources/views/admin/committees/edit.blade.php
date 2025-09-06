<x-admin-layout>
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Edit Committee Member</h1>
            <a href="{{ route('manage-committees.index') }}" class="text-sm text-blue-600 hover:underline">← Back</a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-50 p-3 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data"
              action="{{ route('manage-committees.update', $committee->id) }}"
              class="rounded-2xl border bg-white p-6">
            @csrf @method('PUT')
            @include('admin.committees._form', ['committee' => $committee])
            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('manage-committees.index') }}" class="rounded border px-4 py-2">Cancel</a>
                <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</x-admin-layout>
