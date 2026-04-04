<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Admin</title>
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
      <!-- Header -->
      <!-- Students table -->
      <section class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Mother Notes</h2>
   
        <div class="flex justify-between items-center mb-4">
  <div>
    <form method="GET" action="{{ route('modules.index') }}" class="flex gap-2">
      <select name="subject" class="border px-3 py-2 rounded">
        <option value="">All Subjects</option>
        @foreach($subjects as $subject)
          <option value="{{ $subject->id }}" {{ isset($subjectId) && $subjectId == $subject->id ? 'selected' : '' }}>
            {{ $subject->title }}
          </option>
        @endforeach
      </select>
      <button type="submit" class="bg-black text-white px-4 py-2 rounded">Filter</button>
    </form>
  </div>

  <div class="text-right">
    <a class="bg-black text-white py-2 px-3 text-sm rounded-2xl" href="{{ route('modules.create') }}">
      Create Mother Notes
    </a>
  </div>
</div>

        <div class="overflow-x-auto mt-5">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="relative px-6 py-3" scope="col">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($modules as $module)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                  @if($module->image)
                    <img src="{{ asset('storage/' . $module->image) }}" alt="{{ $module->title }}" class="h-10 w-10 rounded-full object-cover flex-shrink-0">
                  @else
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                      <i class="fas fa-book text-indigo-600"></i>
                    </div>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $module->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $module->description }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  @if($module->file)
                    <a href="{{ asset('storage/' . $module->file) }}" target="_blank" class="text-blue-600 hover:underline">
                      {{ basename($module->file) }}
                    </a>
                  @else
                    <span class="text-gray-400">No file</span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $module->subject ? $module->subject->title : '—' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ strtoupper($module->status) }}</span>
                </td>
                <td class="px-6 py-4 text-right text-sm font-medium">
                  <div class="relative inline-block text-left">
                    <button id="menu-button-{{ $module->id }}" type="button"
                        class="inline-flex justify-center w-full p-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-full focus:outline-none"
                        onclick="document.getElementById('dropdown-{{ $module->id }}').classList.toggle('hidden')">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H9.5V3.5H10.5V1.5ZM10.5 8.5H9.5V10.5H10.5V8.5ZM10.5 15.5H9.5V17.5H10.5V15.5Z" />
                        </svg>
                    </button>

                    <div id="dropdown-{{ $module->id }}"
                        class="hidden absolute right-0 mt-2 w-44 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg z-50">
                        <div class="py-1">
                            <a href="{{ route('modules.edit', $module->id) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                        </div>
                        <div class="py-1">
                            <form action="{{ route('modules.destroy', $module->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Delete</button>
                            </form>
                        </div>
                    </div>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No modules found</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>

  <script>
  window.addEventListener('click', function (e) {
    const menu = document.getElementById('dropdown');
    const button = document.getElementById('menu-button');
    if (!button.contains(e.target)) {
      menu.classList.add('hidden');
    }
  });
</script>

</body>
</html>
