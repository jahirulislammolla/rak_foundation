@php
    $orgName = $settings['page_top_title'] ?? 'Social Organization';
    $socials = [
        ['icon' => 'facebook-f', 'url' => $settings['facebook'] ?? null],
        ['icon' => 'twitter', 'url' => $settings['twitter'] ?? null],
        ['icon' => 'linkedin-in', 'url' => $settings['linkedin'] ?? null],
        ['icon' => 'instagram', 'url' => $settings['instagram'] ?? null],
    ];
@endphp

<footer class="site-footer">
    <div>
        <div class="site-footer__panel site-panel">
            <div class="site-footer__grid">
                <div class="copy-stack">
                    <div class="site-brand">
                        <img class="site-brand__logo" src="{{ asset($settings['footer_image'] ?? $settings['logo_image'] ?? 'img/logo_top.png') }}" alt="{{ $orgName }}">
                        <div class="site-brand__text">
                            <strong>{{ $orgName }}</strong>
                            <span>Building stronger lives through service, inclusion, and advocacy.</span>
                        </div>
                    </div>

                    <div class="rich-copy">
                        {!! $settings['home_page_footer_description'] ?? '<p>We connect donors, members, volunteers, and communities through meaningful social programs.</p>' !!}
                    </div>

                    <div class="footer-socials">
                        @foreach($socials as $social)
                            @if(!empty($social['url']))
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-{{ $social['icon'] }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="copy-stack">
                    <h3 class="mb-0">Navigation</h3>
                    <div class="footer-links">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ url('/about') }}">About</a>
                        <a href="{{ route('focus-areas.show') }}">Focus Areas</a>
                        <a href="{{ route('works.index') }}">Our Work</a>
                        <a href="{{ url('/events') }}">Events</a>
                        <a href="{{ route('members.index') }}">Members</a>
                        <a href="{{ route('impact.index') }}">Impact Dashboard</a>
                        <a href="{{ route('news.index') }}">News & Updates</a>
                        <a href="{{ route('annual-report.index') }}">Annual Reports</a>
                    </div>
                </div>

                <div class="copy-stack">
                    <h3 class="mb-0">Contact</h3>
                    <div class="footer-links">
                        <span>{{ $settings['contact_address'] ?? 'Address not set' }}</span>
                        <a href="mailto:{{ $settings['contact_email'] ?? '' }}">{{ $settings['contact_email'] ?? 'Email not set' }}</a>
                        <a href="tel:{{ $settings['contact_telephone'] ?? '' }}">{{ $settings['contact_telephone'] ?? 'Phone not set' }}</a>
                        <a href="{{ url('/contact') }}">Send a message</a>
                        <a href="{{ route('donate.form') }}">Support a cause</a>
                    </div>
                    <div class="footer-cta">
                        <strong>Ready to help?</strong>
                        <p class="mb-3">Donate, volunteer, or introduce a community need.</p>
                        <div class="site-actions">
                            <a href="{{ route('donate.form') }}" class="site-btn">Donate</a>
                            <a href="{{ route('volunteer.index') }}" class="site-btn-outline">Volunteer</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-meta">
                <span>&copy; {{ now()->year }} {{ $orgName }}. All rights reserved.</span>
                <span>Designed for a premium public-facing social organization presence.</span>
            </div>
        </div>
    </div>
</footer>
