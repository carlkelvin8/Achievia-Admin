<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Admin - Abbreviations</title>
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
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Abbreviations</h2>


        <form method="GET" action="{{ route('abbreviations.index') }}" class="mb-4 flex gap-2">
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
          <a class="bg-black text-white py-2 px-4 text-sm rounded-lg" href="{{ route('abbreviations.create') }}">
            Add Abbreviation
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Short Form</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Full Form</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($abbreviations as $abbreviation)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $abbreviation->short_form }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $abbreviation->full_form }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
        {{ $abbreviation->subject ? $abbreviation->subject->title : '-' }}
      </td>
                  <td class="px-6 py-4 text-right text-sm font-medium">
                    <div class="inline-flex gap-2">
                      <a href="{{ route('abbreviations.edit', $abbreviation->id) }}" class="text-blue-600 hover:underline">Edit</a>
                      <form id="delete-form-{{ $abbreviation->id }}" 
      action="{{ route('abbreviations.destroy', $abbreviation->id) }}" 
      method="POST" 
      class="inline-block">
  @csrf
  @method('DELETE')
  <button type="button"
          onclick="confirmDelete({{ $abbreviation->id }})"
          class="text-red-600 hover:underline text-sm">
    Delete
  </button>
</form>
                    </div>
                  </td>
                </tr>
              @endforeach

              @if($abbreviations->isEmpty())
                <tr>
                  <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 italic">No abbreviations found.</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>
</body>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This abbreviation will be deleted permanently.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Yes, delete it!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById(`delete-form-${id}`).submit();
      }
    });
  }
</script>


</html>
