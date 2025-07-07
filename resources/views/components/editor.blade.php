@props(['name' => 'content', 'value' => ''])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ ucfirst($name) }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}">{{ old($name, $value) }}</textarea>
</div>

@once
    @push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      window.initTinyEditors = function () {
        document.querySelectorAll('textarea[id^="content"], textarea.tinymce').forEach((el) => {
          if (!el.classList.contains('tinymce-applied')) {
            tinymce.init({
              target: el,
              plugins: 'image link media table code lists preview fullscreen',
              toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | preview fullscreen code',
              height: 500,
              menubar: true,
              automatic_uploads: true,
              images_upload_url: '{{ route("admin.blog.upload") }}',
              images_upload_credentials: true,
              file_picker_types: 'image',
              file_picker_callback: (cb, value, meta) => {
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = () => {
                  const file = input.files[0];
                  const reader = new FileReader();
                  reader.onload = () => cb(reader.result, { title: file.name });
                  reader.readAsDataURL(file);
                };
                input.click();
              },
              setup: (editor) => {
                editor.on('init', () => {
                  editor.targetElm.classList.add('tinymce-applied');
                });
              }
            });
          }
        });
      };

      document.addEventListener('DOMContentLoaded', window.initTinyEditors);
    </script>
    @endpush
@endonce
