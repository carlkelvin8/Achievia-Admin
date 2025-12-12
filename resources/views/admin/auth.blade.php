<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Achievia — Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
        <!-- Brand on top -->
        <div class="text-center mb-6">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Achievia logo" class="h-40 w-40">
                <span class="text-6xl font-extrabold tracking-tight">
  <span class="text-blue-900">Achie</span><span class="text-sky-500">via</span>
  <p class="text-base font-medium text-gray-500 tracking-wide">Awaken Academic Ambition</p>

</span>
            </a>
            <p class="mt-2 text-sm text-gray-500">Admin Portal</p>
        </div>

        <h2 class="text-xl font-semibold mb-6 text-center">Sign in to your account</h2>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-black/70 focus:border-black"
                    placeholder="you@example.com"
                />
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-black/70 focus:border-black"
                    placeholder="••••••••"
                />
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if($errors->any())
                <p class="text-red-600 text-sm">{{ $errors->first() }}</p>
            @endif

            <button
                type="submit"
                class="w-full bg-black text-white py-2.5 rounded-xl hover:bg-gray-900 transition"
            >
                Login
            </button>
        </form>
    </div>
</body>
</html>
