@props([
    'page',                 // e.g. "home", "member", "committee"
    'key',                  // e.g. "join_us", "apply_membership"
    'fallbackText' => null, // optional fallback text if config missing/disabled
    'fallbackUrl'  => '#',  // optional fallback url
    'id' => null,           // optional custom id (else auto-generated)
])

@php
    use Illuminate\Support\Str;

    $cfg = function_exists('button_cfg') ? button_cfg($page, $key) : null;

@endphp

@if($cfg && ($cfg['enabled'] ?? false))
    @php
        $text     = $cfg['text'] ?? $fallbackText ?? 'Click';
        $url      = $cfg['url']  ?? $fallbackUrl;

        $style    = $cfg['style'] ?? [];
        $color    = $style['color'] ?? '#ffffff';
        $bg       = $style['bg'] ?? '#0ea5e9';
        $hColor   = $style['hover_color'] ?? $color;
        $hBg      = $style['hover_bg'] ?? '#0c4a6e';
        $bColor   = $style['border_color'] ?? $bg;
        $hBCol    = $style['hover_border_color'] ?? $hBg;

        $size     = $cfg['size'] ?? 'md';         // sm|md|lg
        $rounded  = $cfg['rounded'] ?? 'md';      // none|sm|md|lg|full
        $outline  = (bool)($cfg['outline'] ?? false);
        $pill     = (bool)($cfg['pill'] ?? false);
        $full     = (bool)($cfg['full_width'] ?? false);
        $icon     = $cfg['icon'] ?? null;         // { position, html }
        $attrs    = (isset($cfg['attrs']) && is_array($cfg['attrs'])) ? $cfg['attrs'] : [];

        $padY = $size === 'sm' ? '0.375rem' : ($size === 'lg' ? '0.75rem' : '0.5rem');
        $padX = $size === 'sm' ? '0.75rem'  : ($size === 'lg' ? '1.25rem' : '1rem');

        $radiusMap = ['none'=>'0','sm'=>'0.125rem','md'=>'0.375rem','lg'=>'0.5rem','full'=>'9999px'];
        $radius = $radiusMap[$rounded] ?? '0.375rem';
        if ($pill) $radius = '9999px';

        // outline হলে bg transparent
        $initBg   = $outline ? 'transparent' : $bg;
        $initCol  = $outline ? $bColor : $color;
        $initBCol = $bColor;

        // unique id + class
        $btnId    = $id ?: ('btn_'.Str::slug($page.'_'.$key).'_'.uniqid());
        $btnClass = 'dynbtn_'.Str::slug($page.'_'.$key).'_'.substr(uniqid('', true), -6);
    @endphp

    <style>
    .{{ $btnClass }}{
        display:inline-flex; align-items:center; gap:.5rem;
        padding: {{ $padY }} {{ $padX }};
        border:1px solid {{ $initBCol }};
        border-radius: {{ $radius }};
        background: {{ $initBg }};
        color: {{ $initCol }};
        text-decoration: none;
        transition: background .2s ease-in-out, color .2s ease-in-out, border-color .2s ease-in-out, transform .2s ease-in-out;
        {{ $full ? 'width:100%; justify-content:center; display:flex;' : '' }}
        cursor:pointer;
        line-height: 1.2;
        font-weight: 500;
        -webkit-tap-highlight-color: transparent;
    }
    .{{ $btnClass }}:hover{
        background: {{ $hBg }};
        color: {{ $hColor }};
        border-color: {{ $hBCol }};
        text-decoration: none;
    }
    .{{ $btnClass }}[aria-disabled="true"]{
        opacity:.6; pointer-events:none;
    }
    </style>

    <a id="{{ $btnId }}"
       href="{{ $url }}"
       class="{{ $btnClass }}"
       @if(($cfg['target_blank'] ?? false)) target="_blank" @endif
       @if(($cfg['rel_nofollow'] ?? false)) rel="nofollow" @endif
       @foreach($attrs as $attr => $val)
           {{ $attr }}="{{ $val }}"
       @endforeach
    >
        @if($icon && (($icon['position'] ?? '') === 'left'))
            {!! $icon['html'] ?? '' !!}
        @endif
        <span>{{ $text }}</span>
        @if($icon && (($icon['position'] ?? '') === 'right'))
            {!! $icon['html'] ?? '' !!}
        @endif
    </a>

@elseif($fallbackText)
    @php
        $fbId    = 'btn_fallback_'.Str::slug($page.'_'.$key).'_'.uniqid();
        $fbClass = 'dynbtn_fallback_'.Str::slug($page.'_'.$key).'_'.substr(uniqid('', true), -6);
    @endphp
    <style>
    .{{ $fbClass }}{
        display:inline-flex; align-items:center; gap:.5rem;
        padding:.5rem 1rem;
        border:1px solid transparent;
        border-radius:.375rem;
        background:#0284c7;
        color:#ffffff; text-decoration:none;
        transition: background .2s ease-in-out;
        cursor:pointer; line-height:1.2; font-weight:500;
    }
    .{{ $fbClass }}:hover{ background:#0369a1; }
    </style>
    <a id="{{ $fbId }}" href="{{ $fallbackUrl }}" class="{{ $fbClass }}"><span>{{ $fallbackText }}</span></a>
@endif
