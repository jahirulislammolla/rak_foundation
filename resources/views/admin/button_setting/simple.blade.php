{{-- resources/views/admin/button_setting/simple.blade.php --}}
<x-admin-layout>
    <style>
  /* base look (works in all modern browsers) */
  .range-alpha{
    appearance: none;
    height: 10px;
    border-radius: 9999px;
    background:
      linear-gradient(to right, var(--col-1, #4d7dc5) 0, var(--col-1, #fd550d) calc(var(--val,100)*1%),
                                 #338d09 calc(var(--val,100)*1%), #0844bc 100%);
    outline: none;
  }

  /* webkit track/thumb (Chrome/Edge/Safari) */
  .range-alpha::-webkit-slider-runnable-track{
    height: 10px; border-radius: 9999px;
    background:
       linear-gradient(to right, var(--col-1, #4d7dc5) 0, var(--col-1, #fd550d) calc(var(--val,100)*1%),
                                 #338d09 calc(var(--val,100)*1%), #0844bc 100%);
  }
  .range-alpha::-webkit-slider-thumb{
    appearance: none;
    width: 18px; height: 18px; border-radius: 9999px;
    background: var(--col-1, #0d6efd);
    border: 2px solid #fff;
    box-shadow: 0 0 0 1px rgba(0,0,0,.08);
    margin-top: -4px; /* centers on 10px track */
    cursor: pointer;
  }

  /* firefox track/progress/thumb */
  .range-alpha::-moz-range-track{
    height: 10px; border-radius: 9999px; background: #e5e7eb;
  }
  .range-alpha::-moz-range-progress{
    height: 10px; border-radius: 9999px; background: var(--col-1, #0d6efd);
  }
  .range-alpha::-moz-range-thumb{
    width: 18px; height: 18px; border-radius: 9999px;
    background: var(--col-1, #0d6efd);
    border: 2px solid #fff;
    box-shadow: 0 0 0 1px rgba(0,0,0,.08);
    cursor: pointer;
  }
</style>

  <div class="mx-auto max-w-6xl p-6">
    {{-- Alerts --}}
    @if(session('success'))
      <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-700">
        <ul class="list-disc ps-5">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('settings.buttons.simple.store') }}" class="space-y-8">
      @csrf

      @foreach($buttonList as $page => $btns)
        <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm">
          <div class="flex items-center justify-between border-b border-zinc-100 px-6 py-4">
            <h2 class="text-lg font-semibold tracking-tight">
              <span class="inline-flex h-6 items-center rounded-md bg-zinc-100 px-2 text-sm font-medium text-zinc-700">{{ ucfirst($page) }}</span>
              <span class="ms-2 text-zinc-800">Button Settings</span>
            </h2>
            <p class="text-sm text-zinc-500">Edit only: Text &amp; Colors (Hex/RGBA)</p>
          </div>

          <div class="divide-y divide-zinc-100">
            @foreach($btns as $key => $label)
              @php $v = $values[$page][$key] ?? null; @endphp
              <section class="px-6 py-6">
                <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                  <div>
                    <h3 class="text-base font-semibold text-zinc-800">{{ $label }}</h3>
                    <p class="mt-1 text-sm text-zinc-500">
                      <span class="me-2">page:<code class="rounded bg-zinc-100 px-1 py-0.5 text-[12px]">{{ $page }}</code></span>
                      key:<code class="rounded bg-zinc-100 px-1 py-0.5 text-[12px]">{{ $key }}</code>
                    </p>
                  </div>
                  {{-- Quick BG preview chip --}}
                  <span class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-zinc-50 px-3 py-1 text-xs text-zinc-600">
                    <span class="h-3 w-3 rounded-full" style="background: {{ $v['style']['bg'] ?? '#0d6efd' }};"></span>
                    BG preview
                  </span>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                  {{-- Text --}}
                  <div class="col-span-1">
                    <label class="mb-1.5 block text-sm font-medium text-zinc-700">Button Text</label>
                    <input
                      type="text"
                      name="buttons[{{ $page }}][{{ $key }}][text]"
                      value="{{ $v['text'] ?? '' }}"
                      placeholder="e.g. Donate Now"
                      class="w-full rounded-xl border border-zinc-200 bg-white px-4 py-2.5 text-zinc-900 outline-none ring-zinc-200 transition focus:border-zinc-300 focus:ring-4"
                    />
                    <p class="mt-1.5 text-xs text-zinc-500">Visible label on the button</p>
                  </div>

                  {{-- color fields (picker + alpha + synced value) --}}
                  @php
                    $fields = [
                      ['label' => 'Text Color',            'name' => 'color',              'val' => $v['style']['color'] ?? '#ffffff'],
                      ['label' => 'Background',            'name' => 'bg',                 'val' => $v['style']['bg'] ?? '#0d6efd'],
                      ['label' => 'Hover: Text Color',     'name' => 'hover_color',        'val' => $v['style']['hover_color'] ?? '#ffffff'],
                      ['label' => 'Hover: Background',     'name' => 'hover_bg',           'val' => $v['style']['hover_bg'] ?? '#0b5ed7'],
                      ['label' => 'Border Color',          'name' => 'border_color',       'val' => $v['style']['border_color'] ?? '#0d6efd'],
                      ['label' => 'Hover: Border Color',   'name' => 'hover_border_color', 'val' => $v['style']['hover_border_color'] ?? '#0b5ed7'],
                    ];
                  @endphp

                  @foreach($fields as $f)
                    <div class="col-span-1">
                      <label class="mb-1.5 block text-sm font-medium text-zinc-700">{{ $f['label'] }}</label>

                      <div
                        class="color-field flex flex-col gap-3 rounded-xl border border-zinc-200 p-3"
                        data-initial="{{ $f['val'] }}"
                      >
                        <div class="flex items-center gap-3">
                          {{-- Native color picker (hex only) --}}
                          <input type="color"
                                 class="h-10 w-12 cursor-pointer rounded border border-zinc-200 bg-white"
                                 data-role="picker" value="#000000" />

                          {{-- Alpha slider (0–100) --}}
                          <div class="flex-1">
                            <div class="flex items-center gap-3">
                              <input type="range" min="0" max="100" step="1"
                                     class="range-alpha w-full"
                                     data-role="alpha" value="100" />
                              <span class="w-10 text-right text-xs text-zinc-600" data-role="alphaLabel">100%</span>
                            </div>
                            <p class="mt-1 text-[11px] text-zinc-500">Opacity (0–100%). 100% হলে Hex, নাহলে RGBA সংরক্ষিত হবে।</p>
                          </div>
                        </div>

                        {{-- Saved value (this is what gets submitted) --}}
                        <div>
                          <label class="mb-1 block text-xs font-medium text-zinc-600">Saved value</label>
                          <input type="text"
                                 name="buttons[{{ $page }}][{{ $key }}][style][{{ $f['name'] }}]"
                                 class="w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm outline-none ring-zinc-200 transition focus:border-zinc-300 focus:ring-4"
                                 data-role="value"
                                 value="{{ $f['val'] }}" />
                          <p class="mt-1 text-[11px] text-zinc-500">Hex (#rrggbb) বা rgba(r,g,b,a) — দুটোই সাপোর্টেড।</p>
                        </div>

                        {{-- Swatch preview --}}
                        <div class="flex items-center gap-2">
                          <span class="inline-block h-6 w-6 rounded border border-zinc-200" data-role="swatch"></span>
                          <span class="text-xs text-zinc-600" data-role="readable"></span>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>

                {{-- Mini live preview (approximate) --}}
                @php
                  $txt   = $v['text'] ?? 'Preview';
                  $c     = $v['style']['color'] ?? '#ffffff';
                  $bg    = $v['style']['bg'] ?? '#0d6efd';
                  $bcol  = $v['style']['border_color'] ?? ($v['style']['bg'] ?? '#0d6efd');
                @endphp
                <div class="mt-6">
                  <span
                    class="inline-flex items-center gap-2 rounded-sm px-4 py-2 text-sm font-medium shadow-sm"
                    style="color: {{ $c }}; background: {{ $bg }}; border: 1px solid {{ $bcol }};"
                  >
                    {{ $txt }}
                  </span>
                  <p class="mt-2 text-xs text-zinc-500">Preview (hover styles save করার পর ফ্রন্টএন্ডে কাজ করবে)</p>
                </div>
              </section>
            @endforeach
          </div>
        </div>
      @endforeach

      {{-- Actions --}}
      <div class="sticky bottom-6 z-10 mt-8 flex items-center justify-end gap-3">
        <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
          Cancel
        </a>
        <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-black/90 focus:outline-none">
          Save Buttons
        </button>
      </div>
    </form>
  </div>

  {{-- Tiny, dependency-free color sync script --}}
  <script>
    (function () {
      /** helpers **/
      const clamp = (n, min, max) => Math.min(Math.max(n, min), max);
      const hexToRgb = (hex) => {
        let h = hex.replace('#','').trim();
        if (h.length === 3) h = h.split('').map(c => c + c).join('');
        const int = parseInt(h, 16);
        return { r: (int >> 16) & 255, g: (int >> 8) & 255, b: int & 255 };
      };
      const rgbToHex = (r,g,b) => '#' + [r,g,b].map(v => v.toString(16).padStart(2,'0')).join('');
      const parseColorString = (str, fallbackHex = '#000000') => {
        if (!str) return { hex: fallbackHex, a: 1 };
        str = String(str).trim();
        // hex
        if (str[0] === '#') {
          const hex = str.length === 4 || str.length === 7 ? str : fallbackHex;
          return { hex, a: 1 };
        }
        // rgba(r,g,b,a)
        const m = str.match(/rgba?\s*\(\s*([\d.]+)\s*,\s*([\d.]+)\s*,\s*([\d.]+)(?:\s*,\s*([\d.]+))?\s*\)/i);
        if (m) {
          const r = clamp(parseInt(m[1],10), 0, 255);
          const g = clamp(parseInt(m[2],10), 0, 255);
          const b = clamp(parseInt(m[3],10), 0, 255);
          const a = m[4] !== undefined ? clamp(parseFloat(m[4]), 0, 1) : 1;
          return { hex: rgbToHex(r,g,b), a };
        }
        // fallback
        return { hex: fallbackHex, a: 1 };
      };
      const composeValue = (hex, a) => {
        if (a >= 0.999) return hex; // pure hex when 100%
        const { r,g,b } = hexToRgb(hex);
        return `rgba(${r}, ${g}, ${b}, ${(+a.toFixed(2))})`;
      };
      const readable = (hex, a) => `${hex.toUpperCase()} @ ${Math.round(a*100)}%`;

      /** wire up all color-field blocks **/
      document.querySelectorAll('.color-field').forEach(block => {
        const picker = block.querySelector('[data-role="picker"]');
        const alpha  = block.querySelector('[data-role="alpha"]');
        const alphaLabel = block.querySelector('[data-role="alphaLabel"]');
        const value  = block.querySelector('[data-role="value"]');
        const swatch = block.querySelector('[data-role="swatch"]');
        const read   = block.querySelector('[data-role="readable"]');

        // init from server value
        const initial = block.getAttribute('data-initial') || value.value || '#000000';
        const parsed  = parseColorString(initial, '#000000');
        picker.value  = parsed.hex;
        alpha.value   = Math.round(parsed.a * 100);
        alphaLabel.textContent = `${alpha.value}%`;
        value.value  = composeValue(picker.value, parsed.a);
        swatch.style.background = value.value;
        read.textContent = readable(picker.value, parsed.a);

        // on picker change
        picker.addEventListener('input', () => {
          const a = clamp(alpha.value / 100, 0, 1);
          value.value = composeValue(picker.value, a);
          swatch.style.background = value.value;
          read.textContent = readable(picker.value, a);
        });
        // on alpha change
        alpha.addEventListener('input', () => {
          const a = clamp(alpha.value / 100, 0, 1);
          alphaLabel.textContent = `${alpha.value}%`;
          value.value = composeValue(picker.value, a);
          swatch.style.background = value.value;
          read.textContent = readable(picker.value, a);
        });
        // when user types manually in text box (hex or rgba)
        value.addEventListener('input', () => {
          const p = parseColorString(value.value, picker.value);
          picker.value = p.hex;
          alpha.value = Math.round(p.a * 100);
          alphaLabel.textContent = `${alpha.value}%`;
          swatch.style.background = composeValue(picker.value, p.a);
          read.textContent = readable(picker.value, p.a);
        });
      });
    })();
  </script>
</x-admin-layout>
