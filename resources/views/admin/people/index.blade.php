<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold">People</h1>
                <form method="GET">
                    <select name="type" class="rounded border px-2 py-1" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="member" {{ ($type ?? '')==='member'?'selected':'' }}>Members</option>
                        <option value="volunteer" {{ ($type ?? '')==='volunteer'?'selected':'' }}>Volunteers</option>
                    </select>
                </form>
            </div>
            <button id="btnOpenCreate" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">+ Add</button>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto rounded-xl border bg-white">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Priority</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Type</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Photo</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($people as $p)
                        <tr>
                            <td class="px-4 py-3">{{ $p->priority }}</td>
                            <td class="px-4 py-3 font-medium">{{ $p->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $p->type }}</td>
                            <td class="px-4 py-3">
                                @if($p->photo)
                                    <img src="{{ asset('storage/'.$p->photo) }}" class="h-10 w-10 rounded object-cover border" alt="">
                                @else
                                    <span class="text-gray-400 text-sm">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button
                                    class="mr-2 rounded bg-amber-500 px-3 py-1.5 text-white hover:bg-amber-600"
                                    data-edit
                                    data-update-url="{{ route('manage-people.update', $p) }}"
                                    data-name='@json($p->name)'
                                    data-type="{{ $p->type }}"
                                    data-priority="{{ $p->priority }}"
                                    data-photo-url="{{ $p->photo ? asset('storage/'.$p->photo) : '' }}"
                                >Edit</button>

                                <form class="inline" action="{{ route('manage-people.destroy', $p) }}" method="POST"
                                      onsubmit="return confirm('Delete this person?')">
                                    @csrf @method('DELETE')
                                    <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-3">{{ $people->links() }}</div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div id="modalCreate" class="hidden fixed inset-0 z-50 bg-black/50">
        <div class="mx-auto mt-10 w-full max-w-3xl rounded-2xl bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold">Add Person</h2>
                <button class="text-gray-500" onclick="closeCreate()">✕</button>
            </div>

            <form method="POST" enctype="multipart/form-data" action="{{ route('manage-people.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium">Name</label>
                        <input name="name" class="mt-1 w-full rounded border px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Type</label>
                        <select name="type" class="mt-1 w-full rounded border px-3 py-2" required>
                            <option value="member">Member</option>
                            <option value="volunteer">Volunteer</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Priority</label>
                        <input type="number" name="priority" value="0" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Photo</label>
                        <input type="file" name="photo" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeCreate()" class="rounded border px-4 py-2">Cancel</button>
                    <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div id="modalEdit" class="hidden fixed inset-0 z-50 bg-black/50">
        <div class="mx-auto mt-10 w-full max-w-3xl rounded-2xl bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold">Edit Person</h2>
                <button class="text-gray-500" onclick="closeEdit()">✕</button>
            </div>

            <form id="formEdit" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium">Name</label>
                        <input id="e_name" name="name" class="mt-1 w-full rounded border px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Type</label>
                        <select id="e_type" name="type" class="mt-1 w-full rounded border px-3 py-2" required>
                            <option value="member">Member</option>
                            <option value="volunteer">Volunteer</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Priority</label>
                        <input id="e_priority" type="number" name="priority" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Replace photo</label>
                        <input type="file" name="photo" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium block">Current photo</label>
                        <img id="e_preview" src="" class="h-16 w-16 rounded object-cover border" alt="">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeEdit()" class="rounded border px-4 py-2">Cancel</button>
                    <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modalCreate = document.getElementById('modalCreate');
        const modalEdit   = document.getElementById('modalEdit');
        const formEdit    = document.getElementById('formEdit');

        document.getElementById('btnOpenCreate')?.addEventListener('click', ()=> modalCreate.classList.remove('hidden'));
        function closeCreate(){ modalCreate.classList.add('hidden'); }
        function closeEdit(){ modalEdit.classList.add('hidden'); }

        // open edit + prefill
        document.querySelectorAll('[data-edit]').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                formEdit.action = btn.dataset.updateUrl;
                document.getElementById('e_name').value     = JSON.parse(btn.dataset.name);
                document.getElementById('e_type').value     = btn.dataset.type;
                document.getElementById('e_priority').value = btn.dataset.priority || 0;

                const img = document.getElementById('e_preview');
                img.src = btn.dataset.photoUrl || '';
                modalEdit.classList.remove('hidden');
            });
        });

        [modalCreate, modalEdit].forEach(m=>{
            m.addEventListener('click', e=>{ if(e.target===m) m.classList.add('hidden'); });
        });
    </script>
</x-admin-layout>
