<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Quiz</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-8 flex justify-center items-start">
      <div class="w-full max-w-3xl p-8 rounded-xl bg-white shadow">

        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-3">Edit Quiz</h1>
        @if (session('success'))
          <div class="mb-4 text-green-700 bg-green-100 border border-green-300 p-3 rounded-lg text-sm">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')
          
          <div>
            <label for="module_id" class="block text-sm font-semibold text-gray-700 mb-1">Select Module</label>
            <select name="module_id" id="module_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none bg-white text-gray-700">
              <option value="">-- Choose a module --</option>
              @foreach ($modules as $module)
                <option value="{{ $module->id }}" {{ $quiz->module_id == $module->id ? 'selected' : '' }}>
                  {{ $module->title }}
                </option>
              @endforeach
            </select>
            @error('module_id')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Quiz Title -->
          <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Quiz Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $quiz->title) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none"
                   placeholder="Enter quiz title">
            @error('title')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description (optional)</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none"
                      placeholder="Enter quiz description">{{ old('description', $quiz->description) }}</textarea>
            @error('description')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Submit -->
          <div class="text-right">
            <a href="{{ route('quizzes.index') }}"
               class="inline-block text-sm text-gray-500 hover:underline mr-4">Cancel</a>
            <button type="submit"
                    class="inline-flex items-center bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition-all duration-200 shadow-sm">
              Update Quiz
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
