{{-- resources/views/admin/members/edit.blade.php --}}
<x-admin-layout>
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-900">Edit Member</h1>
            <a href="{{ route('manage-members.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Back</a>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6">
            <form method="POST" action="{{ route('manage-members.update', $m) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name *</label>
                        <input name="name" value="{{ old('name',$m->name) }}" required
                               class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input name="email" value="{{ old('email',$m->email) }}"
                               class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                        <input name="phone" value="{{ old('phone',$m->phone) }}"
                               class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Profession</label>
                        <input name="profession" value="{{ old('profession',$m->profession) }}"
                               class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" rows="2"
                              class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('address',$m->address) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Membership Type *</label>
                        <select name="membership_type" class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="yearly" {{ old('membership_type',$m->membership_type)==='yearly'?'selected':'' }}>Yearly (৳1000)</option>
                            <option value="lifetime" {{ old('membership_type',$m->membership_type)==='lifetime'?'selected':'' }}>Lifetime (৳5000)</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Fee auto-updates based on type.</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <label class="inline-flex items-center mt-6">
                            <input type="checkbox" name="is_paid" value="1" {{ old('is_paid',$m->is_paid)?'checked':'' }}
                                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Paid</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <input name="payment_method" value="{{ old('payment_method',$m->payment_method) }}"
                               class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Transaction ID</label>
                        <input name="transaction_id" value="{{ old('transaction_id',$m->transaction_id) }}"
                               class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Photo</label>
                        <input type="file" name="photo" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-900 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-2 hover:file:bg-gray-200">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Note</label>
                    <textarea name="note" rows="3"
                              class="mt-1 w-full py-2 px-3 border rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('note',$m->note) }}</textarea>
                </div>

                @if($m->photo_path)
                    <div class="rounded-lg border border-gray-200 p-3">
                        <div class="text-xs text-gray-500 mb-2">Current Photo</div>
                        <img src="{{ asset($m->photo_path) }}" class="w-72 rounded object-cover" alt="">
                    </div>
                @endif

                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-3 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex items-center gap-3">
                    <button class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        Save Changes
                    </button>
                    <a href="{{ route('manage-members.index') }}"
                       class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                </div>
            </form>

            {{-- Quick Approve/Reject--}}
            <div class="mt-6 flex items-center gap-3">
                @if($m->status !== 'approved')
                    <form action="{{ route('manage-members.approve', $m) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="rounded-md border border-green-300 px-4 py-2 text-sm font-medium text-green-700 hover:bg-green-50">
                            Approve
                        </button>
                    </form>
                @endif
                @if($m->status !== 'rejected')
                    <form action="{{ route('manage-members.reject', $m) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="rounded-md border border-red-300 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50">
                            Reject
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
