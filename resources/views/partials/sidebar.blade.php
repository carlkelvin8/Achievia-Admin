<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE v3 Dashboard</title>

  <!-- Google Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- AdminLTE -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .nav-sidebar .nav-item {
      border-radius: 5px;
      margin-top: 20px;
      margin-bottom: 5px;
      padding: 5px;
    }
    .nav-sidebar .nav-link {
      padding: 12px 15px;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .nav-sidebar .nav-icon {
      font-size: 18px;
    }
    .nav-sidebar .nav-item:hover {
      background-color: #f8f9fa;
      transition: 0.3s;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <div class="sidebar">
      <nav class="mt-2">
      <img
        class="h-12 w-12 object-cover rounded-full border-2 border-gray-300"
        src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://via.placeholder.com/40' }}"
        alt="Profile photo"
        />
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-user text-dark text-center"></i>
      <p>{{ Auth::User()->first_name }}</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('student.module') }}" class="nav-link">
      <i class="nav-icon fas fa-th-large text-dark"></i>
      <p>Modules</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('quiz.student') }}" class="nav-link">
      <i class="nav-icon fas fa-tasks text-dark"></i>
      <p>Question Bank</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('settings.student') }}" class="nav-link">
      <i class="nav-icon fas fa-user-cog text-dark"></i>
      <p>Account Settings</p>
    </a>
  </li>

  <li class="nav-item">
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt text-dark"></i>
        <p>Sign Out</p>
      </button>
    </form>
  </li>
</ul>
      </nav>
    </div>
  </aside>
</div>

<!-- Scripts -->
<script src="https://cdn.botpress.cloud/webchat/v2.5/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/05/21/09/20250521090159-ORWDFVIC.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<!-- Optional: Force Collapse Sidebar (Fallback) -->
<script>
  $(document).ready(function () {
    $('body').addClass('sidebar-collapse');
  });
</script>

</body>
</html>
