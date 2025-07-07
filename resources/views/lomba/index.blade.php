@extends('layouts.app')
@section('title', 'Daftar Lomba')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Lomba</h2>
    <p>Berikut adalah daftar lomba yang tersedia untuk SD, SMP, dan SMA.</p>

    <div class="row g-4 mt-4">
        @forelse ($lombas as $lomba)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    @if($lomba->thumbnail)
                        <img src="{{ asset('storage/' . $lomba->thumbnail) }}" class="card-img-top" alt="Gambar Lomba">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $lomba->title }}</h5>
                        <p class="card-text">{{ Str::limit($lomba->description, 100) }}</p>
                        <span class="badge bg-info text-dark">{{ strtoupper($lomba->category) }}</span>
                        <p class="text-muted small mt-2">
                            {{ \Carbon\Carbon::parse($lomba->start_date)->translatedFormat('d M Y') }} – 
                            {{ \Carbon\Carbon::parse($lomba->end_date)->translatedFormat('d M Y') }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent text-end border-0">
                        <a href="{{ route('lomba.show', $lomba->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Belum ada lomba tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
