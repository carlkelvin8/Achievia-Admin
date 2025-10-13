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
          <button aria-label="Search" class="relative inline-flex items-center p-2 text-gray-500 hover:text-gray-700 focus:outline-none" type="button">
            <i class="fas fa-search text-lg"></i>
          </button>
          <button aria-label="Notifications" class="relative inline-flex items-center p-2 text-gray-500 hover:text-gray-700 focus:outline-none" type="button">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">5</span>
          </button>
          <div class="relative">
            <button aria-expanded="false" aria-haspopup="true" class="flex items-center space-x-2 focus:outline-none" id="user-menu-button" type="button">
              <img alt="User  profile picture" class="h-8 w-8 rounded-full object-cover" src="https://storage.googleapis.com/a1aa/image/9177fe23-83cd-4b44-8257-e5e16ef161a8.jpg"/>
              <span class="text-gray-700 font-medium">Emily Johnson</span>
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
            <p class="text-2xl font-semibold text-gray-900">56</p>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow p-5 flex items-center space-x-4" title="Upcoming scheduled classes this week">
          <div class="p-3 rounded-full bg-purple-100 text-purple-600">
            <i class="fas fa-calendar-alt fa-lg"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Admin</p>
            <p class="text-2xl font-semibold text-gray-900">18</p>
          </div>
        </div>
      </section>
      <!-- Charts and tables -->
      <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Chart placeholder -->
        <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Enrollment Trends</h2>
          <canvas id="enrollmentChart" class="w-full h-72"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          const ctx = document.getElementById('enrollmentChart').getContext('2d');
          new Chart(ctx, {
            type: 'line',
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [{
                label: 'Number of Students',
                data: [120, 135, 150, 165, 180, 200, 220],
                fill: false,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgb(59, 130, 246)',
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7
              }]
            },
            options: {
              responsive: true,
              plugins: {
                legend: {
                  display: true,
                  position: 'top'
                },
                tooltip: {
                  mode: 'index',
                  intersect: false
                }
              },
              interaction: {
                mode: 'nearest',
                intersect: false
              },
              scales: {
                x: {
                  title: {
                    display: true,
                    text: 'Month'
                  }
                },
                y: {
                  title: {
                    display: true,
                    text: 'Students Enrolled'
                  },
                  beginAtZero: true
                }
              }
            }
          });
        </script>
        <!-- Recent activity -->
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h2>
          <ul class="divide-y divide-gray-200 max-h-72 overflow-y-auto">
            <!-- Recent activity items -->
            <li class="py-3 flex items-center space-x-4">
              <img alt="Profile picture of Sarah Lee" class="h-10 w-10 rounded-full object-cover" src="https://storage.googleapis.com/a1aa/image/497bcb90-5e3a-42bc-8c31-0e61c77e9ea2.jpg"/>
              <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">Sarah Lee</p>
                <p class="text-sm text-gray-500 truncate">Enrolled in 'Advanced Math'</p>
              </div>
              <div class="text-sm text-gray-500">1h ago</div>
            </li>
            <!-- Additional activity items can be added here -->
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
            @foreach ($users as $user )
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                  <img alt="Profile picture of Sarah Lee" class="h-10 w-10 rounded-full object-cover" src="https://storage.googleapis.com/a1aa/image/497bcb90-5e3a-42bc-8c31-0e61c77e9ea2.jpg"/>
                  <div class="text-sm font-medium text-gray-900">{{ $user->first_name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->last_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->age }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ strtoupper($user->status) }}</span>
                </td>
                <td class="whitespace-nowrap text-right text-sm font-medium">
                <a class="text-blue-600 hover:text-blue-900" href="#">Edit</a>
                <a class="text-black hover:text-blue-600" href="#">View</a>
                  <a class="text-red-600 hover:text-blue-900" href="#">Delete</a>
                </td>
              </tr>
              <!-- Additional student rows can be added here -->
            </tbody>
            @endforeach
          </table>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
