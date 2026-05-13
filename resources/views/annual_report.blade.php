<x-app-layout>
    <x-public-hero
        badge="Annual Reports"
        title="Published reports and accountability documents."
        subtitle="This page is ready for the annual report upload module. Published PDFs should appear here after the admin report workflow is implemented."
        image="img/gallery.png"
        primary-text="Impact Dashboard"
        primary-url="{{ route('impact.index') }}"
        secondary-text="Contact Office"
        secondary-url="{{ url('/contact') }}" />

    <section class="site-section">
        <div class="site-container">
            <div class="public-card copy-stack">
                <span class="site-eyebrow">Report Library</span>
                <h2>No published annual reports yet.</h2>
                <p>Next implementation phase should add the annual reports table, PDF upload validation, publish status, and public download links from storage.</p>
            </div>
        </div>
    </section>
</x-app-layout>
