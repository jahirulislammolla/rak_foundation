<x-app-layout>
    <style>
        @keyframes zoomInOut {
            0% {
                transform: scale(1)
            }

            50% {
                transform: scale(1.02)
            }

            100% {
                transform: scale(1)
            }
        }

        .animate-zoom {
            animation: zoomInOut 10s ease-in-out infinite;
        }

        .shadow-css {
            box-shadow: 0 10px 24px -10px #00000057;
            color: black;
            border-radius: 5px;
            cursor: pointer;
        }

        .bg-hover-primary {
            transition: background-color .5s, color .5s;
        }

        .bg-hover-primary:hover {
            background: #113561bf !important;
            color: #fff;
        }

        .bg-hover-primary:hover h4 {
            color: #fff;
        }

        .member-card img {
            object-fit: cover;
            aspect-ratio: 4/3;
        }

    </style>

    {{-- Header --}}
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="Committee" class="w-100  animate-zoom" style="height: calc(100svh / 2);" src="{{ asset($settings['committee_image']) ?? '' }}" />
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h2 class="display-5 text-white animated zoomIn">Committee</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Intro --}}
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <section class="text-center py-5 bg-white">
            <h1 class="fw-bold">Our Honorable Committee</h1>
            <p class="text-muted lead">The dedicated individuals behind RAK Foundation's success and impact.</p>
        </section>

        {{-- Featured (Top 3 by priority) --}}
        <div class="container py-4">
            <div class="row g-4">
                @php
                $placeholder = asset('img/team-1.jpg'); // fallback image
                @endphp

                @forelse($members as $f)
                <div class="col-md-4">
                    <div class="card text-center p-4 shadow-sm member-card">
                        <img src="{{ asset($f->photo) }}" alt="{{ $f->designation }}" class="mx-auto mb-3 w-100" style="height: 220px;">
                        <h5 class="fw-bold mb-0">{{ $f->name }}</h5>
                        <small class="text-muted">{{ $f->designation }}</small>
                        @if($f->short_description)
                        <p class="mt-2 small text-secondary">{{ $f->short_description }}</p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">No committee members found.</div>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Committee Structure (Table) --}}
        <div class="container mt-5">
            <h4 class="mb-3">📋 Committee Structure</h4>
            <div class="table-responsive">
                <table class="table table-bordered bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $m)
                        <tr>
                            <td>{{ $m->designation }}</td>
                            <td>{{ $m->name }}</td>
                            <td>
                                @if(!empty($m->contact))
                                <a href="mailto:{{ $m->contact }}">{{ $m->contact }}</a>
                                @else
                                —
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No data available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Chairman Message (optional static / could be made dynamic later) --}}
        <section class="py-5 bg-white">
            <div class="container text-center">
                <blockquote class="blockquote">
                    <p class="mb-4">"RAK Foundation stands for compassion and change. Our committee is committed to building a better, equitable society for all."</p>
                    <footer class="blockquote-footer">Chairman</footer>
                </blockquote>
            </div>
        </section>

        {{-- CTA --}}
        <div class="container text-center py-4">
            <h5>Want to get involved?</h5>
            <a href="/contact" class="btn btn-outline-primary m-1">Contact Us</a>
            <x-dyn-button page="committee" key="donate_now" fallbackText="Donate Now" fallbackUrl="/donate" />
        </div>
    </div>
</x-app-layout>
