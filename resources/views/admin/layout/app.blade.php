<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    /* Header Navbar */
    .navbar-custom {
      background: #343a40;
      color: white;
      padding: 0.75rem 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar-custom .profile-pic {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      cursor: pointer;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      background: #212529;
      padding-top: 60px;
      transition: all 0.4s ease;
      overflow-x: hidden;
      white-space: nowrap;
    }

    .sidebar.expanded {
      width: 220px;
    }

    .sidebar.collapsed {
      width: 70px;
    }

    .sidebar a {
      padding: 12px 20px;
      display: flex;
      align-items: center;
      color: #ddd;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .sidebar a:hover {
      background: #495057;
      color: #fff;
    }

    .sidebar i {
      min-width: 30px;
      text-align: center;
      font-size: 18px;
    }

    .sidebar .menu-text {
      opacity: 1;
      transition: opacity 0.3s;
    }

    .sidebar.collapsed .menu-text {
      opacity: 0;
    }

    /* Submenu */
    .submenu {
      display: none;
      padding-left: 45px;
    }

    .submenu a {
      font-size: 14px;
    }

    .show-submenu .submenu {
      display: block;
      animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    /* Content Area */
    .content {
      margin-left: 220px;
      padding: 20px;
      transition: margin-left 0.4s ease;
    }

    .collapsed ~ .content {
      margin-left: 70px;
    }

    /* Toast Container */
    #toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1055;
    }

    .toast-custom {
      min-width: 250px;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 10px;
      color: #fff;
      opacity: 0;
      transform: translateX(100%);
      transition: all 0.5s ease;
    }

    .toast-custom.show {
      opacity: 1;
      transform: translateX(0);
    }

    .toast-success {
      background: linear-gradient(135deg, #28a745, #218838);
    }

    .toast-error {
      background: linear-gradient(135deg, #dc3545, #b02a37);
    }

  </style>
</head>
<body>
  <!-- Header -->
  @include('admin.layout.header')

  <!-- Sidebar -->
  @include('admin.layout.sidebar')

  <!-- Main Content -->
  <div class="content">
    <div id="toast-container"></div>
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const submenuLinks = document.querySelectorAll('.has-submenu');

    toggleSidebarBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      sidebar.classList.toggle('expanded');
      document.querySelector('.content').classList.toggle('collapsed');
    });

    submenuLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        link.parentElement.classList.toggle('show-submenu');
      });
    });
  </script>
  <script>
    function showToast(message, type = 'success') {
      const container = document.getElementById('toast-container');

      // Create toast element
      const toast = document.createElement('div');
      toast.classList.add('toast-custom', type === 'success' ? 'toast-success' : 'toast-error');
      toast.innerHTML = `<strong>${message}</strong>`;

      container.appendChild(toast);

      // Show with animation
      setTimeout(() => toast.classList.add('show'), 100);

      // Auto remove after 3s
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 500);
      }, 3000);
    }
  </script>

  @stack('scripts')
</body>
</html>
