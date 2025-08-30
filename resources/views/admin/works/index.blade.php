<x-admin-layout>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <h1 class="text-2xl font-bold">Works / News</h1>
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
            <th class="px-4 py-3 text-left text-sm font-semibold">Title</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Category</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Published</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y">
        @foreach($works as $w)
          <tr>
            <td class="px-4 py-3">{{ $w->priority }}</td>
            <td class="px-4 py-3">
              <div class="font-medium">{{ $w->title }}</div>
              <div class="text-xs text-gray-500 line-clamp-1">{{ $w->excerpt }}</div>
            </td>
            <td class="px-4 py-3">{{ optional($w->category)->name ?: '—' }}</td>
            <td class="px-4 py-3">
              @if($w->published_at)
                <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs text-green-700">
                  {{ $w->published_at->format('d M Y') }}
                </span>
              @else
                <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-600">Draft</span>
              @endif
            </td>
            <td class="px-4 py-3 text-right">
              <button
                class="mr-2 rounded bg-amber-500 px-3 py-1.5 text-white hover:bg-amber-600"
                data-edit
                data-update-url="{{ route('admin.works.update', $w) }}"
                data-title='@json($w->title)'
                data-slug="{{ $w->slug }}"
                data-cat="{{ $w->work_category_id }}"
                data-author='@json($w->author_name)'
                data-excerpt='@json($w->excerpt)'
                data-body='@json($w->body)'
                data-published="{{ optional($w->published_at)->format('Y-m-d\TH:i') }}"
                data-priority="{{ $w->priority }}"
                data-active="{{ $w->is_active ? 1 : 0 }}"
                data-image-url="{{ $w->image ? asset('storage/'.$w->image) : '' }}"
              >Edit</button>

              <form class="inline" action="{{ route('admin.works.destroy', $w) }}" method="POST"
                    onsubmit="return confirm('Delete this item?')">
                @csrf @method('DELETE')
                <button class="rounded bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="p-3">{{ $works->links() }}</div>
    </div>
  </div>

  {{-- Create Modal --}}
  <div id="modalCreate" class="hidden fixed inset-0 z-50 bg-black/50">
    <div class="mx-auto mt-10 w-full max-w-4xl rounded-2xl bg-white p-6">
      <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-semibold">Add Work</h2>
        <button class="text-gray-500" onclick="closeCreate()">✕</button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="{{ route('admin.works.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="text-sm font-medium">Title</label>
            <input name="title" id="c_title" class="mt-1 w-full rounded border px-3 py-2" required>
          </div>
          <div>
            <label class="text-sm font-medium">Slug (optional)</label>
            <input name="slug" id="c_slug" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div>
            <label class="text-sm font-medium">Category</label>
            <select name="work_category_id" class="mt-1 w-full rounded border px-3 py-2">
              <option value="">—</option>
              @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="text-sm font-medium">Author</label>
            <input name="author_name" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div class="md:col-span-2">
            <label class="text-sm font-medium">Excerpt (short)</label>
            <input name="excerpt" maxlength="300" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div class="md:col-span-2">
            <label class="text-sm font-medium">Body</label>
            <textarea name="body" rows="8" class="mt-1 w-full rounded border px-3 py-2"></textarea>
          </div>
          <div>
            <label class="text-sm font-medium">Image</label>
            <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div>
            <label class="text-sm font-medium">Published at</label>
            <input type="datetime-local" name="published_at" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div>
            <label class="text-sm font-medium">Priority</label>
            <input type="number" name="priority" value="0" class="mt-1 w-full rounded border px-3 py-2">
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
    <div class="mx-auto mt-10 w-full max-w-4xl rounded-2xl bg-white p-6">
      <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-semibold">Edit Work</h2>
        <button class="text-gray-500" onclick="closeEdit()">✕</button>
      </div>

      <form id="formEdit" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="text-sm font-medium">Title</label>
            <input id="e_title" name="title" class="mt-1 w-full rounded border px-3 py-2" required>
          </div>
          <div>
            <label class="text-sm font-medium">Slug</label>
            <input id="e_slug" name="slug" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div>
            <label class="text-sm font-medium">Category</label>
            <select id="e_cat" name="work_category_id" class="mt-1 w-full rounded border px-3 py-2">
              <option value="">—</option>
              @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="text-sm font-medium">Author</label>
            <input id="e_author" name="author_name" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div class="md:col-span-2">
            <label class="text-sm font-medium">Excerpt</label>
            <input id="e_excerpt" name="excerpt" maxlength="300" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div class="md:col-span-2">
            <label class="text-sm font-medium">Body</label>
            <textarea id="e_body" name="body" rows="8" class="mt-1 w-full rounded border px-3 py-2"></textarea>
          </div>
          <div>
            <label class="text-sm font-medium">Replace image</label>
            <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div>
            <label class="text-sm font-medium block">Current image</label>
            <img id="e_preview" src="" class="h-16 w-16 rounded object-cover border" alt="">
          </div>
          <div>
            <label class="text-sm font-medium">Published at</label>
            <input id="e_published" type="datetime-local" name="published_at" class="mt-1 w-full rounded border px-3 py-2">
          </div>
          <div>
            <label class="text-sm font-medium">Priority</label>
            <input id="e_priority" type="number" name="priority" class="mt-1 w-full rounded border px-3 py-2">
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

    const cTitle = document.getElementById('c_title');
    const cSlug  = document.getElementById('c_slug');
    const slugify = s => s.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-');
    cTitle?.addEventListener('input', ()=>{ if(!cSlug.value) cSlug.value = slugify(cTitle.value); });

    document.querySelectorAll('[data-edit]').forEach(btn=>{
      btn.addEventListener('click', ()=>{
        formEdit.action = btn.dataset.updateUrl;
        document.getElementById('e_title').value     = JSON.parse(btn.dataset.title);
        document.getElementById('e_slug').value      = btn.dataset.slug || '';
        document.getElementById('e_cat').value       = btn.dataset.cat || '';
        document.getElementById('e_author').value    = JSON.parse(btn.dataset.author || '""');
        document.getElementById('e_excerpt').value   = JSON.parse(btn.dataset.excerpt || '""');
        document.getElementById('e_body').value      = JSON.parse(btn.dataset.body || '""');
        document.getElementById('e_published').value = btn.dataset.published || '';
        document.getElementById('e_priority').value  = btn.dataset.priority || 0;
        document.getElementById('e_active').checked  = btn.dataset.active === '1';

        const img = document.getElementById('e_preview');
        img.src = btn.dataset.imageUrl || '';
        modalEdit.classList.remove('hidden');
      });
    });

    [modalCreate, modalEdit].forEach(m=>{
      m.addEventListener('click', e=>{ if(e.target===m) m.classList.add('hidden'); });
    });
  </script>
</x-admin-layout>
