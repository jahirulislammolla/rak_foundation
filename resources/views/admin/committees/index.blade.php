<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold">Committees</h1>
            <a href="{{ route('manage-committees.create') }}"
               class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">+ Add</a>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto rounded-xl border bg-white">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Serial No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Member</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Contact</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Designation</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Priority</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Photo</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @foreach($committees as $cm)
                    <tr>
                        <td class="px-4 py-3">
                            {{ $committees->firstItem() + $loop->index }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $cm->name }}</div>
                            <div class="font-medium">{{ $cm->contact }}</div>
                            <div class="text-xs text-gray-500">{{ $cm->short_description }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $cm->designation }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $cm->priority }}</td>
                        <td class="px-4 py-3">
                            @if($cm->photo)
                                <img src="{{ asset($cm->photo) }}" class="h-10 w-10 rounded object-cover border" alt="">
                            @else
                                <span class="text-gray-400 text-sm">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('manage-committees.edit', $cm) }}"
                               class="mr-2 rounded bg-amber-500 px-3 py-1.5 text-white hover:bg-amber-600">Edit</a>

                            <form class="inline" action="{{ route('manage-committees.destroy', $cm) }}" method="POST"
                                  onsubmit="return confirm('Delete this member?')">
                                @csrf @method('DELETE')
                                <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="p-3">{{ $committees->links() }}</div>
        </div>
    </div>
</x-admin-layout>
