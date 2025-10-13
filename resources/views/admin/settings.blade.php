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
          Account Settings
        </h2>


        <div class="flex justify-center mb-6">
  <img
    class="rounded-full border-4 object-cover"
    src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/200?text=No+Image' }}"
    alt="Profile photo"
    id="profileImagePreview"
    style="width: 250px; height:250px;"
  />
</div>

        <form
          method="POST"
          action="{{ route('settings.update') }}"
          class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6"
          enctype="multipart/form-data"
        >
          @csrf
          @method('PUT')

          <div class="flex flex-col">
            <label for="firstName" class="text-sm text-gray-600 mb-1">First name</label>
            <input
              id="firstName"
              name="first_name"
              type="text"
              placeholder="Enter your first name"
              value="{{ old('first_name', auth()->user()->first_name) }}"

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
              value="{{ old('first_name', auth()->user()->last_name) }}"
              class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
            />
            @error('last_name')
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
              value="{{ old('first_name', auth()->user()->email) }}"
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
    value="{{ old('age', auth()->user()->age) }}"
    class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
  />
  @error('age')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror
</div>


<div class="flex flex-col">
  <label for="profile_image" class="text-sm text-gray-600 mb-1">Profile Image</label>
  <input
    id="profile_image"
    name="profile_image"
    type="file"
    accept="image/*"
    class="border border-gray-300 rounded px-4 py-3 text-gray-700 text-base"
  />
  @error('profile_image')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror
</div>


          <div class="flex items-center space-x-6 mt-8 sm:col-span-2">
            <button
              type="submit"
              class="bg-black text-white rounded-lg px-5 py-2 text-base font-medium hover:bg-[#357ea3] transition-colors"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
