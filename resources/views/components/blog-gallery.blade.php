<div class="row">
    @forelse($blogs as $blog)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($blog->thumbnail)
                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="card-img-top" alt="thumbnail">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                    <a href="{{ route('admin.blog.show', $blog->id) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada informasi lomba yang tersedia.</p>
    @endforelse
</div>
