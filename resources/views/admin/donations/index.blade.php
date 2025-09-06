{{-- resources/views/admin/donations/index.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-semibold mb-6">Donations</h1>

        {{-- Small stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-8">
            <div class="p-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="text-sm text-gray-500">Today Amount</div>
                <div class="mt-1 text-2xl font-bold">৳{{ number_format($stats['today'],2) }}</div>
            </div>
            <div class="p-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="text-sm text-gray-500">Approved Total</div>
                <div class="mt-1 text-2xl font-bold">৳{{ number_format($stats['approved'],2) }}</div>
            </div>
            <div class="p-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="text-sm text-gray-500">Pending</div>
                <div class="mt-1 text-2xl font-bold">{{ $stats['pending'] }}</div>
            </div>
            <div class="p-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="text-sm text-gray-500">Rejected</div>
                <div class="mt-1 text-2xl font-bold">{{ $stats['rejected'] }}</div>
            </div>
        </div>

        {{-- Filters --}}
        <form method="GET" class="mb-6 flex flex-wrap items-end gap-4">
            <div class="w-full sm:w-44">
                <label class="block text-sm text-gray-700 mb-1">Status</label>
                <select name="status"
                        class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All</option>
                    @foreach(['pending','approved','rejected'] as $st)
                        <option value="{{ $st }}" @selected(($filters['status'] ?? '') === $st)>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-56">
                <label class="block text-sm text-gray-700 mb-1">Cause</label>
                <select name="cause_id"
                        class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All</option>
                    @foreach($causes as $c)
                        <option value="{{ $c->id }}" @selected(($filters['cause_id'] ?? '') == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-64">
                <label class="block text-sm text-gray-700 mb-1">Search</label>
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="name/email/phone/txn"
                       class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <button
                class="inline-flex h-10 items-center justify-center rounded-md bg-indigo-600 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                Filter
            </button>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Donor</th>
                        <th class="px-4 py-3">Cause</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Method</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($donations as $d)
                        <tr class="hover:bg-gray-50/40">
                            <td class="px-4 py-3 text-gray-700">{{ $d->id }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $d->created_at->format('d M Y, h:i A') }}</td>
                            <td class="px-4 py-3">
                                @if($d->is_anonymous)
                                    <span class="italic text-gray-500">Anonymous</span>
                                @else
                                    <div class="font-medium text-gray-900">{{ $d->full_name }}</div>
                                    <div class="text-gray-500 text-xs">
                                        {{ $d->email }}
                                        @if($d->phone) <span class="text-gray-400"> • </span> {{ $d->phone }} @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $d->cause?->name ?? '-' }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-900">৳{{ number_format($d->amount,2) }}</td>
                            <td class="px-4 py-3 uppercase text-gray-700">{{ $d->payment_method }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $colors = [
                                        'pending'  => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
                                        'approved' => 'bg-green-100 text-green-800 ring-green-200',
                                        'rejected' => 'bg-rose-100 text-rose-800 ring-rose-200',
                                    ];
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 {{ $colors[$d->status] }}">
                                    {{ ucfirst($d->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    @if($d->status !== 'approved')
                                        <form method="POST" action="{{ route('manage-donations.approve',$d) }}">
                                            @csrf @method('PATCH')
                                            <button
                                                class="inline-flex items-center gap-1 rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-emerald-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500"
                                                onclick="return confirm('Approve this donation?')">
                                                Approve
                                            </button>
                                        </form>
                                    @endif

                                    @if($d->status !== 'rejected')
                                        <form method="POST" action="{{ route('manage-donations.reject',$d) }}">
                                            @csrf @method('PATCH')
                                            <button
                                                class="inline-flex items-center gap-1 rounded-md bg-rose-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-rose-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500"
                                                onclick="return confirm('Reject this donation?')">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                @if($d->reviewer)
                                    <div class="mt-1 text-xs text-gray-500">Reviewed by: {{ $d->reviewer->name }}</div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-10 text-center text-gray-500">No donations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{-- Laravel default Tailwind pagination --}}
            {{ $donations->links() }}
        </div>
    </div>
</x-admin-layout>
