@php
    // Persiapan variabel
    $title = old('title', $lomba->title ?? '');
    $description = old('description', $lomba->description ?? '');
    $registration = old('registration_date', $lomba->registration_date ?? '');
    $competition = old('competition_date', $lomba->competition_date ?? '');
    $selectedCategories = old('categories', $lomba->categories ?? []);
@endphp
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif
{{-- Judul --}}
<x-adminlte-input name="title" label="Judul Lomba" value="{{ $title }}" required />

{{-- Deskripsi --}}
<x-adminlte-textarea name="description" label="Deskripsi" rows="4" required>
    {{ $description }}
</x-adminlte-textarea>

{{-- Kategori Multi Pilih --}}
@php
    $selectedCategories = old('categories', $lomba->categories ?? []);
    $kategoriList = ['sd', 'smp', 'sma'];
@endphp

<x-category-checkbox :selected="old('categories', $lomba->categories ?? [])" />



{{-- Jadwal --}}
<div class="row">
    <div class="col-md-6">
        <x-adminlte-input name="registration_date" label="Tanggal Pendaftaran" type="date"
            value="{{ $registration }}" required />
    </div>
    <div class="col-md-6">
        <x-adminlte-input name="competition_date" label="Tanggal Lomba" type="date"
            value="{{ $competition }}" required />
    </div>
</div>

<x-adminlte-input name="link" label="Link Lomba (Opsional)" placeholder="https://example.com/lomba-keren"
                  value="{{ old('link', $lomba->link ?? '') }}" />

{{-- Upload Thumbnail --}}
<x-adminlte-input-file name="thumbnail" label="Thumbnail (Opsional)" />

@if (!empty($lomba->thumbnail))
    <img src="{{ asset('storage/' . $lomba->thumbnail) }}" alt="thumbnail"
        class="mt-2 rounded" width="120" />
@endif

{{-- Upload Banyak File --}}
<x-adminlte-input-file name="files[]" label="Upload Berkas Lomba" igroup-size="md" multiple />

{{-- Preview File --}}
@if (isset($lomba) && $lomba->files && count($lomba->files))
    <label class="form-label mt-3">Berkas yang sudah diupload:</label>
    <ul>
        @foreach($lomba->files as $file)
            <li>
                <a href="{{ asset('storage/' . $file->filename) }}" target="_blank">
                    {{ basename($file->filename) }}
                </a>
            </li>
        @endforeach
    </ul>
@endif

<x-adminlte-button label="{{ $submit }}" theme="primary" icon="fas fa-save" class="mt-3" type="submit" />
    <a href="{{ route('admin.lomba.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</form>
