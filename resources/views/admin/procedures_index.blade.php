<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Procedures</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <div class="flex flex-1 overflow-hidden">
    @include('admin.sidebar')

    <main class="flex-1 overflow-y-auto p-6">
      <section class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Procedures</h2>

        <form method="GET" action="{{ route('procedures.index') }}" class="mb-4 flex gap-2">
    <select name="subject_id" class="border px-3 py-2 rounded">
        <option value="">-- All Subjects --</option>
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ ($subjectId ?? '') == $subject->id ? 'selected' : '' }}>
                {{ $subject->title }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-black text-white px-4 py-2 rounded">Filter</button>
</form>


        <div class="text-right mb-4">
          <a href="{{ route('procedures.create') }}" class="bg-black text-white py-2 px-4 text-sm rounded-lg">
            Add Procedure
          </a>
        </div>

        @if (session('success'))
          <div class="mb-4 text-green-700 bg-green-100 border border-green-300 p-3 rounded-lg text-sm">
            {{ session('success') }}
          </div>
        @endif

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">File</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse ($procedures as $procedure)
              <tr>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $procedure->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">
                  @if ($procedure->file_path)
                    <a href="{{ asset('storage/' . $procedure->file_path) }}" target="_blank" class="text-blue-600 underline">View File</a>
                  @else
                    <span class="text-gray-400 italic text-sm">No File</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">
      @if ($procedure->subject)
        {{ $procedure->subject->title }}
      @else
        <span class="text-gray-400 italic text-sm">No Subject</span>
      @endif
    </td>

                <td class="px-6 py-4 text-right">
                  <div class="inline-flex gap-2">
                    <a href="{{ route('procedures.edit', $procedure->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('procedures.destroy', $procedure->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 italic">No procedures found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
