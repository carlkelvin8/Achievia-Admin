<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 text-sm text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded" />
            </div>
            <div class="mb-6">
                <label class="block mb-1 text-sm text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded" />
            </div>
            @if($errors->any())
                <p class="text-red-500 text-sm mb-4">{{ $errors->first() }}</p>
            @endif
            <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                Login
            </button>
        </form>
    </div>
</body>
</html>
