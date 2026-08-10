<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4 text-center">
            <h5 class="fw-bold mb-1" style="color: var(--cb-black);">Iniciar Sesión</h5>
            <p class="text-muted small">Ingresa tus credenciales para acceder</p>
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="usuario@sicip.com">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label d-flex justify-content-between">
                Contraseña
                @if (Route::has('password.request'))
                    <a class="text-decoration-none small" style="color: var(--cb-green); font-weight: 500;" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </label>
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Remember Me -->
        <div class="mb-4 form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label text-muted small" for="remember_me">
                Mantener sesión iniciada
            </label>
        </div>

        <div>
            <button type="submit" class="btn btn-primary w-100 shadow">
                Entrar al Sistema
            </button>
        </div>
    </form>
</x-guest-layout>
