@extends('layouts.app')
@section('title', $lomba->title)

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- Thumbnail --}}
        <div class="col-md-5 mb-4">
            @if ($lomba->thumbnail)
                <img src="{{ asset('storage/' . $lomba->thumbnail) }}" class="img-fluid rounded shadow-sm" alt="Gambar Lomba">
            @else
                <div class="bg-light text-center py-5 border rounded">Tidak ada gambar</div>
            @endif
        </div>

        {{-- Detail --}}
        <div class="col-md-7">
            <h2>{{ $lomba->title }}</h2>
            <span class="badge bg-warning text-dark mb-2">{{ strtoupper($lomba->category) }}</span>
            <p class="text-muted small mb-2">
                Tanggal: {{ \Carbon\Carbon::parse($lomba->start_date)->translatedFormat('d M Y') }} –
                {{ \Carbon\Carbon::parse($lomba->end_date)->translatedFormat('d M Y') }}
            </p>
            <p class="mt-3">{{ $lomba->description }}</p>

            <a href="{{ route('lomba.index') }}" class="btn btn-outline-secondary mt-3">← Kembali ke Daftar Lomba</a>
        </div>
    </div>
</div>
@endsection
