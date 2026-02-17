@php
  // $work (Work model) and $categories must be provided
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div>
    <label class="text-sm font-medium">Title</label>
    <input name="title" id="title" class="mt-1 w-full rounded border px-3 py-2"
           value="{{ old('title', $work->title) }}" required>
    @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="text-sm font-medium">Slug (optional)</label>
    <input name="slug" id="slug" class="mt-1 w-full rounded border px-3 py-2"
           value="{{ old('slug', $work->slug) }}">
    @error('slug')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="text-sm font-medium">Category</label>
    <select name="work_category_id" class="mt-1 w-full rounded border px-3 py-2">
      <option value="">—</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}"
          @selected(old('work_category_id', $work->work_category_id)==$c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
    @error('work_category_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="text-sm font-medium">Author</label>
    <input name="author_name" class="mt-1 w-full rounded border px-3 py-2"
           value="{{ old('author_name', $work->author_name) }}">
    @error('author_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div class="md:col-span-2">
    <label class="text-sm font-medium">Excerpt (short)</label>
    <input name="excerpt" maxlength="300" class="mt-1 w-full rounded border px-3 py-2"
           value="{{ old('excerpt', $work->excerpt) }}">
    @error('excerpt')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div class="md:col-span-2">
    <label class="text-sm font-medium">Body</label>
    <textarea name="body" id="body" rows="8" class="mt-1 w-full rounded border px-3 py-2">{{ old('body', $work->body) }}</textarea>
    @error('body')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="text-sm font-medium">Image</label>
    <input type="file" name="image" accept="image/*" class="mt-1 w-full rounded border px-3 py-2">
    @error('image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  @if($work->image)
  <div>
    <label class="text-sm font-medium block">Current image</label>
    <img src="{{ asset($work->image) }}" class="h-44 w-44 rounded object-cover border" alt="">
  </div>
  @endif

  <div>
    <label class="text-sm font-medium">Published at</label>
    <input type="datetime-local" name="published_at" class="mt-1 w-full rounded border px-3 py-2"
           value="{{ old('published_at', optional($work->published_at)->format('Y-m-d\TH:i')) }}">
    @error('published_at')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>


  <div class="">
    <label class="text-sm font-medium mb-2">Status</label>
    <div class="w-full flex items-center gap-2 mt-2">
        <input id="is_active" type="checkbox" name="is_active" value="1" class="h-5 w-5"
          @checked(old('is_active', (int)($work->is_active ?? 1)))>
        <label for="is_active" class="text-xl cursor-pointer">Active</label>
    </div>
  </div>
  
</div>

{{-- Slug auto-generate when empty --}}
<script>
  (function(){
    const title = document.getElementById('title');
    const slug  = document.getElementById('slug');
    const slugify = s => s.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-');
    if(title && slug){
      title.addEventListener('input', ()=>{
        if(!slug.value) slug.value = slugify(title.value);
      });
    }
  })();

    // Simple base64 upload adapter (no server required).
    function Base64UploadAdapterPlugin( editor ) {
      editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        return {
          upload: () => loader.file.then( file => new Promise( ( resolve, reject ) => {
            const reader = new FileReader();
            reader.onload = () => resolve( { default: reader.result } );
            reader.onerror = err => reject( err );
            reader.readAsDataURL( file );
          } ) )
        };
      };
    }

    ClassicEditor
        .create(document.querySelector('#body'), {
          // Enable image upload button; CDN build uses Base64UploadAdapter by default.
          toolbar: [
            'heading', '|',
            'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
            'imageUpload', 'insertTable', 'undo', 'redo'
          ],
          image: {
            toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
          },
          extraPlugins: [ Base64UploadAdapterPlugin ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
