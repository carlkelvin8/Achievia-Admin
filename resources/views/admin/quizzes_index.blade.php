<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style> body { font-family: "Inter", sans-serif; } </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <div class="flex flex-1 overflow-hidden">
    @include('admin.sidebar')

    <main class="flex-1 overflow-y-auto p-6">
      <section class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Question Bank</h2>
        <p class="text-sm text-gray-600 mb-4">Search and filter quizzes by Module, Subject, and text—plus see total questions.</p>

        {{-- Totals / Summary --}}
        <div class="mb-4">
          <div class="flex items-center gap-3 text-sm">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 text-gray-800">
              <strong>Total Quizzes:</strong> {{ number_format($totals['question_bank'] ?? 0) }}
            </span>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-black text-white">
              <strong>Total Questions (current filter):</strong> {{ number_format($totalQuestions ?? 0) }}
            </span>
          </div>
        </div>

        {{-- Actions --}}
        <div class="text-right mb-4">
          <a href="{{ route('quizzes.create') }}" class="bg-black text-white py-2 px-3 text-sm rounded-2xl m-1">Create Set</a>
          <a href="{{ route('quiz.import.form') }}" class="bg-black text-white py-2 px-3 text-sm rounded-2xl m-1">Import Question</a>
        </div>

        {{-- Filters --}}
        <form method="GET" action="{{ route('quizzes.index') }}" class="mb-4 flex gap-2 flex-wrap items-center">
          {{-- Module Filter --}}
          @if(($modules ?? collect())->count())
            <select name="module_id" class="border px-3 py-2 rounded w-auto">
              <option value="">All Modules</option>
              @foreach($modules as $module)
                <option value="{{ $module->id }}" {{ (string)request('module_id') === (string)$module->id ? 'selected' : '' }}>
                  {{ $module->title }}
                </option>
              @endforeach
            </select>
          @endif

          {{-- Subject Filter --}}
          <select name="subject_id" class="border px-3 py-2 rounded w-auto">
            <option value="">All Subjects</option>
            @foreach($subjects as $subject)
              <option value="{{ $subject->id }}" {{ (string)request('subject_id') === (string)$subject->id ? 'selected' : '' }}>
                {{ $subject->title }}
              </option>
            @endforeach
          </select>

          {{-- Search --}}
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Search titles/descriptions/questions…"
                 class="border px-3 py-2 rounded w-64">

          <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-900">Apply</button>

          @if(request('module_id') || request('subject_id') || request('search'))
            <a href="{{ route('quizzes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Reset</a>
          @endif
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto mt-5">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Module</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"># Questions</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse($rows as $quiz)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $quiz->title }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $quiz->description }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $quiz->module->title ?? '—' }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $quiz->subject->title ?? '—' }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $quiz->questions_count }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex gap-3 items-center">
                    <a href="{{ route('quizzes.edit', $quiz->id) }}" class="text-black hover:underline">Edit</a>
                    <a href="{{ route('quizzes.questions', $quiz->id) }}" class="text-blue-600 hover:underline">Manage Questions</a>
                    <form id="delete-form-{{ $quiz->id }}" action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return false;">
                      @csrf @method('DELETE')
                      <button type="button" onclick="confirmDelete({{ $quiz->id }})" class="text-red-600 hover:underline text-sm">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="px-6 py-6 text-center text-gray-500">No quizzes found.</td></tr>
              @endforelse
            </tbody>
          </table>

          {{-- Pagination --}}
          <div class="mt-4">
            {{ $rows instanceof \Illuminate\Contracts\Pagination\Paginator ? $rows->onEachSide(1)->links() : '' }}
          </div>
        </div>
      </section>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: 'Delete Exam?',
        text: "This will remove the quiz and all its questions.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById(`delete-form-${id}`).submit();
        }
      });
    }
  </script>
</body>
</html>
