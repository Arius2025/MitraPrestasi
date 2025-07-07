@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Artikel Terbaru</h1>
    <div class="row">
        @foreach($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}</p>
                        <a href="{{ route('blog.show', $blog) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $blogs->links() }}
</div>
@endsection
