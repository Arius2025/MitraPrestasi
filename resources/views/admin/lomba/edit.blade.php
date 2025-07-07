@extends('adminlte::page')
@section('title', 'Edit Lomba')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Edit Lomba</h3>
    <form action="{{ route('admin.lomba.update', $lomba->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.lomba._form', ['submit' => 'Update', 'lomba' => $lomba])
    </form>
</div>
@endsection
