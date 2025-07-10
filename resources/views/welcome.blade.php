@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css" rel="stylesheet">

<style>
    /* Base Styles */
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
        --section-bg: #f8f9fa;
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('{{ asset('images/hero-bg.jpg') }}') center/cover no-repeat;
        color: #fff;
        padding: 120px 0;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
        position: relative;
        overflow: hidden;
    }

    .hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(to bottom, transparent, var(--section-bg));
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero p {
        font-size: 1.5rem;
        max-width: 700px;
        margin: 0 auto 2rem;
    }

    .hero-btn {
        padding: 0.8rem 2.5rem;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.4);
        transition: var(--transition);
        border: none;
        background-color: var(--primary-color);
        color: white;
    }

    .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.6);
        background-color: var(--secondary-color);
        color: white;
    }

    /* Section Styles */
    .section-bg {
        background-color: var(--section-bg);
    }

    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 3rem;
        font-weight: 700;
        color: var(--text-color);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--primary-color);
        border-radius: 2px;
    }

    /* Features Section */
    .feature-card {
        padding: 2rem;
        border-radius: 10px;
        transition: var(--transition);
        height: 100%;
        box-shadow: var(--shadow-sm);
        border: none;
        background-color: white;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .feature-icon {
        font-size: 3.5rem;
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 1.5rem;
    }

    .feature-card h5 {
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .feature-card p {
        color: var(--text-light);
    }

    /* Video Section */
    .video-section {
        position: relative;
        padding: 5rem 0;
        background: linear-gradient(135deg, #2b2d42, #1a1a2e);
        color: white;
        overflow: hidden;
    }

    .video-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('images/pattern.png') }}') repeat;
        opacity: 0.1;
    }

    .video-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 5px solid rgba(255,255,255,0.1);
    }

    /* Countdown Section */
    .countdown-section {
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        color: white;
        padding: 4rem 0;
    }

    .countdown-title {
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    #countdown {
        font-size: 2.5rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Testimonials Carousel */
    .testimonials-container {
        position: relative;
        padding: 0 40px;
    }

    .testimonials-slider {
        overflow: hidden;
    }

    .testimonials-track {
        display: flex;
        transition: transform 0.5s ease;
    }

    .testimonial-slide {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 15px;
    box-sizing: border-box;
    }


    .testimonial-card {
    border: none;
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    background-color: white;
    text-align: center;
    max-width: 400px;
    margin: auto;
    }

    .testimonials-track:on  ly-child,
    .testimonials-track:has(.testimonial-slide:nth-child(1):last-child) {
        justify-content: center;
        display: flex;
    }

    
    .testimonial-card > div:last-child {
        width: 100%;
        text-align: center;
        margin-top: auto;
    }

    .testimonial-card:hover {
        box-shadow: var(--shadow-md);
    }

    .testimonial-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    margin: 0 auto 1rem;
    border: 3px solid #4361ee;
    }

    .testimonial-card p {
        font-style: italic;
        color: var(--text-light);
        margin-bottom: 1.5rem;
        flex-grow: 1;
        word-wrap: break-word;
        overflow-wrap: break-word;
        text-align: center;
    }

    .testimonial-card h6 {
        font-weight: 600;
        margin-bottom: 0.2rem;
        color: var(--text-color);
        text-align: center;
    }

    .testimonial-card small {
        color: var(--text-light);
        font-size: 0.9rem;
        text-align: center;
    }

    .glider-prev, .glider-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background: rgba(67, 97, 238, 0.2);
        border-radius: 50%;
        border: none;
        color: var(--primary-color);
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        z-index: 1;
    }

    .glider-prev {
        left: 0;
    }

    .glider-next {
        right: 0;
    }

    .glider-prev:hover, .glider-next:hover {
        background: var(--primary-color);
        color: white;
    }

    .glider-dots {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .glider-dot {
        width: 12px;
        height: 12px;
        background: rgba(67, 97, 238, 0.2);
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
        transition: var(--transition);
        border: none;
    }

    .glider-dot.active {
        background: var(--primary-color);
    }

    /* News Section */
    .news-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        background-color: white;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .news-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .news-body {
        padding: 1.5rem;
    }

    .news-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-color);
    }

    .news-text {
        color: var(--text-light);
        margin-bottom: 1.5rem;
    }

    .news-link {
        font-weight: 600;
        color: var(--primary-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .news-link:hover {
        color: var(--secondary-color);
    }

    /* Pagination */
    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .pagination .page-link {
        color: var(--primary-color);
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .hero h1 {
            font-size: 2.8rem;
        }
        
        .hero p {
            font-size: 1.2rem;
        }
        
        .testimonial-slide {
            flex: 0 0 50%;
        }
        
        .testimonial-card p {
            -webkit-line-clamp: 3;
            min-height: 5em;
        }
    }

    @media (max-width: 768px) {
        .hero {
            padding: 80px 0;
        }
        
        .hero h1 {
            font-size: 2.2rem;
        }
        
        .hero p {
            font-size: 1.1rem;
        }
        
        .hero-btn {
            font-size: 1rem;
            padding: 0.6rem 1.8rem;
        }
        
        #countdown {
            font-size: 1.8rem;
        }
        
        .testimonial-slide {
            flex: 0 0 100%;
        }
        
        .testimonial-card p {
            -webkit-line-clamp: 2;
            min-height: 4em;
        }
    }

    @media (max-width: 576px) {
        .hero h1 {
            font-size: 1.8rem;
        }
        
        .testimonials-container {
            padding: 0 20px;
        }
    }

    /* Dark Mode Adjustments */
    [data-bs-theme="dark"] {
        --section-bg: #1e1e1e;
        --text-color: #e0e0e0;
        --text-light: #aaa;
    }

    [data-bs-theme="dark"] .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
                    url('{{ asset('images/hero-bg.jpg') }}') center/cover no-repeat;
    }

    [data-bs-theme="dark"] .hero::after {
        background: linear-gradient(to bottom, transparent, var(--section-bg));
    }

    [data-bs-theme="dark"] .feature-card,
    [data-bs-theme="dark"] .testimonial-card,
    [data-bs-theme="dark"] .news-card {
        background-color: #2a2a2a;
        border: 1px solid #333;
    }

    [data-bs-theme="dark"] .feature-card h5,
    [data-bs-theme="dark"] .testimonial-card h6,
    [data-bs-theme="dark"] .news-title {
        color: #e0e0e0;
    }

    [data-bs-theme="dark"] .feature-card p,
    [data-bs-theme="dark"] .testimonial-card p,
    [data-bs-theme="dark"] .news-text {
        color: var(--text-light) !important;
    }

    [data-bs-theme="dark"] .section-title {
        color: #e0e0e0;
    }

    [data-bs-theme="dark"] .section-title::after {
        background: var(--accent-color);
    }

    [data-bs-theme="dark"] .video-section {
        background: linear-gradient(135deg, #1a1a1e, #121216);
    }

    [data-bs-theme="dark"] .text-muted {
        color: var(--text-light) !important;
    }
</style>

<!-- Hero Section -->
<section class="hero text-center" data-aos="fade">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Welcome to EventHub</h1>
        <p class="lead mb-5">Discover and book the most exciting events happening around Abuja</p>
        <a href="{{ route('events.index') }}" class="btn hero-btn">Explore Events</a>
    </div>
</section>

<!-- About Section -->
<section class="py-5 section-bg" data-aos="fade-up">
    <div class="container text-center py-5">
        <h2 class="section-title">About Us</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead text-muted">EventHub is your premier destination for discovering and booking events in Nigeria and anywhere around the world. From concerts and conferences to workshops and cultural festivals, we bring you the best experiences all events have to offer.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Choose Us?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center">
                    <i class="bi bi-ticket-perforated feature-icon"></i>
                    <h5>Easy Ticketing</h5>
                    <p>Secure your spot with our seamless booking process and instant QR code tickets delivered to your device.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center">
                    <i class="bi bi-calendar-event feature-icon"></i>
                    <h5>Curated Events</h5>
                    <p>We handpick the best events in Abuja so you don't have to sift through endless options.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card text-center">
                    <i class="bi bi-shield-check feature-icon"></i>
                    <h5>Trusted Partners</h5>
                    <p>All our event organizers are vetted to ensure quality experiences for our users.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="video-section py-5" data-aos="fade-up">
    <div class="container py-5 text-center">
        <h2 class="mb-5">Discover What We Offer</h2>
        <div class="video-container mx-auto" style="max-width: 800px;">
            <video controls style="width: 100%; border-radius: 10px;">
                <source src="{{ asset('videos/promo.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>


<!-- Countdown Section -->
<section class="countdown-section text-center" data-aos="fade-up">
    <div class="container py-4">
        <h3 class="countdown-title">
            @if($nextEvent)
                Next Event: <strong>{{ $nextEvent->title }}</strong> starts in:
            @else
                Check back soon for upcoming events!
            @endif
        </h3>
        @if($nextEvent)
            <div id="countdown" class="mb-3"></div>
            <a href="{{ route('events.show', $nextEvent->id) }}" class="btn btn-outline-light">Event Details</a>
        @endif
    </div>
</section>

<!-- Testimonials Section -->
<!-- Testimonials Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="section-title">What Our Users Say</h2>
        </div>

        @if($testimonials->isEmpty())
            <div class="text-center">
                <div class="testimonial-card mx-auto" style="max-width: 500px;">
                    <div class="testimonial-img bg-light d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-fill" style="font-size: 2rem; color: #666;"></i>
                    </div>
                    <p class="mt-4 mb-4">"No testimonials available yet. Check back later!"</p>
                    <div>
                        <h6>Admin</h6>
                        <small>EventHub</small>
                    </div>
                </div>
            </div>
        @elseif($testimonials->count() === 1)
            <div class="d-flex justify-content-center">
                <div class="testimonial-card">
                    @if($testimonials[0]->image)
                        <img src="{{ asset('storage/'.$testimonials[0]->image) }}" class="testimonial-img" alt="{{ $testimonials[0]->name }}">
                    @else
                        <div class="testimonial-img bg-light d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-fill" style="font-size: 2rem; color: #666;"></i>
                        </div>
                    @endif
                    <p class="mb-4">"{{ $testimonials[0]->message }}"</p>
                    <div>
                        <h6>{{ $testimonials[0]->name }}</h6>
                        @if($testimonials[0]->position)
                            <small>{{ $testimonials[0]->position }}</small>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="position-relative testimonials-wrapper">
                <button class="glider-prev" aria-label="Previous">«</button>

                <div class="glider">
                    @foreach($testimonials as $t)
                        <div class="testimonial-card mx-2">
                            @if($t->image)
                                <img src="{{ asset('storage/'.$t->image) }}" class="testimonial-img" alt="{{ $t->name }}">
                            @else
                                <div class="testimonial-img bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-fill" style="font-size: 2rem; color: #666;"></i>
                                </div>
                            @endif
                            <p class="mb-4">"{{ $t->message }}"</p>
                            <div>
                                <h6>{{ $t->name }}</h6>
                                @if($t->position)
                                    <small>{{ $t->position }}</small>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="glider-next" aria-label="Next">»</button>
                <div class="glider-dots mt-4"></div>
            </div>
        @endif
    </div>
</section>


<!-- Latest News Section -->
<section class="py-5 section-bg">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Latest News</h2>
        </div>
        
        @if(!empty($news) && count($news) > 0)
            <div id="news-container" class="row g-4"></div>
            <nav aria-label="News Pagination" class="mt-5">
                <ul id="pagination" class="pagination justify-content-center"></ul>
            </nav>
        @else
            <div class="text-center">
                <p class="text-muted">No news articles available at the moment.</p>
            </div>
        @endif
    </div>
</section>

<!-- Countdown JS -->
@if($nextEvent)
<script>
    const countdownEl = document.getElementById('countdown'),
        eventTime = new Date("{{ $nextEvent->date_time }}").getTime();
    
    function updateCountdown() {
        const diff = eventTime - Date.now();
        
        if (diff <= 0) {
            countdownEl.textContent = 'Event is Live!';
            return;
        }
        
        const d = Math.floor(diff / 864e5),
              h = Math.floor(diff / 36e5) % 24,
              m = Math.floor(diff / 6e4) % 60,
              s = Math.floor(diff / 1e3) % 60;
        
        countdownEl.innerHTML = `
            <span class="countdown-item">${d}<small>d</small></span>
            <span class="countdown-item">${h}<small>h</small></span>
            <span class="countdown-item">${m}<small>m</small></span>
            <span class="countdown-item">${s}<small>s</small></span>
        `;
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
</script>
@endif

<!-- Testimonials Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>
<!-- Glider.js CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>
@if($testimonials->count() > 1)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const glider = new Glider(document.querySelector('.glider'), {
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: true,
            dots: '.glider-dots',
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            },
            responsive: [
                {
                    breakpoint: 768,
                    settings: { slidesToShow: 1 }
                },
                {
                    breakpoint: 992,
                    settings: { slidesToShow: 2 }
                },
                {
                    breakpoint: 1200,
                    settings: { slidesToShow: 3 }
                }
            ]
        });

        // Auto-scroll every 5 seconds
        let interval = setInterval(() => {
            glider.scrollItem('next');
        }, 5000);

        document.querySelector('.testimonials-wrapper').addEventListener('mouseenter', () => clearInterval(interval));
        document.querySelector('.testimonials-wrapper').addEventListener('mouseleave', () => {
            interval = setInterval(() => glider.scrollItem('next'), 5000);
        });
    });
