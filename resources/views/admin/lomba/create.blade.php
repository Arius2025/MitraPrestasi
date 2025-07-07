@extends('adminlte::page')
@section('title', 'Tambah Lomba')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Tambah Lomba Baru</h3>
    <form action="{{ route('admin.lomba.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.lomba._form', ['submit' => 'Simpan'])
    </form>
</div>
@endsection
