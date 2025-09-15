<nav class="navbar-custom fixed-top">
    <!-- Toggle Button -->
    <button id="toggleSidebar" class="btn btn-sm btn-light me-2">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Profile Dropdown -->
    <div class="dropdown">
        <img src="https://i.pravatar.cc/40" alt="Profile" class="profile-pic dropdown-toggle" data-bs-toggle="dropdown">
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('admin.changePasswordForm') }}">Change Password</a></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>