<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold">Event Registrations</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('manage-event-registrations.export') }}" class="rounded bg-emerald-600 px-3 py-2 text-white hover:bg-emerald-700">Export CSV</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
        @endif

        {{-- Filters --}}
        <form method="get" class="mb-3 grid grid-cols-1 md:grid-cols-4 gap-2">
            <input type="text" name="q" value="{{ $q }}" placeholder="Search name/email/phone/txn" class="rounded border px-3 py-2">
            <select name="event_id" class="rounded border px-3 py-2">
                <option value="">All events</option>
                @foreach($events as $ev)
                    <option value="{{ $ev->id }}" @selected($eventId==$ev->id)>{{ $ev->title }}</option>
                @endforeach
            </select>
            <select name="status" class="rounded border px-3 py-2">
                <option value="">Any status</option>
                @foreach(['pending','verified','cancelled'] as $st)
                    <option value="{{ $st }}" @selected($status===$st)>{{ ucfirst($st) }}</option>
                @endforeach
            </select>
            <button class="rounded bg-blue-600 px-3 py-2 text-white hover:bg-blue-700">Filter</button>
        </form>

        <div class="overflow-x-auto rounded-xl border bg-white">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Event</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Registrant</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Ticket</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Payment</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Txn ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @foreach($registrations as $r)
                    <tr>
                        <td class="px-4 py-3">{{ $registrations->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $r->event?->title ?? '—' }}</div>
                            <div class="text-xs text-gray-500">{{ $r->created_at->format('d M Y, h:i A') }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $r->full_name }}</div>
                            <div class="text-xs text-gray-500">{{ $r->email }} • {{ $r->phone }}</div>
                        </td>
                        <td class="px-4 py-3">
                            {{ ucfirst($r->ticket_type) }} (৳{{ number_format($r->amount) }})
                        </td>
                        <td class="px-4 py-3">{{ $r->payment_method }}</td>
                        <td class="px-4 py-3">{{ $r->transaction_id }}</td>
                        <td class="px-4 py-3">
                            @php
                            $badge = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'verified' => 'bg-green-100 text-green-800',
                            'cancelled' => 'bg-red-100 text-red-800',
                            ][$r->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="rounded-full px-2 py-0.5 text-xs {{ $badge }}">{{ ucfirst($r->status) }}</span>
                        </td>
                        <td class="px-4 py-3 text-right flex gap-2">
                            <form class="inline" action="{{ route('manage-event-registrations.destroy', $r) }}" method="POST"
                                  onsubmit="return confirm('Delete this registration?')">
                                @csrf @method('DELETE')
                                <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">Delete</button>
                            </form>
                            @if($r->status !== 'verified')
                                <form class="inline" action="{{ route('manage-event-registrations.verify', $r) }}" method="POST"
                                    onsubmit="return confirm('Mark this registration as VERIFIED?')">
                                    @csrf @method('PATCH')
                                    <button class="rounded bg-emerald-600 px-3 py-1.5 text-white hover:bg-emerald-700">
                                        Verify
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="p-3">{{ $registrations->links() }}</div>
        </div>
    </div>
</x-admin-layout>
