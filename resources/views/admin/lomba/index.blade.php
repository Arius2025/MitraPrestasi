@extends('adminlte::page')

@section('title', 'Data Lomba')

@section('content_header')
    <h1>Data Lomba</h1>
@endsection

@section('content')
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Berhasil">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <a href="{{ route('admin.lomba.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Tambah Lomba</a>


    <x-adminlte-datatable id="tableLomba" :heads="['#', 'Judul', 'Kategori', 'Tanggal', 'Link', 'Aksi']" striped hoverable>
    @foreach($lombas as $lomba)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lomba->title }}</td>
            <td>
                @foreach(json_decode($lomba->categories ?? '[]') as $kategori)
                    <span class="badge bg-primary">{{ strtoupper($kategori) }}</span>
                @endforeach
            </td>
            <td>{{ $lomba->registration_date }} s.d. {{ $lomba->competition_date }}</td>
            <td>
                @if($lomba->link)
                    <a href="{{ $lomba->link }}" target="_blank" class="btn btn-sm btn-info">
                        🌐 Buka Link
                    </a>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.lomba.edit', $lomba->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.lomba.destroy', $lomba->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button label="Hapus" theme="danger" icon="fas fa-trash" size="sm" type="submit" />
                </form>
            </td>
        </tr>
    @endforeach
</x-adminlte-datatable>

   
@endsection
