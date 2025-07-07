<div class="row">
@forelse($blogs as $blog)
    <div class="col-md-4 mb-4">
        <div class="card card-hover shadow-sm h-100">
            <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="card-img-top" style="height:180px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $blog->title }}</h5>
                <p class="text-muted small">{{ \Str::limit(strip_tags($blog->content), 90) }}</p>
                <a href="{{ route('blog.show', $blog) }}" class="stretched-link text-decoration-none">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">Artikel tidak ditemukan.</p>
@endforelse
</div>
