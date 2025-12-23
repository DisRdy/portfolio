<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portofolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-navbar />

    <div class="container">
        <section class="auth-wrapper"
            style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <h2 style="text-align: center; margin-bottom: 20px;">Login</h2>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div style="margin-bottom: 15px;">
                    <label for="email" class="form-group-label"
                        style="display: block; margin-bottom: 5px;">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="form-input"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('email')
                        <span class="text-red-500 text-sm" style="color: red; font-size: 0.875em;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" class="form-group-label"
                        style="display: block; margin-bottom: 5px;">Password</label>
                    <input type="password" name="password" id="password" required class="form-input"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('password')
                        <span class="text-red-500 text-sm" style="color: red; font-size: 0.875em;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn"
                    style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Log In
                </button>
            </form>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Portofolio Disna Radita. Semua hak dilindungi.</p>
    </footer>
</body>

</html>