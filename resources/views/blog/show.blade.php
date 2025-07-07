@extends('layouts.app')

@section('title', $blog->title)

@push('css')
<style>
    .hero-blog {
        background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0,0,0,0.6)),
                    url('{{ asset('storage/' . $blog->thumbnail) }}') center center/cover no-repeat;
        color: #fff;
        padding: 5rem 1rem;
        text-align: center;
        border-radius: 0.75rem;
        margin-bottom: 2rem;
    }
    .hero-blog h1 {
        font-weight: bold;
        font-size: 2.5rem;
    }
    .hero-meta {
        font-size: 0.95rem;
        color: #e0e0e0;
        margin-top: 0.5rem;
    }
    .blog-content p {
        font-size: 1.1rem;
        line-height: 1.8;
    }
    .back-btn {
        text-decoration: none;
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
<div class="container py-2">
    <a href="{{ route('blog.index') }}" class="back-btn text-primary d-inline-block mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Artikel
    </a>
</div>

<div class="container hero-blog">
    <h1>{{ $blog->title }}</h1>
    <div class="hero-meta">
        <i class="bi bi-calendar3"></i>
        Dipublikasikan: {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->translatedFormat('d M Y') : '-' }}
    </div>
</div>

<div class="container blog-content pb-5">
    {!! $blog->content !!}
</div>
@endsection
