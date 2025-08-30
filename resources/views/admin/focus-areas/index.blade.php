<x-admin-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">

        {{-- Header + Create --}}
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold">Focus Areas</h1>
            <button id="btnOpenCreate"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                + Add Focus Area
            </button>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto rounded-xl border bg-white">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Order</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Title</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Slug</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Active</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($items as $item)
                        <tr>
                            <td class="px-4 py-3">{{ $item->order }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $item->title }}</div>
                                <div class="text-xs text-gray-500 line-clamp-1">{{ $item->short_description }}</div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $item->slug }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full px-2 py-0.5 text-xs
                                    {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $item->is_active ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button
                                    class="mr-2 rounded bg-amber-500 px-3 py-1.5 text-white hover:bg-amber-600"
                                    data-edit
                                    data-id="{{ $item->id }}"
                                    data-title='@json($item->title)'
                                    data-slug="{{ $item->slug }}"
                                    data-icon_class="{{ $item->icon_class }}"
                                    data-short_description='@json($item->short_description)'
                                    data-description='@json($item->description)'
                                    data-order="{{ $item->order }}"
                                    data-active="{{ $item->is_active ? 1 : 0 }}"
                                    data-update-url="{{ route('admin.focus-areas.update', $item) }}"
                                    data-image-url="{{ $item->image ? asset('storage/'.$item->image) : '' }}"
                                >Edit</button>

                                <form class="inline"
                                      action="{{ route('admin.focus-areas.destroy', $item) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this item?')">
                                    @csrf @method('DELETE')
                                    <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-3">
                {{ $items->links() }}
            </div>
        </div>
    </div>

    {{-- ===== Create Modal ===== --}}
    <div id="modalCreate" class="hidden fixed inset-0 z-50 bg-black/50">
        <div class="mx-auto mt-10 w-full max-w-3xl rounded-2xl bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold">Add Focus Area</h2>
                <button class="text-gray-500" onclick="closeCreate()">✕</button>
            </div>

            <form id="formCreate" method="POST" enctype="multipart/form-data"
                  action="{{ route('admin.focus-areas.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium">Title</label>
                        <input name="title" id="create_title" class="mt-1 w-full rounded border px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Slug (optional)</label>
                        <input name="slug" id="create_slug" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Icon class</label>
                        <input name="icon_class" class="mt-1 w-full rounded border px-3 py-2"
                               placeholder="fa-solid fa-leaf">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Order</label>
                        <input type="number" name="order" value="0" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Short description</label>
                        <input name="short_description" class="mt-1 w-full rounded border px-3 py-2" maxlength="255">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Full description</label>
                        <textarea name="description" rows="6" class="mt-1 w-full rounded border px-3 py-2"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Image</label>
                        <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div class="flex items-center gap-2">
                        <input id="create_active" type="checkbox" name="is_active" value="1" checked>
                        <label for="create_active">Active</label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeCreate()" class="rounded border px-4 py-2">Cancel</button>
                    <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== Edit Modal (re-usable) ===== --}}
    <div id="modalEdit" class="hidden fixed inset-0 z-50 bg-black/50">
        <div class="mx-auto mt-10 w-full max-w-3xl rounded-2xl bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold">Edit Focus Area</h2>
                <button class="text-gray-500" onclick="closeEdit()">✕</button>
            </div>

            <form id="formEdit" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium">Title</label>
                        <input name="title" id="edit_title" class="mt-1 w-full rounded border px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Slug (optional)</label>
                        <input name="slug" id="edit_slug" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Icon class</label>
                        <input name="icon_class" id="edit_icon" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium">Order</label>
                        <input type="number" name="order" id="edit_order" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Short description</label>
                        <input name="short_description" id="edit_short" class="mt-1 w-full rounded border px-3 py-2" maxlength="255">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-medium">Full description</label>
                        <textarea name="description" id="edit_desc" rows="6" class="mt-1 w-full rounded border px-3 py-2"></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Replace image</label>
                        <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm font-medium block">Current image</label>
                        <img id="edit_preview" src="" alt="" class="mt-1 h-16 w-16 rounded object-cover border">
                    </div>
                    <div class="flex items-center gap-2">
                        <input id="edit_active" type="checkbox" name="is_active" value="1">
                        <label for="edit_active">Active</label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeEdit()" class="rounded border px-4 py-2">Cancel</button>
                    <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== Little JS (vanilla) ===== --}}
    <script>
        // helpers
        const slugify = s => s.toLowerCase()
            .replace(/[^a-z0-9\s-]/g,'')
            .trim().replace(/\s+/g,'-').replace(/-+/g,'-');

        // Create modal
        const modalCreate = document.getElementById('modalCreate');
        document.getElementById('btnOpenCreate')?.addEventListener('click', ()=> modalCreate.classList.remove('hidden'));
        function closeCreate(){ modalCreate.classList.add('hidden'); }

        // auto slug (create)
        const cTitle = document.getElementById('create_title');
        const cSlug  = document.getElementById('create_slug');
        cTitle?.addEventListener('input', ()=> { if(!cSlug.value) cSlug.value = slugify(cTitle.value); });

        // Edit modal
        const modalEdit = document.getElementById('modalEdit');
        const formEdit  = document.getElementById('formEdit');

        function openEdit(btn){
            // set action URL
            formEdit.action = btn.dataset.updateUrl;

            // fill fields
            document.getElementById('edit_title').value = JSON.parse(btn.dataset.title);
            document.getElementById('edit_slug').value  = btn.dataset.slug || '';
            document.getElementById('edit_icon').value  = btn.dataset.icon_class || '';
            document.getElementById('edit_order').value = btn.dataset.order || 0;
            document.getElementById('edit_short').value = JSON.parse(btn.dataset.short_description || '""');
            document.getElementById('edit_desc').value  = JSON.parse(btn.dataset.description || '""');
            document.getElementById('edit_active').checked = btn.dataset.active === '1';

            const preview = document.getElementById('edit_preview');
            preview.src = btn.dataset.imageUrl || '';
            preview.classList.toggle('hidden', !btn.dataset.imageUrl);

            modalEdit.classList.remove('hidden');
        }
        function closeEdit(){ modalEdit.classList.add('hidden'); }

        // hook all edit buttons
        document.querySelectorAll('[data-edit]').forEach(btn=>{
            btn.addEventListener('click', ()=> openEdit(btn));
        });

        // auto slug (edit) if empty
        const eTitle = document.getElementById('edit_title');
        const eSlug  = document.getElementById('edit_slug');
        eTitle?.addEventListener('input', ()=> { if(!eSlug.value) eSlug.value = slugify(eTitle.value); });

        // close on bg click
        [modalCreate, modalEdit].forEach(m=>{
            m?.addEventListener('click', e=>{ if(e.target===m) m.classList.add('hidden'); });
        });
    </script>
</x-admin-layout>
