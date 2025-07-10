<style>
    /* Navbar Base Styles */
    #mainNavbarWrapper {
        background-color: #ffffff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .dark #mainNavbarWrapper {
        background-color: #1a202c;
        border-bottom-color: rgba(255, 255, 255, 0.05);
    }

    /* Brand Logo */
    .navbar-brand {
        font-size: 1.25rem;
        color: #2d3748;
    }

    .dark .navbar-brand {
        color: #f7fafc;
    }

    .navbar-brand img {
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
    }

    /* Nav Links */
    .nav-link {
        font-weight: 500;
        color: #4a5568;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .dark .nav-link {
        color: #cbd5e0;
    }

    .nav-link:hover,
    .nav-link:focus {
        color: #2b6cb0;
        background-color: rgba(66, 153, 225, 0.1);
    }

    .dark .nav-link:hover,
    .dark .nav-link:focus {
        color: #63b3ed;
        background-color: rgba(99, 179, 237, 0.1);
    }

    .nav-item.active .nav-link {
        color: #2b6cb0;
        font-weight: 600;
    }

    .dark .nav-item.active .nav-link {
        color: #63b3ed;
    }

    /* Dropdown Menus */
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 0.5rem;
    }

    .dark .dropdown-menu {
        background-color: #2d3748;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        color: #4a5568;
        transition: all 0.2s ease;
    }

    .dark .dropdown-item {
        color: #cbd5e0;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: #ebf5ff;
        color: #2b6cb0;
    }

    .dark .dropdown-item:hover,
    .dark .dropdown-item:focus {
        background-color: rgba(66, 153, 225, 0.1);
        color: #63b3ed;
    }

    /* Search Form */
    .navbar .form-control {
        border-radius: 20px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-color: #e2e8f0;
    }

    .dark .navbar .form-control {
        background-color: #2d3748;
        border-color: #4a5568;
        color: #f7fafc;
    }

    .navbar .btn-outline-primary {
        border-radius: 20px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Notification Badge */
    .badge {
        font-size: 0.6rem;
        padding: 0.2rem 0.35rem;
    }

    /* Profile Dropdown */
    .profile-image {
        width: 32px;
        height: 32px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-image:hover {
        transform: scale(1.1);
    }

    /* Mobile Toggle */
    .navbar-toggler {
        border: none;
        padding: 0.25rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .dark .navbar-toggler-icon {
        filter: invert(1);
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
    .navbar-collapse {
        padding-top: 1rem;
        background-color: #ffffff; /* Default light mode background */
    }
    
    .dark .navbar-collapse {
        background-color: #1a202c !important; /* Dark mode background */
    }
    
    .nav-link {
        padding: 0.5rem 0;
        margin: 0.25rem 0;
        color: #4a5568; /* Default light mode text color */
    }
    
    .dark .nav-link {
        color: #cbd5e0 !important; /* Dark mode text color */
    }
    
    .dropdown-menu {
        box-shadow: none;
        border: none;
        background-color: #ffffff; /* Default light mode background */
    }
    
    .dark .dropdown-menu {
        background-color: #2d3748 !important; /* Dark mode background */
    }
    
    .navbar .d-flex {
        flex-direction: column;
        gap: 0.5rem !important;
        padding: 1rem 0;
    }
    
    .navbar .form-control {
        width: 100%;
        margin-right: 0 !important;
    }
}

    @media (max-width: 767.98px) {
    .navbar-collapse {
        background-color: #fff;
        padding: 1rem;
        border-top: 1px solid #eee;
    }

    .dark .navbar-collapse {
        background-color: #1a202c;
    }

    .navbar .d-flex.align-items-center.gap-3 {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem !important;
    }

    .navbar .d-flex.align-items-center.gap-2 {
        flex-direction: column;
        align-items: stretch;
        gap: 0.5rem !important;
    }

    .navbar .btn,
    .navbar .form-control {
        width: 100%;
    }

    .navbar-nav {
        margin-bottom: 1rem;
    }

    .dropdown-menu {
        position: static !important;
        float: none;
        box-shadow: none;
    }

    .navbar .input-group {
        flex-direction: column;
    }

    .navbar .input-group input,
    .navbar .input-group .btn {
        width: 100%;
        border-radius: 6px !important;
    }

    .navbar .input-group .btn {
        margin-top: 0.5rem;
    }
}

@media (max-width: 991.98px) {
    .dark #mainNavbarWrapper,
    .dark .navbar-collapse {
        background-color: #1a202c !important;
    }
}



</style>

<nav id="mainNavbarWrapper" class="navbar navbar-expand-lg navbar-light py-3 shadow-sm">
  <div class="container">
    <!-- Brand Logo & Name -->
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="me-2">
      <span class="fw-bold">EventHub</span>
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Items -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- Left Nav -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>

        <!-- Events Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->is('events*') ? 'active' : '' }}" href="#" id="eventsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Events
          </a>
          <ul class="dropdown-menu" aria-labelledby="eventsDropdown">
            <li><a class="dropdown-item" href="{{ route('events.index', ['filter' => 'upcoming']) }}">Upcoming</a></li>
            <li><a class="dropdown-item" href="{{ route('events.index', ['filter' => 'past']) }}">Past</a></li>
            <li><a class="dropdown-item" href="{{ route('events.index', ['filter' => 'all']) }}">All</a></li>
          </ul>
        </li>

        @auth
        <li class="nav-item">
          <a class="nav-link {{ request()->is('bookings*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">Bookings</a>
        </li>
        @endauth

        <li class="nav-item">
          <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('help') ? 'active' : '' }}" href="{{ route('help') }}">FAQ</a>
        </li>
      </ul>

      <!-- Right Side -->
      <div class="d-flex flex-wrap align-items-center justify-content-end gap-3 ms-auto">


        <!-- Search -->
        <form class="d-flex" action="{{ route('events.search') }}" method="GET">
          <div class="input-group">
            <input class="form-control" name="query" type="search" placeholder="Search events..." aria-label="Search" value="{{ request('query') }}">
            <button class="btn btn-outline-primary" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>

        @auth
        <!-- Notifications -->
        <div class="nav-item dropdown">
          <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell fs-5"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ auth()->user()->unreadNotifications->count() }}
                <span class="visually-hidden">unread notifications</span>
              </span>
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-notifications" aria-labelledby="notificationsDropdown">
            <li class="dropdown-header d-flex justify-content-between align-items-center">
              <span>Notifications</span>
              @if(auth()->user()->unreadNotifications->count() > 0)
              <a href="{{ route('notifications.markAllAsRead') }}" class="small mark-all-read">Mark all as read</a>
              @endif
            </li>
            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
              <li>
                <a href="{{ $notification->data['link'] ?? '#' }}" class="dropdown-item notification-item mark-as-read" data-id="{{ $notification->id }}">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <i class="bi bi-info-circle text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                      <p class="mb-0">{{ $notification->data['message'] ?? 'Notification' }}</p>
                      <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                  </div>
                </a>
              </li>
            @empty
              <li class="dropdown-item text-center py-3 text-muted">No new notifications</li>
            @endforelse

            <li class="dropdown-footer text-center">
              <a href="{{ route('notifications.index') }}" class="small">View all notifications</a>
            </li>
          </ul>
        </div>
      

        <!-- Profile Dropdown -->
        <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            @if (auth()->user()->profile_image)
                <img src="{{ Storage::url(auth()->user()->profile_image) }}" alt="Profile" class="rounded-circle" style="width: 32px; height: 32px;">
            @else
                <i class="bi bi-person-circle fs-5"></i>
            @endif
            <span class="d-none d-lg-block">{{ explode(' ', auth()->user()->name)[0] }}</span>
        </a>


          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('profile.show') }}">
                <i class="bi bi-person me-2"></i> Profile
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">
                  <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
        @endauth

        @guest
          <div class="d-flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
          </div>
        @endguest
      </div>
    </div>
  </div>
</nav>

<style>
    body {
        padding-top: 30px;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const html = document.documentElement;
        const darkToggle = document.getElementById('darkModeToggle');

        // Check for saved theme preference or use system preference
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
            html.classList.add('dark');
        }

        // Toggle dark mode
        darkToggle?.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' , 'light');
            
            // Force a reflow to ensure styles are recalculated
            document.body.offsetHeight;
        });
    });
</script>