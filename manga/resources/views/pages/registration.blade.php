<x-header></x-header>
@vite('resources/css/login.css')

<main>

    <form method="POST" action="{{ route('register') }}" class="form-card">
        @csrf
        <h2>Register</h2>
        <a href="{{ route('google.login') }}" class="btn-google">
    Register / Login with Google
        </a>
        {{-- Name --}}
        <div class="form-group">
            <label for="register-name">Name:</label>
            <input type="text" id="register-name" name="name"
                   value="{{ old('name') }}"
                   class="@error('name') border-red-500 @enderror"
                   required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="register-email">Email:</label>
            <input type="email" id="register-email" name="email"
                   value="{{ old('email') }}"
                   class="@error('email') border-red-500 @enderror"
                   required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="register-password">Password:</label>
            <input type="password" id="register-password" name="password"
                   class="@error('password') border-red-500 @enderror"
                   required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="register-password-confirm">Confirm Password:</label>
            <input type="password" id="register-password-confirm" name="password_confirmation" required>
        </div>
        <input type="hidden" name="status" value="reader">

        <div class="form-group remember">
            <input type="checkbox">
            <p>remember me!</p>
        </div>

        <button type="submit">Sign Up</button>
    </form>
</main>
</body>
</html>