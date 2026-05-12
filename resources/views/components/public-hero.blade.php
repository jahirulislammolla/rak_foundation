@props([
    'title',
    'subtitle' => null,
    'image' => null,
    'badge' => null,
    'quote' => null,
    'primaryText' => null,
    'primaryUrl' => null,
    'secondaryText' => null,
    'secondaryUrl' => null,
])

<section class="public-hero">
    <div class="site-container">
        <div class="public-hero__panel site-panel">
            <div class="public-hero__content">
                @if($badge)
                    <span class="site-eyebrow">{{ $badge }}</span>
                @endif

                <h1 class="site-title">{{ $title }}</h1>

                @if($subtitle)
                    <p class="site-subtitle mb-0">{{ $subtitle }}</p>
                @endif

                @if($primaryText || $secondaryText)
                    <div class="site-actions">
                        @if($primaryText && $primaryUrl)
                            <a href="{{ $primaryUrl }}" class="site-btn">{{ $primaryText }}</a>
                        @endif

                        @if($secondaryText && $secondaryUrl)
                            <a href="{{ $secondaryUrl }}" class="site-btn-outline">{{ $secondaryText }}</a>
                        @endif
                    </div>
                @endif
            </div>

            <div class="public-hero__media">
                <img src="{{ $image ? asset($image) : asset('img/background_home.jpg') }}" alt="{{ $title }}">

                @if($quote)
                    <div class="public-hero__quote">{{ $quote }}</div>
                @endif
            </div>
        </div>
    </div>
</section>
