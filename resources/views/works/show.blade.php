<x-app-layout>
  <div class="container mx-auto px-4 py-10 max-w-5xl">
    <div class="mb-6">
      <a href="{{ url()->previous() ?: route('works.index') }}" class="text-sky-600 underline">← Back</a>
    </div>

    @if($work->category)
      <span class="inline-block rounded-full bg-sky-100 px-3 py-1 text-sky-800 text-sm mb-3">
        {{ $work->category->name }}
      </span>
    @endif

    <h1 class="text-3xl font-bold mb-3">{{ $work->title }}</h1>

    <div class="mb-6 text-slate-600">
      @if($work->author_name) <span>By {{ $work->author_name }}</span> @endif
      @if($work->published_at) <span class="ml-3">{{ $work->published_at->format('d M, Y') }}</span> @endif
    </div>

    @if($work->image)
      <img src="{{ asset('storage/'.$work->image) }}" class="mb-6 w-full rounded-xl object-cover" alt="{{ $work->title }}">
    @endif

    <div class="prose max-w-none">
      {!! nl2br(e($work->body)) !!}
    </div>
  </div>
</x-app-layout>
