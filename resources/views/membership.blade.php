<x-app-layout>
    <x-public-hero
        badge="Membership"
        title="Join a structured network working on real social priorities."
        subtitle="{{ \Illuminate\Support\Str::limit(strip_tags($settings['membership_section_description'] ?? 'Membership is for people who want to contribute beyond sympathy through ideas, participation, advocacy, and support.'), 220) }}"
        image="img/join_membership.png"
        quote="A strong membership system gives an organization continuity, legitimacy, and collective intelligence."
        primary-text="Apply for Membership"
        primary-url="{{ route('member.apply') }}"
        secondary-text="Meet Members"
        secondary-url="{{ route('members.index') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="surface-split surface-split--reverse">
                <div class="public-card p-0 overflow-hidden">
                    <div class="person-card__media h-100">
                        <img src="{{ asset('img/membership.png') }}" alt="Membership" style="height:100%; min-height:440px;">
                    </div>
                </div>

                <div class="public-card copy-stack">
                    <div class="section-heading mb-0">
                        <span class="site-eyebrow">Why Join</span>
                        <h2>Membership is the organization’s community backbone.</h2>
                    </div>
                    <div class="rich-copy">
                        {!! $settings['membership_section_description'] ?? '<p>Members help shape programs, improve reach, support accountability, and sustain long-term growth for the organization.</p>' !!}
                    </div>
                    <div class="site-grid grid-2">
                        <div class="public-card feature-card content-stack">
                            <h3>Participation</h3>
                            <p class="mb-0">Contribute to planning, outreach, and event mobilization.</p>
                        </div>
                        <div class="public-card feature-card content-stack">
                            <h3>Belonging</h3>
                            <p class="mb-0">Join a network of people who are serious about impact.</p>
                        </div>
                    </div>
                    <div>
                        <x-dyn-button page="member" key="apply_membership" fallbackText="Apply for Membership" fallbackUrl="{{ route('member.apply') }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
