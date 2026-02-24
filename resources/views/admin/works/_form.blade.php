@php
// $work (Work model) and $categories must be provided
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium">Title</label>
        <input name="title" id="title" class="mt-1 w-full rounded border px-3 py-2" value="{{ old('title', $work->title) }}" required>
        @error('title')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Slug (optional)</label>
        <input name="slug" id="slug" class="mt-1 w-full rounded border px-3 py-2" value="{{ old('slug', $work->slug) }}">
        @error('slug')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Category</label>
        <select name="work_category_id" class="mt-1 w-full rounded border px-3 py-2">
            <option value="">—</option>
            @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('work_category_id', $work->work_category_id)==$c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
        @error('work_category_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Author</label>
        <input name="author_name" class="mt-1 w-full rounded border px-3 py-2" value="{{ old('author_name', $work->author_name) }}">
        @error('author_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-medium">Excerpt (short)</label>
        <input name="excerpt" maxlength="300" class="mt-1 w-full rounded border px-3 py-2" value="{{ old('excerpt', $work->excerpt) }}">
        @error('excerpt')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-medium">Body</label>
        <textarea name="body" id="body" rows="8" class="mt-1 w-full rounded border px-3 py-2">{{ old('body', $work->body) }}</textarea>
        @error('body')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    @php
    $savedWidths = old('image_widths');
    $savedWidths = $savedWidths ? json_decode($savedWidths, true) : ($work->image_widths ?? []);
    @endphp
    <input type="hidden" name="image_widths" id="image_widths" value='@json($savedWidths)'>

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
        <input type="datetime-local" name="published_at" class="mt-1 w-full rounded border px-3 py-2" value="{{ old('published_at', optional($work->published_at)->format('Y-m-d\TH:i')) }}">
        @error('published_at')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>


    <div class="">
        <label class="text-sm font-medium mb-2">Status</label>
        <div class="w-full flex items-center gap-2 mt-2">
            <input id="is_active" type="checkbox" name="is_active" value="1" class="h-5 w-5" @checked(old('is_active', (int)($work->is_active ?? 1)))>
            <label for="is_active" class="text-xl cursor-pointer">Active</label>
        </div>
    </div>

</div>

{{-- Slug auto-generate when empty --}}
<script>
    (function() {
        const title = document.getElementById('title');
        const slug = document.getElementById('slug');
        const slugify = s => s.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-').replace(/-+/g, '-');
        if (title && slug) {
            title.addEventListener('input', () => {
                if (!slug.value) slug.value = slugify(title.value);
            });
        }
    })();

    // Simple base64 upload adapter (no server required).
    function Base64UploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return {
                upload: () => loader.file.then(file => new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = () => resolve({
                        default: reader.result
                    });
                    reader.onerror = err => reject(err);
                    reader.readAsDataURL(file);
                }))
            };
        };
    }

    // Allow overriding editor image styles from outside.
    function applyEditorImageCss(cssText) {
        const id = 'ck-editor-image-css';
        let style = document.getElementById(id);
        if (!style) {
            style = document.createElement('style');
            style.id = id;
            document.head.appendChild(style);
        }
        style.textContent = cssText;
    }

    // Default image styling inside editor body (override by setting window.CKEDITOR_IMAGE_CSS).
    applyEditorImageCss(window.CKEDITOR_IMAGE_CSS || '.ck-content .image img{width:100%;height:auto;}');
    // Optional: external JS can update later with window.setCkEditorImageCss('...')
    window.setCkEditorImageCss = applyEditorImageCss;
    const savedWidths = @json($savedWidths ? : []);

    function updateHiddenFromEditable(editable) {
        const widths = [];
        editable.querySelectorAll('img').forEach((img) => {
            const v = img.getAttribute('data-ck-width') || (img.style.width || '').replace('%', '').trim();
            widths.push(v ? parseInt(v, 10) : null);
        });
        const input = document.getElementById('image_widths');
        if (input) input.value = JSON.stringify(widths);
    }

    function applySavedWidths(editable, widths) {
        if (!Array.isArray(widths)) return;
        const imgs = editable.querySelectorAll('img');
        imgs.forEach((img, i) => {
            const v = widths[i];
            if (!v) return;
            img.style.width = v + '%';
            img.style.height = 'auto';
            img.style.maxWidth = v + '%';
            img.style.minWidth = v + '%';
            img.style.margin = '0';
            img.setAttribute('data-ck-width', String(v));
        });
    }

    ClassicEditor
        .create(document.querySelector('#body'), {
            // Enable image upload button; CDN build uses Base64UploadAdapter by default.
            toolbar: [
                'heading', '|'
                , 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|'
                , 'imageUpload', 'insertTable', 'undo', 'redo'
            ]
            , image: {
                toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
            }
            , extraPlugins: [Base64UploadAdapterPlugin]
        })
        .then(editor => {
            const control = document.createElement('div');
            control.id = 'ck-image-size-control';
            control.style.cssText = [
                'position:absolute'
                , 'z-index:9999'
                , 'display:none'
                , 'background:#fff'
                , 'border:1px solid #ddd'
                , 'border-radius:6px'
                , 'padding:6px 8px'
                , 'box-shadow:0 4px 12px rgba(0,0,0,.12)'
                , 'font-size:12px'
            ].join(';');

            control.innerHTML = `
            <button type="button" data-step="-10" style="padding:2px 6px;border:1px solid #ccc;border-radius:4px;">-</button>
            <span style="padding:0 6px;" id="ck-img-pct">100%</span>
            <button type="button" data-step="10" style="padding:2px 6px;border:1px solid #ccc;border-radius:4px;">+</button>
          `;
            document.body.appendChild(control);

            let activeImg = null;
            const pctLabel = control.querySelector('#ck-img-pct');
            const editableEl = editor.ui.view.editable.element;

            applySavedWidths(editableEl, savedWidths);
            updateHiddenFromEditable(editableEl);

            function getPct(img) {
                const v = (img.style.width || '').replace('%', '').trim();
                const n = parseInt(v, 10);
                return Number.isFinite(n) ? n : 100;
            }

            function setPct(img, pct) {
                const clamped = Math.max(10, Math.min(200, pct));
                img.style.width = clamped + '%';
                img.style.height = 'auto';
                img.style.maxWidth = clamped + '%';
                img.style.minWidth = clamped + '%';
                img.style.margin = '0';
                img.setAttribute('data-ck-width', String(clamped));
                pctLabel.textContent = clamped + '%';
                updateHiddenFromEditable(editor.ui.view.editable.element);
            }

            function showControl(img) {
                const rect = img.getBoundingClientRect();
                activeImg = img;
                pctLabel.textContent = getPct(img) + '%';
                control.style.left = (window.scrollX + rect.left) + 'px';
                control.style.top = (window.scrollY + rect.top - 36) + 'px';
                control.style.display = 'block';
            }

            function hideControl() {
                activeImg = null;
                control.style.display = 'none';
            }

            control.addEventListener('click', (e) => {
                const step = e.target && e.target.getAttribute('data-step');
                if (!step || !activeImg) return;
                setPct(activeImg, getPct(activeImg) + parseInt(step, 10));
            });

            editor.ui.view.editable.element.addEventListener('click', (e) => {
                const img = e.target.closest('img');
                if (!img) return hideControl();
                showControl(img);
            });

            document.addEventListener('click', (e) => {
                if (control.contains(e.target)) return;
                if (editor.ui.view.editable.element.contains(e.target)) return;
                hideControl();
            });

            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', () => {
                    const editable = editor.ui.view.editable.element;
                    if (editable) {
                        editable.querySelectorAll('img').forEach((img) => {
                            const v = (img.style.width || '').replace('%', '').trim();
                            if (v) img.setAttribute('data-ck-width', v);
                        });
                        updateHiddenFromEditable(editable);
                        document.querySelector('#body').value = editable.innerHTML;
                    }
                });
            }
        })
        .catch(error => {
            console.error(error);
        });

</script>
