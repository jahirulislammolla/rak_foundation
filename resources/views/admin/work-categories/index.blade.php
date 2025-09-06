<x-admin-layout>
  <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Work Categories</h1>
      <button id="btnOpenCreate" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">+ Add</button>
    </div>

    @if(session('success'))
      <div class="mb-4 rounded-md bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-xl border bg-white">
      <table class="min-w-full divide-y">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">Serial No</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Slug</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Active</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y">
        @foreach($categories as $index => $c)
          <tr>
            <td class="px-4 py-3">{{ $index + 1 }}</td>
            <td class="px-4 py-3 font-medium">{{ $c->name }}</td>
            <td class="px-4 py-3 text-gray-600">{{ $c->slug }}</td>
            <td class="px-4 py-3">
              <span class="rounded-full px-2 py-0.5 text-xs {{ $c->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                {{ $c->is_active ? 'Yes' : 'No' }}
              </span>
            </td>
            <td class="px-4 py-3 text-right">
              <button
                class="mr-2 rounded bg-amber-500 px-3 py-1.5 text-white hover:bg-amber-600"
                data-edit
                data-update-url="{{ route('manage-work-categories.update',$c) }}"
                data-name='@json($c->name)'
                data-slug="{{ $c->slug }}"
                data-priority="{{ $c->priority }}"
                data-active="{{ $c->is_active ? 1 : 0 }}"
              >Edit</button>

              <form class="inline" action="{{ route('manage-work-categories.destroy',$c) }}" method="POST"
                    onsubmit="return confirm('Delete this category?')">
                @csrf @method('DELETE')
                <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="p-3">{{ $categories->links() }}</div>
    </div>
  </div>

  {{-- Create Modal --}}
  <div id="modalCreate" class="hidden fixed inset-0 z-50 bg-black/50">
    <div class="mx-auto mt-10 w-full max-w-xl rounded-2xl bg-white p-6">
      <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-semibold">Add Category</h2>
        <button class="text-gray-500" onclick="closeCreate()">✕</button>
      </div>

      <form method="POST" action="{{ route('manage-work-categories.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="">
            <label class="text-sm font-medium">Name</label>
            <input id="c_name" name="name" class="mt-1 w-full rounded border px-3 py-2" required>
          </div>
          <div>
            <label class="text-sm font-medium">Slug (optional)</label>
            <input id="c_slug" name="slug" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div class="flex items-center gap-2">
            <input id="c_active" type="checkbox" name="is_active" value="1" checked>
            <label for="c_active">Active</label>
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
    <div class="mx-auto mt-10 w-full max-w-xl rounded-2xl bg-white p-6">
      <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-semibold">Edit Category</h2>
        <button class="text-gray-500" onclick="closeEdit()">✕</button>
      </div>

      <form id="formEdit" method="POST">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="">
            <label class="text-sm font-medium">Name</label>
            <input id="e_name" name="name" class="mt-1 w-full rounded border px-3 py-2" required>
          </div>
          <div>
            <label class="text-sm font-medium">Slug</label>
            <input id="e_slug" name="slug" class="mt-1 w-full rounded border px-3 py-2">
          </div>

          <div class="flex items-center gap-2">
            <input id="e_active" type="checkbox" name="is_active" value="1">
            <label for="e_active">Active</label>
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

    const slugify = s => s.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-');
    const cName = document.getElementById('c_name');
    const cSlug = document.getElementById('c_slug');
    cName?.addEventListener('input', ()=>{ if(!cSlug.value) cSlug.value = slugify(cName.value); });

    document.querySelectorAll('[data-edit]').forEach(btn=>{
      btn.addEventListener('click', ()=>{
        formEdit.action = btn.dataset.updateUrl;
        document.getElementById('e_name').value     = JSON.parse(btn.dataset.name);
        document.getElementById('e_slug').value     = btn.dataset.slug || '';
        document.getElementById('e_active').checked = btn.dataset.active === '1';
        modalEdit.classList.remove('hidden');
      });
    });

    [modalCreate, modalEdit].forEach(m=>{
      m.addEventListener('click', e=>{ if(e.target===m) m.classList.add('hidden'); });
    });
  </script>
</x-admin-layout>
