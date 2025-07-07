@extends('adminlte::page')

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    ClassicEditor
      .create(document.querySelector('#content'), {
        toolbar: {
          items: [
            'undo', 'redo', '|',
            'heading', '|',
            'bold', 'italic', 'underline', 'strikethrough', '|',
            'link', 'bulletedList', 'numberedList', '|',
            'blockQuote', 'insertTable', 'mediaEmbed', '|',
            'imageUpload', 'codeBlock', 'fullscreen'
          ]
        },
        ckfinder: {
          uploadUrl: '{{ route("admin.blog.upload") }}?_token={{ csrf_token() }}'
        }
      })
      .catch(error => {
        console.error('CKEditor Error:', error);
      });
  });
</script>
@endpush


@section('title', 'Tambah Blog')

@section('content_header')
    <h1>Tambah Blog</h1>
@endsection

@section('content')
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-adminlte-input name="title" label="Judul" placeholder="Judul blog" value="{{ old('title') }}" required />

        <div class="mb-3">
    <label for="content" class="form-label">Konten</label>
    <textarea id="content" name="content" class="form-control" rows="10">{{ old('content', $blog->content ?? '') }}</textarea>
</div>


        <x-adminlte-input-file name="thumbnail" label="Thumbnail" accept="image/*" />

        <x-adminlte-input name="published_at" label="Tanggal Publikasi" type="date" value="{{ old('published_at') }}" />

        <x-adminlte-button label="Simpan" theme="success" icon="fas fa-save" type="submit" />
    </form>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#content',
    plugins: 'lists link image preview code',
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image | preview code',
    height: 400,
    menubar: false
  });
</script>
@endpush
