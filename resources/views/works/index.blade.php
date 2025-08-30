<x-app-layout>
  <div class="container mx-auto px-4 py-10">
    <div class="mb-8 flex flex-wrap items-center gap-3">
      <h2 class="text-3xl font-bold">Our Work</h2>
      <div class="ml-auto flex flex-wrap gap-2">
        <a href="{{ route('works.index') }}"
           class="rounded-full border px-3 py-1 text-sm {{ request('category') ? '' : 'bg-sky-100 text-sky-800' }}">
           All
        </a>
        @foreach($categories as $c)
          <a href="{{ route('works.index',['category'=>$c->slug]) }}"
             class="rounded-full border px-3 py-1 text-sm {{ (optional($cat)->id===$c->id) ? 'bg-sky-100 text-sky-800' : '' }}">
             {{ $c->name }}
          </a>
        @endforeach
      </div>
    </div>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      @foreach($works as $w)
        <article class="rounded-2xl overflow-hidden bg-white shadow hover:shadow-lg transition">
          <div class="relative">
            @if($w->image)
              <img src="{{ asset('storage/'.$w->image) }}" class="h-56 w-full object-cover" alt="{{ $w->title }}">
            @else
              <div class="h-56 w-full bg-gray-200"></div>
            @endif
            @if($w->category)
              <span class="absolute left-0 top-6 rounded-r-lg bg-sky-600 px-4 py-2 text-white text-sm font-medium">
                {{ $w->category->name }}
              </span>
            @endif
          </div>

          <div class="p-6 bg-sky-50">
            <div class="mb-3 flex items-center gap-6 text-slate-600 text-sm">
              @if($w->author_name)
                <span class="inline-flex items-center gap-1">
                  <svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5m0 2c-4 0-8 2-8 5v1h16v-1c0-3-4-5-8-5Z"/></svg>
                  {{ $w->author_name }}
                </span>
              @endif
              @if($w->published_at)
                <span class="inline-flex items-center gap-1">
                  <svg width="16" height="16" viewBox="0 0 24 24"><path d="M7 2v2H5a2 2 0 0 0-2 2v2h18V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2ZM3 10h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/></svg>
                  {{ $w->published_at->format('d M, Y') }}
                </span>
              @endif
            </div>

            <h3 class="mb-3 text-2xl font-bold">
              <a href="{{ route('works.show', $w->slug) }}" class="hover:text-sky-700">{{ $w->title }}</a>
            </h3>
            <p class="mb-4 text-slate-700 line-clamp-2">{{ $w->excerpt }}</p>

            <a href="{{ route('works.show', $w->slug) }}" class="inline-flex items-center gap-2 text-sky-700 font-medium">
              READ MORE
              <span aria-hidden>→</span>
            </a>
          </div>
        </article>
      @endforeach
    </div>

    <div class="mt-8">{{ $works->links() }}</div>
  </div>
</x-app-layout>
