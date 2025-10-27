<x-header></x-header>
@vite('resources/css/login.css')
<main>
    <form method="POST" action="{{ route('register') }}" class="form-card">
        @csrf
        <h2>Register</h2>
        <a href="{{ route('google.login') }}" class="btn-google">
    Register / Login with Google
        </a>
    </form>
<form method="POST" action="{{ route('login') }}" class="form-card">
    @csrf
    <h2>Log in</h2> 

    <div class="form-group">
        <label for="login-email">Email:</label>
        <input type="email" id="login-email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="login-password">Password:</label>
        <input type="password" id="login-password" name="password" required>
        @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Display general invalid credentials error -->
    @if ($errors->has('email') && !old('email'))
        <p class="text-red-600 text-sm mt-1">{{ $errors->first('email') }}</p>
    @endif

    <button type="submit">Login</button>
</form>

</main>
</html>
</body>