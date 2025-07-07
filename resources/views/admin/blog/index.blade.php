@extends('adminlte::page')

@section('title', 'Daftar Blog')

@push('css')
<style>
    .thumb-fixed {
        width: 120px;
        height: 80px;
        object-fit: cover;
        object-position: center;
    }
    .search-bar {
        max-width: 300px;
    }
</style>
@endpush

@section('content_header')
    <h1>Daftar Blog</h1>
@endsection

@section('content')
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Berhasil" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    {{-- Search & Add --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" class="d-flex">
            <input type="text" name="q" class="form-control form-control-sm me-2 search-bar"
                   placeholder="🔍 Cari blog..." value="{{ request('q') }}">
            <button class="btn btn-sm btn-primary">Cari</button>
        </form>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> Tambah Blog
        </a>
    </div>

    {{-- Table --}}
    <x-adminlte-datatable id="tableBlog" head-theme="light" :heads="['#', 'Judul', 'Thumbnail', 'Tanggal', 'Aksi']" striped hoverable>
        @forelse($blogs as $blog)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $blog->title }}</td>
                <td>
                    @if($blog->thumbnail)
                        <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="Thumbnail" class="img-thumbnail thumb-fixed">
                    @endif
                </td>
                <td>{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d M Y') : '-' }}</td>
                <td>
                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <x-adminlte-button theme="danger" icon="fas fa-trash" label="Hapus" size="sm" />
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-muted text-center">Belum ada blog ditemukan.</td>
            </tr>
        @endforelse
    </x-adminlte-datatable>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $blogs->withQueryString()->links() }}
    </div>
@endsection
