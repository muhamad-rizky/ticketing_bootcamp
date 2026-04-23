@extends('layouts.app')

@section('title', 'Login - Secure')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">

        {{-- Security Badge --}}
        <div class="text-center mb-4">
            <span class="badge secure-badge px-4 py-2 fs-6">
                <i class="bi bi-shield-check"></i> SECURE LOGIN
            </span>
        </div>

        <div class="card auth-card secure-border">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </h5>
            </div>
            <div class="card-body p-4">

                {{-- Security Features Info --}}
                <div class="alert alert-success small mb-4">
                    <strong><i class="bi bi-shield-check"></i> Security Features:</strong>
                    <ul class="mb-0 mt-1">
                        <li>Rate limiting (5 attempts/min)</li>
                        <li>Password hashing verification</li>
                        <li>Session regeneration</li>
                        <li>CSRF protection</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="form-floating mb-3">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="email@example.com"
                               required
                               autofocus>
                        <label for="email">
                            <i class="bi bi-envelope"></i> Email
                        </label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-floating mb-3">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Password"
                               required>
                        <label for="password">
                            <i class="bi bi-key"></i> Password
                        </label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>

                <hr>

                <div class="text-center">
                    <p class="mb-0 small">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Register</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Compare Link --}}
        <div class="text-center mt-4">
            <a href="{{ route('vulnerable.login') }}" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-exclamation-triangle"></i> Bandingkan dengan Vulnerable Login
            </a>
        </div>

        {{-- Code Preview --}}
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <small><i class="bi bi-code-slash"></i> Secure Code Preview</small>
            </div>
            <div class="card-body p-0">
                <pre class="bg-dark text-light p-3 mb-0 small"><code>// LoginRequest.php - Rate Limiting
public function authenticate(): void
{
    <span class="text-success">// Check rate limit FIRST</span>
    $this->ensureIsNotRateLimited();

    if (! Auth::attempt(...)) {
        <span class="text-success">// Increment rate limiter on fail</span>
        RateLimiter::hit($this->throttleKey());
        throw ValidationException::withMessages([...]);
    }

    <span class="text-success">// Clear limiter on success</span>
    RateLimiter::clear($this->throttleKey());
}

// LoginController.php - Session Security
public function store(LoginRequest $request)
{
    $request->authenticate();

    <span class="text-success">// Regenerate session ID (prevent fixation)</span>
    $request->session()->regenerate();

    return redirect()->intended('dashboard');
}</code></pre>
            </div>
        </div>

    </div>
</div>
@endsection
