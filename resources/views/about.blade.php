<x-app-layout>
    <x-public-hero
        badge="About the Organization"
        title="A mission-led organization built for credible social change."
        subtitle="{{ \Illuminate\Support\Str::limit(strip_tags($settings['about_page_description'] ?? 'We combine community trust, structured planning, and transparent communication to move social initiatives from intention to implementation.'), 220) }}"
        image="{{ $settings['about_image'] ?? 'img/aboutus.png' }}"
        quote="Strong social organizations are measured by consistency, not slogans."
        primary-text="View Our Work"
        primary-url="{{ route('works.index') }}"
        secondary-text="Contact Team"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="surface-split">
                <div class="public-card copy-stack">
                    <div class="section-heading mb-0">
                        <span class="site-eyebrow">Our Story</span>
                        <h2>Purpose, governance, and practical community engagement.</h2>
                    </div>
                    <div class="rich-copy">
                        {!! $settings['about_page_description'] ?? '<p>We exist to connect people, resources, and field priorities so that community initiatives are not only announced but actually delivered.</p>' !!}
                    </div>
                </div>

                <div class="public-card p-0 overflow-hidden">
                    <div class="gallery-card__media h-100">
                        <img src="{{ asset('img/about.jpg') }}" alt="About us" style="height:100%; min-height:460px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section-tight">
        <div class="site-container">
            <div class="site-grid grid-3">
                <div class="public-card feature-card content-stack">
                    <span class="icon-wrap"><i class="bi bi-bullseye"></i></span>
                    <h3>Mission Precision</h3>
                    <p class="mb-0">We focus on targeted community needs instead of generic charity messaging.</p>
                </div>
                <div class="public-card feature-card content-stack">
                    <span class="icon-wrap"><i class="bi bi-diagram-3"></i></span>
                    <h3>Organized Execution</h3>
                    <p class="mb-0">Programs, committees, members, events, and public work are tied together into one operational structure.</p>
                </div>
                <div class="public-card feature-card content-stack">
                    <span class="icon-wrap"><i class="bi bi-shield-check"></i></span>
                    <h3>Public Trust</h3>
                    <p class="mb-0">A clearer public presence helps donors, partners, and beneficiaries understand what the organization actually does.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
