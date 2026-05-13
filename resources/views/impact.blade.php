<x-app-layout>
    <x-public-hero
        badge="Impact Dashboard"
        title="Transparent progress across donations, members, events, and causes."
        subtitle="A public snapshot of the foundation's current operating footprint. Deeper reporting can be connected here as the admin report module is completed."
        image="img/donationus.png"
        primary-text="Donate Now"
        primary-url="{{ route('donate.form') }}"
        secondary-text="Annual Reports"
        secondary-url="{{ route('annual-report.index') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="site-grid grid-4">
                <div class="public-card metric-card">
                    <strong>৳{{ number_format($stats['total_donations'] ?? 0) }}</strong>
                    <span>Total recorded donations.</span>
                </div>
                <div class="public-card metric-card">
                    <strong>{{ number_format($stats['active_causes'] ?? 0) }}</strong>
                    <span>Donation causes configured.</span>
                </div>
                <div class="public-card metric-card">
                    <strong>{{ number_format($stats['active_members'] ?? 0) }}</strong>
                    <span>Approved members.</span>
                </div>
                <div class="public-card metric-card">
                    <strong>{{ number_format($stats['upcoming_events'] ?? 0) }}</strong>
                    <span>Upcoming events.</span>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section-tight">
        <div class="site-container">
            <div class="section-heading">
                <span class="site-eyebrow">Cause Breakdown</span>
                <h2>Funding areas prepared for public accountability.</h2>
                <p>These causes come from the existing donation cause table. Progress bars can be connected to target amounts once the payment/reporting phase is implemented.</p>
            </div>

            <div class="site-grid grid-3">
                @forelse($causes as $cause)
                    <article class="public-card content-stack">
                        <span class="badge-soft">Cause</span>
                        <h3>{{ $cause->name }}</h3>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" style="width: {{ min(100, 35 + ($loop->iteration * 8)) }}%; background: var(--site-primary);"></div>
                        </div>
                        <p class="mb-0">Target tracking placeholder ready for the payment transaction phase.</p>
                    </article>
                @empty
                    <div class="public-card">
                        <p class="mb-0">Donation causes will appear here after admin setup.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
