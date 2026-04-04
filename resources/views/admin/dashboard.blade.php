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
      <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 space-y-4 sm:space-y-0">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        <div class="flex items-center space-x-4">
          <div class="relative">
            <button aria-expanded="false" aria-haspopup="true" class="flex items-center space-x-2 focus:outline-none" id="user-menu-button" type="button">
              @if (auth()->user()->profile_image)
                <img alt="Admin profile" class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . auth()->user()->profile_image) }}"/>
              @else
                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                  {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}
                </div>
              @endif
              <span class="text-gray-700 font-medium">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
              <i class="fas fa-chevron-down text-gray-500"></i>
            </button>
          </div>
        </div>
      </header>
      <!-- Stats cards -->
      <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4" title="Total number of enrolled students">
          <div class="p-3 rounded-full bg-blue-100 text-blue-600">
            <i class="fas fa-user-graduate fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Students</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $students }}</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4" title="Total number of instructors">
          <div class="p-3 rounded-full bg-green-100 text-green-600">
            <i class="fas fa-chalkboard-teacher fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Teachers</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $teachers }}</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4" title="Total number of courses available">
          <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
            <i class="fas fa-book-open fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Courses</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $courses }}</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4" title="Total quiz questions in the system">
          <div class="p-3 rounded-full bg-purple-100 text-purple-600">
            <i class="fas fa-question-circle fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Questions</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $questions }}</p>
          </div>
        </div>
      </section>
      <!-- Secondary stats -->
      <section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4">
          <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
            <i class="fas fa-clipboard-list fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Quizzes</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $quizzes }}</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4">
          <div class="p-3 rounded-full bg-pink-100 text-pink-600">
            <i class="fas fa-layer-group fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Subjects</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $subjects }}</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4">
          <div class="p-3 rounded-full bg-orange-100 text-orange-600">
            <i class="fas fa-users fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Total Users</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $students + $teachers }}</p>
          </div>
        </div>
      </section>
      <!-- Charts and tables -->
      <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Enrollment chart -->
        <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Student Enrollment — {{ now()->year }}</h2>
          <canvas id="enrollmentChart" class="w-full h-72"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          const ctx = document.getElementById('enrollmentChart').getContext('2d');
          new Chart(ctx, {
            type: 'line',
            data: {
              labels: @json($monthLabels),
              datasets: [{
                label: 'New Students',
                data: @json($enrollmentData),
                fill: true,
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7
              }]
            },
            options: {
              responsive: true,
              plugins: {
                legend: { display: true, position: 'top' },
                tooltip: { mode: 'index', intersect: false }
              },
              scales: {
                x: { title: { display: true, text: 'Month' } },
                y: { title: { display: true, text: 'Students Enrolled' }, beginAtZero: true, ticks: { precision: 0 } }
              }
            }
          });
        </script>
        <!-- Recent students -->
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Recently Joined</h2>
          <ul class="divide-y divide-gray-200 max-h-72 overflow-y-auto">
            @forelse ($recentStudents as $student)
            <li class="py-3 flex items-center space-x-3">
              @if ($student->profile_image)
                <img alt="Profile of {{ $student->first_name }}" class="h-9 w-9 rounded-full object-cover" src="{{ asset('storage/' . $student->profile_image) }}"/>
              @else
                <div class="h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm flex-shrink-0">
                  {{ strtoupper(substr($student->first_name, 0, 1)) }}{{ strtoupper(substr($student->last_name, 0, 1)) }}
                </div>
              @endif
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ $student->first_name }} {{ $student->last_name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ $student->email }}</p>
              </div>
              <span class="text-xs text-gray-400">{{ $student->created_at ? $student->created_at->diffForHumans() : '' }}</span>
            </li>
            @empty
            <li class="py-4 text-sm text-gray-500 text-center">No students yet.</li>
            @endforelse
          </ul>
        </div>
      </section>
      <!-- Students table -->
      <section class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Students</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="relative px-6 py-3" scope="col">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            @foreach ($users as $user)
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                  @if ($user->profile_image)
                    <img alt="Profile of {{ $user->first_name }}" class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $user->profile_image) }}"/>
                  @else
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm flex-shrink-0">
                      {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                    </div>
                  @endif
                  <div class="text-sm font-medium text-gray-900">{{ $user->first_name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->last_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->age }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ strtoupper($user->status) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                  <a class="text-blue-600 hover:text-blue-900" href="{{ route('students.edit', $user->id) }}">Edit</a>
                  <a class="text-gray-700 hover:text-indigo-600" href="{{ route('students.show', $user->id) }}">View</a>
                  <form action="{{ route('students.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this student?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                  </form>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </section>
      <div class="mt-4">{{ $users->links() }}</div>
    </main>
  </div>
</body>
</html>
