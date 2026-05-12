<x-app-layout>
    <x-public-hero
        badge="Focus Area Detail"
        title="{{ $item->title }}"
        subtitle="{{ $item->short_description ?: 'Detailed information about this program area will guide members, donors, and partners.' }}"
        image="{{ $item->image ?: ($settings['our_focus_area_image'] ?? 'img/committee.png') }}"
        quote="Good detail pages explain both the problem and the organization’s response."
        primary-text="All Focus Areas"
        primary-url="{{ route('focus-areas.show') }}"
        secondary-text="Support This Mission"
        secondary-url="{{ route('donate.form') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="public-card rich-copy">
                @if($item->description)
                    {!! $item->description !!}
                @else
                    <p class="mb-0">Details for this focus area will be published soon.</p>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
