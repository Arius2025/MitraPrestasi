@isset($blogs)
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4">Berita & Informasi Lomba</h2>
            <x-blog-gallery :blogs="$blogs" />
        </div>
    </section>
@endisset
