@extends('layouts.app')

@section('title', 'Register - Secure')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">

        {{-- Security Badge --}}
        <div class="text-center mb-4">
            <span class="badge secure-badge px-4 py-2 fs-6">
                <i class="bi bi-shield-check"></i> SECURE REGISTER
            </span>
        </div>

        <div class="card auth-card secure-border">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-person-plus"></i> Register
                </h5>
            </div>
            <div class="card-body p-4">

                {{-- Security Features Info --}}
                <div class="alert alert-success small mb-4">
                    <strong><i class="bi bi-shield-check"></i> Security Features:</strong>
                    <ul class="mb-0 mt-1">
                        <li>Strong password requirements</li>
                        <li>Password confirmation</li>
                        <li>bcrypt hashing (auto)</li>
                        <li>Input validation & sanitization</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="form-floating mb-3">
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Nama Lengkap"
                               required
                               autofocus>
                        <label for="name">
                            <i class="bi bi-person"></i> Nama
                        </label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-floating mb-3">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="email@example.com"
                               required>
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
                        <div class="form-text">
                            <small>
                                <i class="bi bi-info-circle"></i>
                                Min 8 karakter, huruf besar/kecil, angka
                            </small>
                        </div>
                    </div>

                    {{-- Password Confirmation --}}
                    <div class="form-floating mb-3">
                        <input type="password"
                               class="form-control"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="Konfirmasi Password"
                               required>
                        <label for="password_confirmation">
                            <i class="bi bi-key-fill"></i> Konfirmasi Password
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                </form>

                <hr>

                <div class="text-center">
                    <p class="mb-0 small">
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Compare Link --}}
        <div class="text-center mt-4">
            <a href="{{ route('vulnerable.register') }}" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-exclamation-triangle"></i> Bandingkan dengan Vulnerable Register
            </a>
        </div>

        {{-- Code Preview --}}
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <small><i class="bi bi-code-slash"></i> Secure Code Preview</small>
            </div>
            <div class="card-body p-0">
                <pre class="bg-dark text-light p-3 mb-0 small"><code>// RegisterController.php
public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => [
            'required', 'confirmed',
            <span class="text-success">// Strong password rules</span>
            Rules\Password::defaults()
                ->min(8)
                ->letters()
                ->numbers()
                ->mixedCase()
        ],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        <span class="text-success">// Auto-hashed via model casting!</span>
        'password' => $request->password,
    ]);
}</code></pre>
            </div>
        </div>

    </div>
</div>
@endsection
