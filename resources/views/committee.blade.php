<x-app-layout>
    <x-public-hero
        badge="Committee"
        title="Leadership and committee structure with public clarity."
        subtitle="The committee page is now designed as a leadership showcase and governance view while keeping the existing ordered data source intact."
        image="{{ $settings['committee_image'] ?? 'img/committee.png' }}"
        quote="Good governance should be visible, understandable, and human."
        primary-text="Contact Leadership"
        primary-url="{{ url('/contact') }}"
        secondary-text="Join as Member"
        secondary-url="{{ route('member.apply') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Leadership</span>
                <h2>Committee members shaping direction and accountability.</h2>
                <p>Entries are still pulled from the ordered committee dataset, so public presentation improves without changing the operational data flow.</p>
            </div>

            <div class="site-grid grid-3 mb-5">
                @forelse($members as $member)
                    <article class="public-card person-card content-stack">
                        <div class="person-card__media">
                            <img src="{{ asset($member->photo ?: 'img/team-1.jpg') }}" alt="{{ $member->name }}">
                        </div>
                        <div class="content-stack">
                            <div>
                                <h3>{{ $member->name }}</h3>
                                <p class="mb-0">{{ $member->designation }}</p>
                            </div>
                            @if($member->short_description)
                                <p class="mb-0">{{ $member->short_description }}</p>
                            @endif
                            @if($member->contact)
                                <a href="mailto:{{ $member->contact }}" class="site-btn-outline">Contact</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">No committee members are available yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="public-card">
                <div class="section-heading mb-0">
                    <span class="site-eyebrow">Structure</span>
                    <h2>Committee roles at a glance.</h2>
                </div>

                <div class="table-responsive">
                    <table class="site-table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $member)
                                <tr>
                                    <td>{{ $member->designation }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>
                                        @if($member->contact)
                                            <a href="mailto:{{ $member->contact }}">{{ $member->contact }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No committee structure data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
