{{-- resources/views/events/index.blade.php --}}
<x-app-layout>
    <style>
        @keyframes zoomInOut { 0%{transform:scale(1)} 50%{transform:scale(1.02)} 100%{transform:scale(1)} }
        .animate-zoom { animation: zoomInOut 10s ease-in-out infinite; }
        .event-card { border-radius:12px; overflow:hidden; box-shadow:0 6px 16px rgba(0,0,0,.1); transition:transform .3s ease; }
        .event-card:hover { transform: translateY(-6px); }
        .event-image { height:200px; width:100%; object-fit:cover; }
    </style>

    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Image" class="w-100 animate-zoom" height="420px" src="{{ asset($settings['event_image'] ?? '') }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Upcoming Events</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-4">
                @forelse($events as $event)
                    <div class="col-md-6 col-lg-4">
                        <div class="card event-card">
                            <img src="{{ asset($event->banner_path) }}" class="card-img-top event-image" alt="{{ $event->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text">{{ Str::limit($event->short_description, 120) }}</p>
                                <div style="display:flex; justify-content: space-between;">
                                    <div class="text-muted mb-2">
                                        <i class="bi bi-calendar-event"></i>
                                        <strong>{{ $event->formatted_date }}</strong>
                                    </div>
                                    <div>
                                        @php $days = $event->days_remaining; @endphp
                                        @if(!is_null($days))
                                            <small class="{{ $days <= 3 ? 'text-danger' : 'text-info' }}">⏳ {{ $days }} {{ Str::plural('day', $days) }}</small>
                                        @else
                                            <small class="text-muted">Ended</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="{{ url('event-registration').'?event_id=' . $event->id }}" target="_blank" rel="noopener" class="btn btn-success" style="border-radius:3px;">Register Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No upcoming events available.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
