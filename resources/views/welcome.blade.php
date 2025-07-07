@extends('layouts.app')

@section('title', 'Beranda')

@push('css')
<style>
    #carouselHero .carousel-item img {
        object-fit: cover;
        height: 360px;
        width: 100%;
        border-radius: 0.75rem;
    }

    .carousel-caption {
        bottom: 1rem;
        background: rgba(0,0,0,0.5);
        padding: 1rem;
        border-radius: 0.5rem;
        max-width: 90%;
    }

    .section-title {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.5rem;
    }

    .section-lomba {
        background-color: #fefce8;
        border: 1px solid #fef3c7;
        padding: 2rem 1rem;
        border-radius: 1rem;
        margin-bottom: 3rem;
        color: #1f2937;
    }

    .info-icon {
        font-size: 2.5rem;
    }

    .info-panel {
        background: linear-gradient(to right, #fdf6c8, #fffdea);
        border-radius: 1rem;
        padding: 2.5rem 1rem;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        margin-bottom: 4rem;
    }

    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
</style>
@endpush

@section('content')
<div class="container pt-4">
    {{-- Carousel --}}
    <div id="carouselHero" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>🏆 Prestasi Hebat Dimulai dari Semangat</h5>
                    <p>Gabung dan ikuti berbagai kompetisi menarik di Mitra Prestasi</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>📰 Artikel yang Mencerahkan</h5>
                    <p>Dapatkan wawasan dan inspirasi dari berbagai tulisan berkualitas</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>🌟 Raih Mimpimu Bersama Kami</h5>
                    <p>Mitra Prestasi siap mendukung langkahmu menuju masa depan hebat</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Info Panel --}}
    <section class="info-panel text-center" data-aos="fade-up">
        <div class="row">
            <div class="col-md-4 mb-4">
                <i class="bi bi-award info-icon text-primary"></i>
                <h5 class="mt-3 fw-semibold">Ajang Nasional</h5>
                <p>Lomba resmi dan terverifikasi untuk seluruh jenjang pendidikan.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bi bi-people info-icon text-success"></i>
                <h5 class="mt-3 fw-semibold">Peserta Aktif</h5>
                <p>Ribuan siswa dari berbagai daerah ikut berpartisipasi setiap tahun.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bi bi-journal-check info-icon text-warning"></i>
                <h5 class="mt-3 fw-semibold">E-Sertifikat</h5>
                <p>Setiap peserta mendapatkan sertifikat digital resmi.</p>
            </div>
        </div>
    </section>

{{-- CTA --}} <section class="text-center py-4 mb-5" data-aos="fade-up"> <div class="container"> <h4 class="fw-bold">Temukan kompetisi yang cocok untukmu</h4> <p class="text-muted mb-4">Kami memiliki beragam pilihan lomba menarik setiap bulannya.</p> <a href="{{ url('/blog') }}" class="btn btn-warning btn-lg shadow-sm"> <i class="bi bi-search"></i> Jelajahi Semua Artikel </a> </div> </section>


    {{-- Lomba Terkini --}}
    <div class="section-lomba" data-aos="fade-up">
        <h3 class="section-title mb-4"><i class="bi bi-trophy-fill text-dark"></i> Lomba Terkini</h3>
        <div class="row">
            @forelse($lombas as $lomba)
                <div class="col-md-4 mb-4" data-aos="zoom-in">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        @if($lomba->thumbnail)
                            <img src="{{ url('thumbnail/' . $lomba->thumbnail) }}" class="card-img-top" alt="{{ $lomba->title }}" style="height: 180px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-award-fill text-warning"></i> {{ $lomba->title }}</h5>
                            <p class="card-text text-muted small">
                                {{ \Illuminate\Support\Str::limit(strip_tags($lomba->description), 100) }}
                            </p>
                            <span class="badge bg-dark text-white">
                                📅 {{ \Carbon\Carbon::parse($lomba->registration_date)->translatedFormat('d M Y') }} – {{ \Carbon\Carbon::parse($lomba->competition_date)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            @if($lomba->link)
                                <a href="{{ $lomba->link }}" target="_blank" class="btn btn-outline-dark btn-sm w-100">✨ Ikuti Sekarang</a>
                            @else
                                <button class="btn btn-outline-secondary btn-sm w-100" disabled>⛔ Link belum tersedia</button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada lomba aktif.</p>
            @endforelse
        </div>
    </div>

    {{-- Artikel --}}
    <h3 class="section-title mb-3" data-aos="fade-right"><i class="bi bi-journal-text text-primary"></i> Artikel Terbaru</h3>
    <div class="mb-4" data-aos="fade-left">
        <input type="text" id="searchInput" class="form-control" placeholder="🔎 Cari artikel...">
    </div>
    <div id="blogResult">
        @include('partials.blog-list', ['blogs' => $blogs])
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    AOS.init();
    $('#searchInput').on('keyup', function () {
        const q = $(this).val();
        if (q.length < 1) return;
        $.get("{{ route('blog.index') }}", { q }, function (data) {
            $('#blogResult').html($(data).find('#blogResult').html());
        });
    });
</script>
@endpush
