<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Admin - Subjects</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <div class="flex flex-1 overflow-hidden">
    @include('admin.sidebar')

    <!-- Main content -->
    <main class="flex-1 overflow-y-auto p-6">
      <section class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Subjects</h2>
        <form method="GET" action="{{ route('subjects.index') }}" class="mb-4 flex items-center gap-3">
  <label for="course_id" class="text-sm font-medium text-gray-700">Filter by Course:</label>
  <select name="course_id" id="course_id" class="border rounded-lg px-3 py-2">
    <option value="">All Courses</option>
    @foreach ($courses as $course)
      <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
        {{ $course->title }}
      </option>
    @endforeach
  </select>
  <button type="submit" class="bg-black text-white px-3 py-2 rounded-lg">Filter</button>
</form>

        <div class="text-right">
          <a class="bg-black text-white py-2 px-3 mt-5 text-sm rounded-2xl" href="{{ route('subjects.create') }}">
            Create Subject
          </a>
        </div>

        <div class="overflow-x-auto mt-5">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                <th class="relative px-6 py-3"></th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($subjects as $subject)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                  <img src="{{ $subject->image ? asset('storage/' . $subject->image) : 'https://via.placeholder.com/40' }}"
                       alt="Subject image"
                       class="h-10 w-10 rounded-full object-cover"/>
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $subject->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $subject->description }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">
    {{ $subject->course ? $subject->course->title : '—' }}
</td>
                <td class="px-6 py-4 text-right text-sm font-medium">
                  <div class="relative inline-block text-left">
                    <button id="menu-button-{{ $subject->id }}" type="button"
                      class="inline-flex justify-center w-full p-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-full focus:outline-none"
                      onclick="toggleDropdown({{ $subject->id }})">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v.01M12 12v.01M12 18v.01" />
                      </svg>
                    </button>
                    <div id="dropdown-{{ $subject->id }}"
                      class="hidden absolute right-0 mt-2 w-44 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg z-50">
                      <div class="py-1">
                        @if (Auth::user()->role !== 'teacher')
                          <a href="{{ route('subjects.edit', $subject->id) }}"
                             class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                        @endif
                      </div>
                      @if (Auth::user()->role !== 'teacher')
                      <div class="py-1">
                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                                  class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Delete</button>
                        </form>
                      </div>
                      @endif
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>

  <script>
    function toggleDropdown(id) {
      document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
        if (el.id !== `dropdown-${id}`) el.classList.add('hidden');
      });
      document.getElementById(`dropdown-${id}`).classList.toggle('hidden');
    }

    window.addEventListener('click', function (e) {
      document.querySelectorAll('[id^="menu-button-"]').forEach(button => {
        const id = button.id.split('-').pop();
        const dropdown = document.getElementById(`dropdown-${id}`);
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
          dropdown.classList.add('hidden');
        }
      });
    });
  </script>
</body>
</html>
