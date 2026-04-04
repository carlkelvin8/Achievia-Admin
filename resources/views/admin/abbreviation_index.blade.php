<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Admin - Abbreviations</title>
  <style>
  .rte-preview { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; font-size:14px; line-height:1.6; }
  .rte-preview sub, .rte-preview sup { font-size:0.8em; line-height:0; }
  .rte-preview sup { vertical-align: super; }
  .rte-preview sub { vertical-align: sub; }
</style>
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
  <div class="flex flex-1 overflow-hidden">
    
    @include('admin.sidebar')

    <main class="flex-1 overflow-y-auto p-6">
      <section class="bg-white rounded-lg shadow p-6">
        <div class="flex items-end justify-between gap-4">
          <div>
            <h2 class="text-2xl font-semibold text-gray-900">Abbreviations</h2>
            <p class="text-sm text-gray-500">
              Total: <span class="font-semibold">{{ $total ?? $abbreviations->count() }}</span>
            </p>
          </div>
          <a class="bg-black text-white py-2 px-4 text-sm rounded-lg" href="{{ route('abbreviations.create') }}">
            Add Abbreviation
          </a>
        </div>

        @if (session('success'))
          <div class="mt-4 text-green-700 bg-green-100 border border-green-300 p-3 rounded-lg text-sm">
            {{ session('success') }}
          </div>
        @endif

        {{-- Filters --}}
        <form method="GET" action="{{ route('abbreviations.index') }}" class="mt-4 flex flex-wrap gap-2 items-center">
          <select name="subject_id" class="border px-3 py-2 rounded">
            <option value="">All Subjects</option>
            @foreach($subjects as $subject)
              <option value="{{ $subject->id }}" {{ (string)($subjectId ?? '') === (string)$subject->id ? 'selected' : '' }}>
                {{ $subject->title }}
              </option>
            @endforeach
          </select>

          <input type="text"
                 name="q"
                 value="{{ $q }}"
                 placeholder="Search short/full form…"
                 class="border px-3 py-2 rounded w-64">

          <button type="submit" class="bg-black text-white px-4 py-2 rounded">Apply</button>
          @if($subjectId || $q)
            <a href="{{ route('abbreviations.index') }}" class="text-sm text-gray-600 underline">Reset</a>
          @endif
        </form>

        <div class="overflow-x-auto mt-6">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Short Form</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Full Form</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse ($abbreviations as $abbreviation)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{!! $abbreviation->short_form !!}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{!! $abbreviation->full_form !!}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                    {{ $abbreviation->subject->title ?? '-' }}
                  </td>
                  <td class="px-6 py-4 text-right text-sm font-medium">
                    <div class="inline-flex gap-3">
                      <a href="{{ route('abbreviations.edit', $abbreviation->id) }}" class="text-blue-600 hover:underline">Edit</a>
                      <form id="delete-form-{{ $abbreviation->id }}" action="{{ route('abbreviations.destroy', $abbreviation->id) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $abbreviation->id }})" class="text-red-600 hover:underline text-sm">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500 italic">No abbreviations found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-4">
          {{ $abbreviations->links() }}
        </div>
      </section>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: 'Delete this abbreviation?',
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