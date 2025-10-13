<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <style>
         .custom-input::placeholder {
        color: gray;
        font-style: italic;
        font-size: 17px;
        opacity: 0.7; 
         }
    </style>
    <main>
        @yield('content')
    </main>
</body>
</html>
