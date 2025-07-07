<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Mitra Prestasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- AOS Animation --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Global Styles --}}
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            color: #1f2937;
            background: linear-gradient(to bottom, #e0f2fe, #fefce8);
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(to right, #f59e0b, #fcd34d);
            z-index: 1050; /* Agar berada di atas carousel */
        }

        .navbar-brand img {
            height: 36px;
            border-radius: 50%;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #1a202c !important;
            font-weight: 600;
        }

        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }

        /* Carousel Caption */
        .carousel-caption {
            background: rgba(0,0,0,0.4);
            padding: 1rem;
            border-radius: 0.5rem;
        }

        /* Card Hover */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background-color: #f9f9f9;
        }

        /* Scroll Button */
        .scroll-top-btn {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 999;
            background: #005fa3;
            color: white;
            border-radius: 50%;
            border: none;
            padding: 0.6rem 0.75rem;
            font-size: 1.25rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            display: none;
        }

        .scroll-top-btn:hover {
            background-color: #004c8a;
        }

        footer {
            font-size: 0.9rem;
        }
    </style>

    @stack('css')
</head>
<body class="d-flex flex-column min-vh-100">

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Mitra Prestasi">
            Mitra Prestasi
        </a>
        <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link px-3" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="/blog">Artikel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Konten --}}
<main class="flex-fill pt-4 pb-4">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="text-center text-muted py-3 mt-auto">
    &copy; {{ now()->year }} Mitra Prestasi — Kolaborasi untuk Masa Depan Hebat
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- AOS --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

{{-- Carousel Auto Play --}}
<script>
    const carousel = document.querySelector('#carouselHero');
    if (carousel) {
        new bootstrap.Carousel(carousel, {
            interval: 5000,
            ride: 'carousel'
        });
    }
</script>

{{-- Scroll to Top --}}
<script>
    const scrollBtn = document.createElement('button');
    scrollBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
    scrollBtn.classList.add('scroll-top-btn');
    scrollBtn.id = 'scrollTopBtn';
    document.body.appendChild(scrollBtn);

    window.onscroll = () => {
        scrollBtn.style.display = window.scrollY > 300 ? "block" : "none";
    };

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

@stack('scripts')
</body>
</html>
