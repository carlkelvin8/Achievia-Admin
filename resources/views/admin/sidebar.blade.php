<!-- Sidebar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dkyGRQbaseT/UST7he7OLeDChTJEjcLHpsHThH31wXWr9a9/pHBA+rdqhPHSB4uK9JnAal+T7OTVf0kGRyQ9YA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex">
<div class="flex items-center justify-center h-16 border-b border-gray-200 px-6 space-x-4">
  @auth
    <a href="{{ route('settings.index') }}" class="inline-flex items-center space-x-4 hover:underline">
          <img
          class="h-12 w-12 object-cover rounded-full border-2 border-gray-300"
          src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://via.placeholder.com/40' }}"
          alt="Profile photo"
          />
      <span class="text-2xl font-bold text-black">{{ Auth::user()->first_name }}</span>
    </a>
  @else
    <span class="text-2xl font-bold text-black">Menu</span>
  @endauth
</div>

  <!-- Navigation -->
  <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 text-sm">
    @auth
    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white shadow' : 'text-gray-700 hover:bg-gray-100 hover:text-black' }} transition group">
      <i class="fas fa-tachometer-alt mr-3 text-base"></i>
      Dashboard
    </a>

    @if (Auth::user()->role !== 'teacher')
      <a href="{{ route('students.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
        <i class="fas fa-user-graduate mr-3 text-base"></i>
        RMT
      </a>
    @endif

    @if (Auth::user()->role !== 'teacher')
      <a href=""
         class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
         <i class="fas fa-layer-group mr-3 text-base"></i>
          Subscription
      </a>
    @endif

    @if (Auth::user()->role === 'teacher' && Auth::user()->section_id)
      <a href="{{ route('teachers.section', Auth::user()->section_id) }}"
         class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
         <i class="fas fa-user-graduate mr-3 text-base"></i>
          Students
      </a>
    @endif

    <a href="{{ route('modules.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-file-alt mr-3 text-base"></i>
      Mother Notes
    </a>

    <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-graduation-cap mr-3 text-base"></i>
      Courses
    </a>

    <a href="{{ route('subjects.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-layer-group mr-3 text-base"></i>
      Subjects
    </a>

    <a href="{{ route('quizzes.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-question-circle mr-3 text-base"></i>
      Question Bank
    </a>

    <a href="{{ route('mnemonics.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-brain mr-3 text-base"></i>
      Mnemonics
    </a>

    <a href="{{ route('abbreviations.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-spell-check mr-3 text-base"></i>
      Abbreviations
    </a>

    <a href="{{ route('procedures.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-file-alt mr-3 text-base"></i>
      Procedures
    </a>

    @if (Auth::user()->role !== 'teacher')
      <a href="{{ route('admin.register') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
        <i class="fas fa-users mr-3 text-base"></i>
        Users
      </a>
    @endif

    <a href="{{ route('settings.index') }}" class="flex items-center px-4 py-3 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:text-black transition group">
      <i class="fas fa-cogs mr-3 text-base"></i>
      Settings
    </a>
    @endauth
  </nav>


  <!-- Logout Button -->
  <div class="border-t border-gray-200 p-4">
  @auth
  <form method="POST" action="{{ route('logout') }}">
  @csrf
    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 transition">
      <i class="fas fa-sign-out-alt mr-2 text-base"></i> Logout
    </button>
    </form>
  @endauth
  </div>
</aside>
