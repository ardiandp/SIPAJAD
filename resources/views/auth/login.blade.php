<x-guest-layout>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Login ke SIPAJAD</h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required autofocus autocomplete="username"
                           placeholder="your@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           required autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input">
                        <span class="form-check-label">Ingat saya</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="ti ti-login me-2"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (Route::has('password.request'))
        <div class="text-center text-muted mt-3">
            <a href="{{ route('password.request') }}">Lupa password?</a>
        </div>
    @endif
</x-guest-layout>
