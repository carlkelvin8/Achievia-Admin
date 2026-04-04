<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Admin - Create Quiz</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY', 'no-api-key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <div class="flex flex-1 overflow-hidden">
    @include('admin.sidebar')

    <main class="flex-1 overflow-y-auto p-6 flex items-center justify-center">
      <section class="bg-white rounded-lg shadow p-6 max-w-2xl w-full">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Create Quiz</h2>

        <form method="POST" action="{{ route('quizzes.store') }}" class="space-y-6">
          @csrf

          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Quiz Title</label>
            <input type="text" id="title" name="title" placeholder="Enter quiz title"
                   value="{{ old('title') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"/>
            @error('title')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <select id="subject_id" name="subject_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
              <option value="">Select a subject</option>
              @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                  {{ $subject->title }}
                </option>
              @endforeach
            </select>
            @error('subject_id')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="module_id" class="block text-sm font-medium text-gray-700 mb-1">Mother Notes</label>
            <select id="module_id" name="module_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
              <option value="">Select a mother note</option>
              @foreach ($modules as $module)
                <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                  {{ $module->title }}
                </option>
              @endforeach
            </select>
            @error('module_id')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>                                   
            @enderror
          </div>

          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter quiz description"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black tinymce">{{ old('description') }}</textarea>
            @error('description')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex gap-3">
            <button type="submit" class="bg-black text-white px-6 py-2 rounded-lg font-medium hover:bg-gray-800 transition">
              Create Quiz
            </button>
            <a href="{{ route('quizzes.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-400 transition">
              Cancel
            </a>
          </div>
        </form>
      </section>
    </main>
  </div>

  <script>
    tinymce.init({
      selector: '.tinymce',
      menubar: false,
      branding: false,
      statusbar: false,
      plugins: 'link lists code',
      toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
      toolbar_mode: 'sliding'
    });
  </script>
</body>
</html>