</script>
@endif


<!-- News Pagination JS -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const news = @json($news);
        const itemsPerPage = 6;
        let currentPage = 1;
        const newsContainer = document.getElementById("news-container");
        const paginationContainer = document.getElementById("pagination");

        function renderPage(page) {
            newsContainer.style.opacity = 0;
            setTimeout(() => {
                newsContainer.innerHTML = "";
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const pageItems = news.slice(start, end);

                pageItems.forEach(item => {
                    const col = document.createElement("div");
                    col.className = "col-md-4";
                    
                    const card = document.createElement("div");
                    card.className = "news-card h-100";
                    
                    if (item.urlToImage) {
                        const img = document.createElement("img");
                        img.src = item.urlToImage;
                        img.className = "news-img";
                        img.alt = item.title;
                        card.appendChild(img);
                    }
                    
                    const body = document.createElement("div");
                    body.className = "news-body";
                    
                    const title = document.createElement("h5");
                    title.className = "news-title";
                    title.textContent = item.title;
                    
                    const desc = document.createElement("p");
                    desc.className = "news-text";
                    desc.textContent = item.description || "No description available.";
                    
                    const link = document.createElement("a");
                    link.href = item.url;
                    link.target = "_blank";
                    link.className = "news-link";
                    link.textContent = "Read more →";
                    
                    body.appendChild(title);
                    body.appendChild(desc);
                    body.appendChild(link);
                    card.appendChild(body);
                    col.appendChild(card);
                    newsContainer.appendChild(col);
                });

                newsContainer.style.opacity = 1;
            }, 300);
        }

        function setupPagination() {
            paginationContainer.innerHTML = "";
            const pageCount = Math.ceil(news.length / itemsPerPage);
            
            if (pageCount <= 1) return;
            
            // Previous button
            const prevLi = document.createElement("li");
            prevLi.className = "page-item" + (currentPage === 1 ? " disabled" : "");
            const prevA = document.createElement("a");
            prevA.className = "page-link";
            prevA.href = "#";
            prevA.innerHTML = "&laquo;";
            prevA.addEventListener("click", (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    renderPage(currentPage);
                    setupPagination();
                }
            });
            prevLi.appendChild(prevA);
            paginationContainer.appendChild(prevLi);
            
            // Page numbers
            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement("li");
                li.className = "page-item" + (i === currentPage ? " active" : "");
                const a = document.createElement("a");
                a.className = "page-link";
                a.href = "#";
                a.textContent = i;
                a.addEventListener("click", (e) => {
                    e.preventDefault();
                    currentPage = i;
                    renderPage(currentPage);
                    setupPagination();
                });
                li.appendChild(a);
                paginationContainer.appendChild(li);
            }
            
            // Next button
            const nextLi = document.createElement("li");
            nextLi.className = "page-item" + (currentPage === pageCount ? " disabled" : "");
            const nextA = document.createElement("a");
            nextA.className = "page-link";
            nextA.href = "#";
            nextA.innerHTML = "&raquo;";
            nextA.addEventListener("click", (e) => {
                e.preventDefault();
                if (currentPage < pageCount) {
                    currentPage++;
                    renderPage(currentPage);
                    setupPagination();
                }
            });
            nextLi.appendChild(nextA);
            paginationContainer.appendChild(nextLi);
        }

        renderPage(currentPage);
        setupPagination();
    });
</script>

<!-- AOS Animation -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-out-quad'
    });
</script>

@endsection