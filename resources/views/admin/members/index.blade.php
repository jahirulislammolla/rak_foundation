{{-- resources/views/admin/members/index.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h1 class="text-xl font-semibold text-gray-900">Membership Requests</h1>
            <form method="GET" class="flex items-center gap-2">
                <select name="status" class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    @foreach (['pending','approved','rejected'] as $st)
                        <option value="{{ $st }}" {{ request('status')===$st ? 'selected':'' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
                <select name="type" class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="yearly" {{ request('type')==='yearly'?'selected':'' }}>Yearly</option>
                    <option value="lifetime" {{ request('type')==='lifetime'?'selected':'' }}>Lifetime</option>
                </select>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-sm text-green-700">{{ session('success') }}</div>
        @endif

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Applicant</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Fee</th>
                            <th class="px-4 py-3">Paid?</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Approved</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($members as $m)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-500">{{ $m->id }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        @if($m->photo_path)
                                            <img src="{{ asset($m->photo_path) }}" class="h-10 w-10 rounded-full object-cover" alt="">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-200"></div>
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $m->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $m->email ?? $m->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ ucfirst($m->membership_type) }}</td>
                                <td class="px-4 py-3">৳ {{ number_format($m->fee) }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full px-2 py-0.5 text-xs {{ $m->is_paid ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $m->is_paid ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $badge = match($m->status) {
                                            'approved' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            default => 'bg-amber-100 text-amber-700'
                                        };
                                    @endphp
                                    <span class="rounded-full px-2 py-0.5 text-xs {{ $badge }}">{{ ucfirst($m->status) }}</span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    @if($m->approved_at)
                                        {{ $m->approved_at->format('d M Y') }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('manage-members.edit', $m) }}"
                                           class="inline-flex items-center rounded-md border border-gray-300 px-2.5 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">Edit</a>

                                        @if($m->status !== 'approved')
                                            <form action="{{ route('manage-members.approve', $m) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="inline-flex items-center rounded-md border border-green-300 px-2.5 py-1.5 text-xs font-medium text-green-700 hover:bg-green-50">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif

                                        @if($m->status !== 'rejected')
                                            <form action="{{ route('manage-members.reject', $m) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="inline-flex items-center rounded-md border border-red-300 px-2.5 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('manage-members.destroy', $m) }}" method="POST"
                                              onsubmit="return confirm('Delete this record?')">
                                            @csrf @method('DELETE')
                                            <button class="inline-flex items-center rounded-md border border-gray-300 px-2.5 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="px-4 py-8 text-center text-gray-500">No applications found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3">{{ $members->links() }}</div>
        </div>
    </div>
</x-admin-layout>
