<x-guest-layout>
    <!-- Spinner Start -->
    <style>
        body {
        /* নরম ডার্ক-গ্রেডিয়েন্ট ব্যাকগ্রাউন্ড */
        background: radial-gradient(1200px 600px at 10% 0%, #3060a3 0%, #1d7299 60%, #243a85 100%);
        min-height: 100vh;
        }
        .auth-card {
        border: 0;
        border-radius: 1rem;
        backdrop-filter: blur(4px);
        }
    </style>

    <!-- Spinner End -->
    <div class="container-fluid position-relative p-0">
        <div class="carousel" data-bs-ride="carousel" id="header-carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 100px;">
                    {{-- <img alt="Image" class="w-100  animate-zoom" style="height: calc(100svh / 2);" height="90px" src="{{ asset('img/login.jpg') }}" /> --}}
                </div>

            </div>
        </div>
    </div>
    <main class="container min-vh-90 d-flex align-items-center py-4">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                {{-- Session Status --}}
                @if (session('status'))
                <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card shadow-lg auth-card mt-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-3">
                            <h1 class="h3 text-warning">Welcome</h1>
                        </div>

                        <form method="POST" action="{{ route('login') }}" novalidate>
                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label text-seconday">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg text-black border-secondary @error('email') is-invalid @enderror" required autocomplete="username" autofocus placeholder="name@example.com">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-2">
                                <label for="password" class="form-label text-seconday">Password</label>
                                <input id="password" type="password" name="password" class="form-control form-control-lg text-black border-secondary @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Remember + Forgot (optional) --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                                    <label class="form-check-label text-secondary" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                {{-- <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot password?</a> --}}
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning btn-lg shadow-sm">
                                    Log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-guest-layout>
