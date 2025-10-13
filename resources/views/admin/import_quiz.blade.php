
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Quiz</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">


<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
  <h2 class="text-xl font-bold mb-4">Import Quizzes from CSV</h2>

  @if (session('success'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
  @endif

  <form action="{{ route('quiz.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
      <input type="file" name="csv" required class="border border-gray-300 rounded p-2 w-full" />
    </div>
    <button type="submit" class="bg-black text-white px-4 py-2 rounded">Import</button>
  </form>
</div>
</body>
</html>