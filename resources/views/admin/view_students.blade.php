<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #fff;
      color: #111;
    }

    .section-title {
      border-bottom: 1px solid #ccc;
      padding-bottom: 0.75rem;
      margin-bottom: 2rem;
      font-weight: 700;
      font-size: 1.875rem;
      color: #222;
    }

    .profile-pic {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.12);
    }

    .btn-primary {
      background-color: #111;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #222;
    }
  </style>
</head>

<body class="min-h-screen flex">
  @include('admin.sidebar')
  <main class="flex mx-auto px-6 py-5">
    <div class="grid grid-cols-3 md:grid-cols-3 mt-16">
    <section class="flex flex-col items-center text-center md:items-start md:text-left md:col-span-1 mt-16">
    <img 
  alt="Portrait of student" 
  src="{{ $students->profile_image ? asset('storage/' . $students->profile_image) : 'https://via.placeholder.com/190' }}" 
  class="rounded-3xl object-cover w-[190px] h-[190px]"
  width="190" height="190"
/>


        <p class="w-full text-4xl font-extrabold mb-2 text-center md:text-left text-black">
  {{ $students->first_name }} {{ $students->last_name }}
</p>

@if (Auth::user()->role !== 'teacher')
<a href="{{ route('students.edit', $students->id) }}"
           class="btn-primary w-6 md:w-auto flex items-center justify-center gap-2 mt-2 flex"
           aria-label="Edit Profile">
          <i class="fas fa-edit"></i> Edit Profile
        </a>

@endif
      </section>
      
      <!-- Right Content -->
      <section class="md:col-span-2 flex flex-col space-y-10 mt-5 px-4">
        <div>
          <h3 class="section-title">RMT Information</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-14 gap-y-8 text-gray-800 text-lg">
            
            <div class="flex items-center space-x-3">
              <i class="fas fa-user text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">First Name</p>
                <p>{{ $students->first_name }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3">
              <i class="fas fa-user-tag text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">Last Name</p>
                <p>{{ $students->last_name }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3">
              <i class="fas fa-user-tag text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">Middle Name</p>
                <p>{{ $students->middle_name }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3">
              <i class="fas fa-birthday-cake text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">Age</p>
                <p>{{ $students->age }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3">
              <i class="fas fa-envelope text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">Email</p>
                <p>{{ $students->email }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3">
              <i class="fas fa-info-circle text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">Bio</p>
                <p>{{ $students->bio }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3">
              <i class="fas fa-check-circle text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">Status</p>
                <p>{{ strtoupper($students->status) }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3">
              <i class="fas fa-user-shield text-xl w-6"></i>
              <div>
                <p class="font-semibold mb-1 text-black">Role</p>
                <p>{{ strtoupper($students->role) }}</p>
              </div>
            </div>
          </div>
          
        </div>
        
      </section>

    </div>
  </main>

  <script>
    // Optional mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuButton && mobileMenu) {
      mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }
  </script>
</body>
</html>
