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
      <section class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Teachers</h2>
        <div class="overflow-x-auto mt-5">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="relative px-6 py-3" scope="col">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>

          @foreach ($teachers as $teacher)
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                <img src="{{ $teacher->profile_image ? asset('storage/' . $teacher->profile_image) : 'https://via.placeholder.com/40' }}"
     alt="Profile photo"
     class="h-10 w-10 rounded-full object-cover" />

                  <div class="text-sm font-medium text-gray-900"></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $teacher->first_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $teacher->last_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $teacher->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $teacher->age }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $teacher->section->title ?? 'null'}}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ strtoupper($teacher->status) }}</span>
                </td>
                <td class="mt-10 text-right text-sm font-medium">
            <!-- Dropdown menu -->
            <div class="relative inline-block text-left">
    <!-- 3-dot icon button -->
    <button id="menu-button-{{ $teacher->id }}" type="button"
        class="inline-flex justify-center w-full p-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-full focus:outline-none"
        onclick="document.getElementById('dropdown-{{ $teacher->id }}').classList.toggle('hidden')">
        <!-- Heroicons Dots Vertical - Bigger (w-7 h-7) -->
        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v.01M12 12v.01M12 18v.01" />
        </svg>
    </button>

    <!-- Dropdown -->
    <div id="dropdown-{{ $teacher->id }}"
        class="hidden absolute right-0 mt-2 w-44 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg z-50">
        <div class="py-1">
            <a href="{{ route('teachers.show', $teacher->id) }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Teacher</a>
            <a href="{{ route('teachers.edit', $teacher->id) }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
        </div>
        <div class="py-1">
            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
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
              <!-- Additional student rows can be added here -->
            </tbody>

            
            @endforeach
          </table>
        </div>
      </section>



      <script>
  window.addEventListener('click', function (e) {
    const menu = document.getElementById('dropdown');
    const button = document.getElementById('menu-button');
    if (!button.contains(e.target)) {
      menu.classList.add('hidden');
    }
  });
</script>


    </main>
  </div>
</body>
</html>
