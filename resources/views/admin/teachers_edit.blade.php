<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">
  <div class="flex flex-1 overflow-hidden">
    @include('admin.sidebar')

    <main class="flex-1 overflow-y-auto p-6">
      <section class="max-w-5xl mx-auto">
        <div class="rounded-2xl p-8">
          <h2 class="text-4xl font-bold text-gray-800 mb-6 border-b pb-4">Edit Teacher Profile</h2>

          <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Profile Section -->
            <div class="flex items-center gap-6">
              <div class="shrink-0">
                <img class="h-24 w-24 object-cover rounded-full border-2 border-blue-200" src="{{ $teacher->profile_image ? asset('storage/' . $teacher->profile_image) : 'https://via.placeholder.com/40' }}" alt="Profile photo">
              </div>
              <div class="w-full">
                <label for="profile_image" class="block text-sm font-medium text-gray-600 mb-2">Change Profile Image</label>
                <input type="file" name="profile_image" id="profile_image"
                  class="block w-full text-sm text-gray-500
                         file:mr-4 file:py-2 file:px-4
                         file:rounded-full file:border-0
                         file:bg-black file:text-white
                         hover:file:bg-blue-200" />
              </div>
            </div>

            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $teacher->first_name) }}" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" />
              </div>

              <div>
                <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $teacher->last_name) }}" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" />
              </div>

              <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $teacher->email) }}" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" />
              </div>

              <div>
                <label for="age" class="block text-sm font-semibold text-gray-700 mb-1">Age</label>
                <input type="number" id="age" name="age" value="{{ old('age', $teacher->age) }}" min="1" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" />
              </div>

              <div class="md:col-span-2">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select id="status" name="status" required
                  class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none transition">
                  <option value="">Select status</option>
                  <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Active</option>
                  <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
              <a href="{{ route('teachers.index') }}"
                 class="px-5 py-2 bg-white border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-100 transition">
                Cancel
              </a>
              <button type="submit"
                      class="px-6 py-2 bg-black text-white font-semibold rounded-lg hover:border hover:bg-white hover:text-black transition">
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
