<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Admin - Topics</title>
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

    <main class="flex-1 overflow-y-auto p-6">
      <section class="bg-white rounded-lg shadow p-6">
        <div class="flex items-end justify-between gap-4">
          <div>
            <h2 class="text-2xl font-semibold text-gray-900">Topics</h2>
            <p class="text-sm text-gray-500">
              Total: <span class="font-semibold">{{ $topics->count() }}</span>
            </p>
          </div>
          <a class="bg-black text-white py-2 px-4 text-sm rounded-lg" href="{{ route('topics.create') }}">
            Add Topic
          </a>
        </div>

        @if (session('success'))
          <div class="mt-4 text-green-700 bg-green-100 border border-green-300 p-3 rounded-lg text-sm">
            {{ session('success') }}
          </div>
        @endif

        <div class="overflow-x-auto mt-6">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Content</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse ($topics as $topic)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ $topic->title }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                    {{ $topic->subject->title ?? '-' }}
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-700">
                    <div class="max-w-xs truncate">{!! $topic->content !!}</div>
                  </td>
                  <td class="px-6 py-4 text-right text-sm font-medium">
                    <div class="inline-flex gap-3">
                      <a href="{{ route('topics.edit', $topic->id) }}" class="text-blue-600 hover:underline">Edit</a>
                      <form id="delete-form-{{ $topic->id }}" action="{{ route('topics.destroy', $topic->id) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $topic->id }})" class="text-red-600 hover:underline text-sm">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500 italic">No topics found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: 'Delete this topic?',
        text: "This cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it',
        reverseButtons: true
      }).then((res) => {
        if (res.isConfirmed) document.getElementById(`delete-form-${id}`).submit();
      });
    }
  </script>
</body>
</html>
