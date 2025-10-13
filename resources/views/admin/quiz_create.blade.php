<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Quiz</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('admin.sidebar')
    <!-- Main Content -->
<!-- Main Content -->
<div class="flex-1 p-8 flex justify-center items-start">
  <div class="w-full max-w-3xl p-8 rounded-xl">

        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-3">Create Topic</h1>
        @if (session('success'))
          <div class="mb-4 text-green-700 bg-green-100 border border-green-300 p-3 rounded-lg text-sm">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('quizzes.store') }}" method="POST" class="space-y-6">
          @csrf
          <!-- Module Dropdown -->
          <div>
  <label for="subject_id" class="block text-sm font-semibold text-gray-700 mb-1">Select Subject</label>
  <select name="subject_id" id="subject_id"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none bg-white text-gray-700">
    <option value="">-- Choose a subject --</option>
    @foreach ($subjects as $subject)
      <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
        {{ $subject->title }}
      </option>
    @endforeach
  </select>
  @error('subject_id')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
  @enderror
</div>


          <!-- Quiz Title -->
          <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Quiz Topic</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none"
                   placeholder="Enter topic title">
            @error('title')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description (optional)</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none"
                      placeholder="Enter quiz description">{{ old('description') }}</textarea>
            @error('description')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          

          <!-- Submit -->
          <div class="text-right">
            <button type="submit"
                    class="inline-flex items-center bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition-all duration-200 shadow-sm">
              Save Topic
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
