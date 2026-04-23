@extends('layouts.app')

@section('title', 'Dashboard - Secure')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card secure-border">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-speedometer2"></i> Dashboard (Secure)
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-success">
                    <h5 class="alert-heading">
                        <i class="bi bi-check-circle"></i>
                        Selamat datang, {{ Auth::user()->name }}!
                    </h5>
                    <p>Anda berhasil login dengan <strong>Secure Authentication</strong>.</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="bi bi-person"></i> User Info
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Password:</strong></td>
                                        <td>
                                            <code class="text-muted">
                                                {{ Str::limit(Auth::user()->password, 30) }}...
                                            </code>
                                            <br>
                                            <span class="badge bg-success">HASHED (bcrypt)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Session ID:</strong></td>
                                        <td>
                                            <code class="small">{{ Str::limit(session()->getId(), 20) }}...</code>
                                            <span class="badge bg-success">Regenerated</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="bi bi-shield-check"></i> Security Status
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Rate Limiting
                                        <span class="badge bg-success">✓ Enabled</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Password Hashing
                                        <span class="badge bg-success">✓ bcrypt</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Session Regeneration
                                        <span class="badge bg-success">✓ Done</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        CSRF Protection
                                        <span class="badge bg-success">✓ Active</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
