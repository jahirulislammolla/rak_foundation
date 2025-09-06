<x-admin-layout>
  <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-6">
    <div class="mb-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Add Work</h1>
      <a href="{{ route('manage-works.index') }}" class="text-sm text-blue-600 hover:underline">← Back to list</a>
    </div>

    @if ($errors->any())
      <div class="mb-4 rounded-md bg-red-50 p-3 text-red-700">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ route('manage-works.store') }}"
          class="rounded-2xl border bg-white p-6">
      @csrf
      @include('admin.works._form', ['work' => $work, 'categories' => $categories])
      <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('manage-works.index') }}" class="rounded border px-4 py-2">Cancel</a>
        <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Save</button>
      </div>
    </form>
  </div>
</x-admin-layout>
