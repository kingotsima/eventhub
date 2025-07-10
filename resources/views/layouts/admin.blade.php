<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - EventHub</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #36b9cc;
            --text-dark: #5a5c69;
            --text-light: #d1d3e2;
            --dark-bg: #1a1a2e;
            --dark-card: #16213e;
            --dark-header: #0f3460;
            --dark-text: #e6e6e6;
            --dark-border: #2a3a5a;
            --dark-input-bg: #1a2a4a;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
            min-height: 100vh;
            color: var(--text-dark);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .nav-link-text,
        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar.collapsed .nav-item {
            text-align: center;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
        }

        .logo-area {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }

        .logo img {
            max-width: 40px;
            margin-right: 10px;
        }

        .logo-text {
            transition: opacity 0.3s ease;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }

        .nav-item {
            position: relative;
            margin-bottom: 0.2rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid white;
        }

        .nav-link i {
            font-size: 1.1rem;
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .nav-link-text {
            transition: opacity 0.3s ease;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: var(--sidebar-collapsed-width);
        }

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background-color: white;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .content-container {
            padding: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.35rem;
            font-weight: 600;
            color: var(--text-dark);
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        /* Toggle Button */
        .sidebar-toggle {
            background: none;
            border: none;
            color: #d1d3e2;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        .sidebar-toggle:hover {
            color: white;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar.collapsed {
                transform: translateX(-100%);
            }
        }

        /* Logout Button */
        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0.5rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            background: none;
            border: none;
            text-align: left;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }

        body.dark-mode .topbar {
            background-color: var(--dark-card) !important;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(0, 0, 0, 0.3);
            color: var(--dark-text);
        }

        body.dark-mode .card {
            background-color: var(--dark-card);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(0, 0, 0, 0.3);
            color: var(--dark-text);
        }

        body.dark-mode .card-header {
            background-color: var(--dark-header) !important;
            border-bottom: 1px solid var(--dark-border) !important;
            color: var(--dark-text) !important;
        }

        body.dark-mode .dropdown-menu {
            background-color: var(--dark-card);
            border: 1px solid var(--dark-border);
        }

        body.dark-mode .dropdown-item {
            color: var(--dark-text);
        }

        body.dark-mode .dropdown-item:hover {
            background-color: var(--dark-header);
            color: white;
        }

        body.dark-mode .content-container {
            background-color: var(--dark-bg);
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select,
        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background-color: var(--dark-input-bg);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .form-control::placeholder {
            color: #a1a1a1;
        }

        body.dark-mode .table {
            color: var(--dark-text);
        }

        body.dark-mode .table th,
        body.dark-mode .table td {
            border-color: var(--dark-border);
        }

        body.dark-mode .table-striped>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: rgba(15, 52, 96, 0.5);
            color: var(--dark-text);
        }

        body.dark-mode .table-hover>tbody>tr:hover {
            --bs-table-accent-bg: rgba(15, 52, 96, 0.7);
            color: white;
        }

        body.dark-mode .text-muted {
            color: #a1a1a1 !important;
        }

        body.dark-mode .text-dark {
            color: var(--dark-text) !important;
        }

        body.dark-mode .bg-light {
            background-color: var(--dark-card) !important;
        }

        body.dark-mode .border,
        body.dark-mode .border-bottom,
        body.dark-mode .border-top,
        body.dark-mode .border-start,
        body.dark-mode .border-end {
            border-color: var(--dark-border) !important;
        }

        body.dark-mode .btn-outline-secondary {
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .btn-outline-secondary:hover {
            background-color: var(--dark-header);
            border-color: var(--dark-header);
            color: white;
        }

        body.dark-mode .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        body.dark-mode .btn-primary:hover {
            background-color: #3a5bc7;
            border-color: #3a5bc7;
        }

        body.dark-mode .alert-success {
            background-color: #1a3a1a;
            border-color: #2d4d2d;
            color: #c8e6c9;
        }

        body.dark-mode .alert-danger {
            background-color: #3a1a1a;
            border-color: #4d2d2d;
            color: #ffcdd2;
        }

        body.dark-mode .alert-info {
            background-color: #1a2a3a;
            border-color: #2d3d4d;
            color: #bbdefb;
        }

        body.dark-mode .nav-tabs .nav-link {
            color: var(--dark-text);
        }

        body.dark-mode .nav-tabs .nav-link.active {
            background-color: var(--dark-card);
            border-color: var(--dark-border) var(--dark-border) var(--dark-card);
            color: var(--dark-text);
        }

        body.dark-mode .nav-tabs {
            border-bottom-color: var(--dark-border);
        }

        body.dark-mode .pagination .page-link {
            background-color: var(--dark-card);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        body.dark-mode .pagination .page-item.disabled .page-link {
            background-color: var(--dark-card);
            color: #6c757d;
        }

        /* Floating Dark Mode Toggle */
        .dark-mode-toggle-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 999;
            transition: all 0.3s ease;
            border: none;
        }

        .dark-mode-toggle-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        body.dark-mode .dark-mode-toggle-btn {
            background-color: var(--dark-header);
            color: var(--dark-text);
        }

        .dark-mode-toggle-btn i {
            font-size: 1.25rem;
            transition: transform 0.3s ease;
        }

        body.dark-mode .dark-mode-toggle-btn i.bi-moon {
            display: none;
        }

        body.dark-mode .dark-mode-toggle-btn i.bi-sun {
            display: block;
        }

        .dark-mode-toggle-btn i.bi-sun {
            display: none;
        }

        .dark-mode-toggle-btn i.bi-moon {
            display: block;
        }

        /* Additional form styling for dark mode */
        body.dark-mode .form-label {
            color: var(--dark-text);
        }

        body.dark-mode .input-group-text {
            background-color: var(--dark-header);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        body.dark-mode .form-check-label {
            color: var(--dark-text);
        }

        /* Custom select dropdown styling */
        body.dark-mode .select2-container--default .select2-selection--single {
            background-color: var(--dark-input-bg);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--dark-text);
        }

        body.dark-mode .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: var(--dark-text) transparent transparent transparent;
        }

        body.dark-mode .select2-dropdown {
            background-color: var(--dark-card);
            border-color: var(--dark-border);
        }

        body.dark-mode .select2-container--default .select2-results__option[aria-selected="true"] {
            background-color: var(--dark-header);
            color: white;
        }

        body.dark-mode .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary-color);
            color: white;
        }

        /* Custom styling for datepicker in dark mode */
        body.dark-mode .flatpickr-calendar {
            background-color: var(--dark-card);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .flatpickr-day {
            color: var(--dark-text);
        }

        body.dark-mode .flatpickr-day:hover {
            background-color: var(--dark-header);
            border-color: var(--dark-header);
        }

        body.dark-mode .flatpickr-day.selected {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Custom styling for rich text editor in dark mode */
        body.dark-mode .ql-toolbar {
            background-color: var(--dark-header);
            border-color: var(--dark-border) !important;
        }

        body.dark-mode .ql-container {
            background-color: var(--dark-input-bg);
            border-color: var(--dark-border) !important;
            color: var(--dark-text);
        }

        body.dark-mode .ql-editor {
            color: var(--dark-text);
        }

        body.dark-mode .ql-snow .ql-stroke {
            stroke: var(--dark-text);
        }

        body.dark-mode .ql-snow .ql-fill {
            fill: var(--dark-text);
        }

        body.dark-mode .ql-snow .ql-picker {
            color: var(--dark-text);
        }

        /* Custom styling for file input in dark mode */
        body.dark-mode .form-file-label {
            background-color: var(--dark-input-bg);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .form-file-text::after {
            background-color: var(--dark-header);
            color: var(--dark-text);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="adminSidebar">
        <div>
            <div class="logo-area">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="EventHub Logo">
                    <span class="logo-text">EventHub</span>
                </a>
            </div>

            <div class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events.index') ? 'active' : '' }}">
                            <i class="bi bi-calendar-event"></i>
                            <span class="nav-link-text">Events</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.events.create') }}" class="nav-link {{ request()->routeIs('admin.events.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-circle"></i>
                            <span class="nav-link-text">Create Event</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.index') ? 'active' : '' }}">
                            <i class="bi bi-ticket-perforated"></i>
                            <span class="nav-link-text">Bookings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.checkin.form') }}" class="nav-link {{ request()->routeIs('admin.checkin.form') ? 'active' : '' }}">
                            <i class="bi bi-qr-code-scan"></i>
                            <span class="nav-link-text">Check-In</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.index') ? 'active' : '' }}">
                            <i class="bi bi-chat-square-quote"></i>
                            <span class="nav-link-text">Testimonials</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people me-2"></i> Users
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="nav-link-text">Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="adminContent">
        <!-- Topbar -->
        <header class="topbar">
            <button class="sidebar-toggle d-none d-md-block" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            
            <button class="sidebar-toggle d-md-none" id="mobileToggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="d-flex align-items-center">
                <span class="me-3 d-none d-sm-block">Welcome, Admin</span>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="content-container">
            @yield('content')
        </main>
    </div>

    <!-- Floating Dark Mode Toggle Button -->
    <button class="dark-mode-toggle-btn" id="darkModeToggleBtn">
        <i class="bi bi-moon"></i>
        <i class="bi bi-sun"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar
        const toggleBtn = document.getElementById('toggleSidebar');
        const mobileToggleBtn = document.getElementById('mobileToggleSidebar');
        const sidebar = document.getElementById('adminSidebar');
        const content = document.getElementById('adminContent');

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('shifted');
        }

        function toggleMobileSidebar() {
            sidebar.classList.toggle('show');
        }

        toggleBtn.addEventListener('click', toggleSidebar);
        mobileToggleBtn.addEventListener('click', toggleMobileSidebar);

        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnMobileToggle = mobileToggleBtn.contains(event.target);
            
            if (!isClickInsideSidebar && !isClickOnMobileToggle && window.innerWidth <= 768) {
                sidebar.classList.remove('show');
            }
        });

        // Highlight active menu item
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });

        // Dark Mode Toggle
        const darkModeToggleBtn = document.getElementById('darkModeToggleBtn');
        const body = document.body;

        // Check for saved user preference or use system preference
        const savedMode = localStorage.getItem('darkMode');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedMode === 'dark' || (!savedMode && systemPrefersDark)) {
            body.classList.add('dark-mode');
        }

        // Toggle dark mode
        darkModeToggleBtn.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            const isDarkMode = body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode ? 'dark' : 'light');
            
            // Dispatch event for other scripts to listen to
            const event = new Event('darkModeToggle');
            document.dispatchEvent(event);
        });

        // Listen for system preference changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (!localStorage.getItem('darkMode')) {
                if (e.matches) {
                    body.classList.add('dark-mode');
                } else {
                    body.classList.remove('dark-mode');
                }
            }
        });

        // Listen for dark mode changes to update third-party plugins
        document.addEventListener('darkModeToggle', function() {
            const isDarkMode = body.classList.contains('dark-mode');
            
            // Update Select2 if it exists
            if (typeof $ !== 'undefined' && $.fn.select2) {
                $('.select2').trigger('change.select2');
            }
            
            // Update Flatpickr if it exists
            if (typeof flatpickr !== 'undefined') {
                document.querySelectorAll('.flatpickr-input').forEach(input => {
                    input._flatpickr.redraw();
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>