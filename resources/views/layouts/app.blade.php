<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EventHub - Discover Amazing Events in Nigeria</title>
    <meta name="description" content="EventHub lets you find and book top events across Nigeria — concerts, conferences, parties, and more. Get your tickets online instantly.">
    <meta name="keywords" content="EventHub, events in Nigeria, Abuja events, Lagos concerts, book tickets, event booking, Nigeria shows, local events, Paystack events">
    <meta name="author" content="EventHub Team">
    <meta name="robots" content="index, follow">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://eventhub.com/"> <!-- replace with your real domain -->
    <meta property="og:title" content="EventHub - Book Events Across Nigeria">
    <meta property="og:description" content="Discover and attend the best events in Nigeria. Pay, download your ticket, and attend. It’s that simple.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}"> <!-- Use a real hosted image -->

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://eventhub.com/">
    <meta name="twitter:title" content="EventHub - Discover Amazing Events in Nigeria">
    <meta name="twitter:description" content="Book top events, conferences, concerts and more across Nigeria on EventHub.">
    <meta name="twitter:image" content="{{ asset('images/logo.png') }}">

    <!-- Read Notifications -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom CSS -->
    <!-- Laravel Vite Assets -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --text-color: #333;
            --text-light: #6c757d;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 8px rgba(0,0,0,0.15);
            --shadow-lg: 0 10px 20px rgba(0,0,0,0.2);
            --transition: all 0.3s ease;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: var(--light-color);
            color: var(--text-color);
            transition: var(--transition);
            margin: 50 ;
        }

        .content {
            flex: 1;
            padding-top: 80px;
            padding-left: 1.5rem;  /* Adds left padding */
            padding-right: 1.5rem; /* Adds right padding */
        }

        /* Navbar */
        .navbar {
            box-shadow: var(--shadow-sm);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
            background-color: white !important;
        }

        .navbar-brand {
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link:focus {
            background-color: rgba(var(--primary-color), 0.1);
            color: var(--primary-color);
        }

        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }


        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            border: none;
            box-shadow: var(--shadow-md);
            cursor: pointer;
            z-index: 999;
            transition: var(--transition);
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-lg);
        }

        /* Dark Mode */
        [data-bs-theme="dark"] {
            color-scheme: dark;
        }

        [data-bs-theme="dark"] body {
            background-color: #121212;
            color: #e0e0e0;
        }

        [data-bs-theme="dark"] .navbar {
            background-color: #1e1e1e !important;
            border-bottom: 1px solid #333;
        }

        [data-bs-theme="dark"] footer {
            background-color: #1e1e1e;
            color: #e0e0e0;
            border-top: 1px solid #333;
        }

        [data-bs-theme="dark"] .social-link {
            background-color: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
        }

        [data-bs-theme="dark"] .social-link:hover {
            background-color: var(--accent-color);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        [data-bs-theme="dark"] ::-webkit-scrollbar-track {
            background: #2a2a2a;
        }

        [data-bs-theme="dark"] ::-webkit-scrollbar-thumb {
            background: var(--accent-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content {
                padding-top: 70px;
            }
            
            .theme-toggle {
                width: 45px;
                height: 45px;
                bottom: 1.5rem;
                right: 1.5rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
<style>
    body {
        padding-top: 10px; /* Adjust this depending on your navbar height */
    }

    @media (max-width: 767.98px) {
        body {
            padding-top: 50px;
        }
    }
</style>

    <!-- Theme Toggle Button -->
    <button class="theme-toggle" id="themeToggleBtn" title="Toggle Dark Mode">
        <i class="bi bi-moon"></i>
    </button>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        @include('partials.navbar')
    </nav>

    <!-- Main Content -->
    <main class="content">
        @yield('content')
    </main>

    <footer class="modern-footer">
    <div class="footer-container">
        <!-- Top Section -->
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('storage/images/logo.png') }}" alt="EventHub" class="footer-logo" onerror="this.src='{{ asset('images/logo.png') }}'">
                <p class="footer-slogan">Your gateway to unforgettable events</p>
            </div>

            <div class="footer-social">
                <h4 class="footer-heading">Follow Us</h4>
                <div class="social-icons">
                    <a href="https://www.facebook.com/eventhubofficial1000" class="social-icon" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/EventHub1000/" class="social-icon" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://wa.me/2348088547019" class="social-icon" aria-label="Twitter">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Middle Section -->
        <div class="footer-middle">
            <div class="footer-contact">
                <h4 class="footer-heading">Contact Us</h4>
                <ul class="contact-list">
                    <li>
                        <i class="bi bi-envelope-fill"></i>
                        <span>EventHub1000@gmail.com</span>
                    </li>
                    <li>
                        <i class="bi bi-telephone-fill"></i>
                        <span>+234 808 854 7019</span>
                    </li>
                    <li>
                        <i class="bi bi-instagram"></i>
                        <span>@EventHub1000</span>
                    </li>
                </ul>
            </div>

            @auth
                @if(auth()->user()->is_admin)
                <div class="footer-admin">
                    <a href="{{ route('admin.dashboard') }}" class="admin-portal-btn">
                        <div class="admin-btn-content">
                            <i class="bi bi-shield-lock"></i>
                            <span>Admin Portal</span>
                            <div class="admin-btn-glow"></div>
                        </div>
                    </a>
                </div>
                @endif
            @endauth
        </div>

        <!-- Bottom Section -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} EventHub. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
.modern-footer {
    background: linear-gradient(135deg, #1e1e2a 0%, #2a2a3a 100%);
    color: #ffffff;
    padding: 3rem 0 1.5rem;
    position: relative;
    overflow: hidden;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.footer-top {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
    padding-bottom: 2rem;
}

.footer-brand {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.footer-logo {
    height: 50px;
    width: auto;
    margin-bottom: 1rem;
    filter: brightness(0) invert(1);
    transition: transform 0.3s ease;
}

.footer-logo[src*="images/logo.png"] {
    filter: none;
    height: 50px;
    width: auto;
}

.footer-logo:hover {
    transform: scale(1.05);
}

.footer-slogan {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
    margin: 0;
}

.footer-social {
    text-align: center;
    width: 100%;
}

.footer-heading {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: white;
    position: relative;
    display: inline-block;
    padding-bottom: 8px;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: #4895ef;
    transform: scaleX(0.5);
    transform-origin: center;
}

.social-icons {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
}

.social-icon {
    color: white;
    font-size: 1.3rem;
    transition: all 0.3s ease;
}

.social-icon:hover {
    color: #4895ef;
    transform: translateY(-3px);
}

.footer-middle {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
    padding: 2rem 0;
}

.footer-contact {
    text-align: center;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    width: 100%;
}

.contact-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.contact-list li {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
    justify-content: center;
}

.contact-list i {
    color: #4895ef;
    font-size: 1.1rem;
}

.admin-portal-btn {
    display: inline-block;
    position: relative;
    padding: 0.8rem 1.8rem;
    background: rgba(67, 97, 238, 0.15);
    color: white;
    border: 1px solid rgba(67, 97, 238, 0.3);
    border-radius: 50px;
    text-decoration: none;
    font-weight: 500;
    overflow: hidden;
    transition: all 0.4s ease;
    backdrop-filter: blur(4px);
}

.admin-btn-content {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    position: relative;
    z-index: 2;
}

.admin-btn-content i {
    font-size: 1.2rem;
    color: #4895ef;
    transition: all 0.3s ease;
}

.admin-btn-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        rgba(67, 97, 238, 0) 0%, 
        rgba(67, 97, 238, 0.3) 50%, 
        rgba(67, 97, 238, 0) 100%);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.admin-portal-btn:hover {
    background: rgba(67, 97, 238, 0.25);
    box-shadow: 0 0 15px rgba(67, 97, 238, 0.3);
    transform: translateY(-2px);
}

.admin-portal-btn:hover .admin-btn-glow {
    transform: translateX(100%);
}

.admin-portal-btn:hover i {
    transform: scale(1.1);
}

.footer-bottom {
    text-align: center;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.85rem;
}

@media (min-width: 768px) {
    .footer-top {
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-start;
    }
    
    .footer-brand {
        align-items: flex-start;
        text-align: left;
    }
    
    .footer-social {
        text-align: right;
        width: auto;
    }
    
    .footer-heading::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    .footer-middle {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    
    .footer-contact {
        text-align: left;
        width: auto;
    }
    
    .contact-list li {
        justify-content: flex-start;
    }
    
    .social-icons {
        justify-content: flex-end;
    }
}
</style>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggleBtn');
            const icon = themeToggle.querySelector('i');
            const html = document.documentElement;
            
            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                html.setAttribute('data-bs-theme', 'dark');
                icon.classList.remove('bi-moon');
                icon.classList.add('bi-sun');
            }
            
            // Toggle theme
            themeToggle.addEventListener('click', function() {
                const isDark = html.getAttribute('data-bs-theme') === 'dark';
                
                if (isDark) {
                    html.setAttribute('data-bs-theme', 'light');
                    icon.classList.remove('bi-sun');
                    icon.classList.add('bi-moon');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.setAttribute('data-bs-theme', 'dark');
                    icon.classList.remove('bi-moon');
                    icon.classList.add('bi-sun');
                    localStorage.setItem('theme', 'dark');
                }
            });
        });
    </script>

    <!-- Password Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-toggle');
                    const target = document.getElementById(targetId);
                    const icon = this.querySelector('i');
                    
                    if (target.type === 'password') {
                        target.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        target.type = 'password';
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    }
                });
            });
        });
    </script>

<!-- Mark Notifications Read -->
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Mark single notification as read
    document.querySelectorAll(".mark-as-read").forEach(item => {
        item.addEventListener("click", function (e) {
            const id = this.dataset.id;
            fetch(`/notifications/${id}/read`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})
            }).then(() => {
                // Optionally update UI or let it redirect
            }).catch(err => console.error(err));
        });
    });

    // Mark all as read
    const markAll = document.querySelector(".mark-all-read");
    if (markAll) {
        markAll.addEventListener("click", function (e) {
            e.preventDefault();
            fetch(`/notifications/read-all`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})
            }).then(() => {
                location.reload();
            }).catch(err => console.error(err));
        });
    }
});
</script>
@endpush


    @stack('scripts')
</body>
</html>