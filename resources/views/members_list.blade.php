<x-app-layout>
    <style>
        @keyframes zoomInOut { 0%{transform:scale(1)} 50%{transform:scale(1.02)} 100%{transform:scale(1)} }
        .animate-zoom{animation:zoomInOut 10s ease-in-out infinite}
        .card-hover{transition:transform .2s ease, box-shadow .2s ease}
        .card-hover:hover{transform:translateY(-4px); box-shadow:0 .5rem 1rem rgba(0,0,0,.15)}
        .obj-cover{object-fit:cover}
    </style>

    {{-- Header --}}
    <div class="container-fluid position-relative p-0">
        <div id="header-carousel" class="carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/join_membership.png') }}" class="w-100 animate-zoom" height="420" alt="Membership">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width:900px;">
                            <h2 class="display-5 text-white">Member</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Members List (Bootstrap) --}}
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5 justify-content-center">
                <div class="col-12">

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                        @forelse($members as $m)
                            <div class="col">
                                <div class="card h-100 border rounded-3 card-hover">
                                    <div class="ratio ratio-4x3">
                                        <img
                                            src="{{ asset($m->photo_path) ?? asset('img/avatar-placeholder.png') }}"
                                            class="img-fluid obj-cover rounded-top"
                                            alt="{{ $m->name }}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title mb-1">{{ $m->name }}</h5>
                                        @if($m->profession)
                                            <p class="card-text text-muted small mb-2">{{ $m->profession }}</p>
                                        @endif
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="badge text-bg-primary">{{ $m->type_label }}</span>
                                            @if($m->start_date)
                                                <small class="text-muted">Since {{ $m->start_date->format('Y') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info mb-0">No approved members yet.</div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $members->links('pagination::bootstrap-5') }}
                        {{-- যদি Tailwind paginator কনফিগার্ড থাকে, উপরের লাইনটাই রাখুন --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
