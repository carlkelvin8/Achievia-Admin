<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-papK2Hi+4HLk/6PHbfILJm3dDScK8w7S7nMSRt/3QUCqKp9kDPtO9L9CwRDNxWZl/Ar4v0FDJ5WBlFgrTBYCg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
</head>
<body class="bg-gray-50">
  <div class="flex flex-col md:flex-row min-h-screen">
    
    <!-- Sidebar (hidden on mobile, visible on md and up) -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 mt-16">
      <div class="max-w-5xl mx-auto">
        <h2 class="text-gray-700 text-2xl sm:text-3xl font-semibold mb-8 text-center sm:text-left">
          Add User
        </h2>
        <form
          method="POST"
          action="{{ route('admin.register') }}"
          class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6"
          enctype="multipart/form-data"
        >
          @csrf
          @method('POST')

          <div class="flex flex-col">
            <label for="firstName" class="text-sm text-gray-600 mb-1">First name</label>
            <input
              id="firstName"
              name="first_name"
              type="text"
              placeholder="Enter your first name"
              class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
            />
            @error('first_name')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex flex-col">
            <label for="lastName" class="text-sm text-gray-600 mb-1">Last name</label>
            <input
              id="lastName"
              name="last_name"
              type="text"
              placeholder="Enter your last name"
              class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
            />
            @error('last_name')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex flex-col">
            <label for="middleName" class="text-sm text-gray-600 mb-1">Middle name</label>
            <input
              id="middleName"
              name="middle_name"
              type="text"
              placeholder="Enter your middle name"
              class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
            />
            @error('middle_name')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex flex-col relative">
            <label for="password" class="text-sm text-gray-600 mb-1">Password</label>
            <input
              id="password"
              name="password"
              type="password"
              placeholder="Enter new password"
              class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
            />
            @error('password')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex flex-col relative">
            <label for="confirmPassword" class="text-sm text-gray-600 mb-1">Confirm Password</label>
            <input
              id="confirmPassword"
              name="password_confirmation"
              type="password"
              placeholder="Confirm new password"
              class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
            />
          </div>

          <div class="flex flex-col relative">
            <label for="email" class="text-sm text-gray-600 mb-1">E-mail</label>
            <input
              id="email"
              name="email"
              type="email"
              placeholder="Enter your email"
              class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
            />
            @error('email')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex flex-col">
  <label for="age" class="text-sm text-gray-600 mb-1">Age</label>
  <input
    id="age"
    name="age"
    type="number"
    placeholder="Enter your age"
    class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
  />
  @error('age')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror
</div>


<div class="flex flex-col">
  <label for="role" class="text-sm text-gray-600 mb-1">Role</label>
  <select
    id="role"
    name="role"
    class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
    required
  >
    <option value="">Select a role</option>
    <option value="admin">Admin</option>
    <option value="teacher">Teacher</option>
    <option value="student">Student</option>
  </select>
  @error('role')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror
</div>


          <div class="flex items-center space-x-6 mt-8 sm:col-span-2">
            <button
              type="submit"
              class="bg-black text-white rounded-lg px-5 py-2 text-base font-medium hover:bg-[#357ea3] transition-colors"
            >
              Add
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
