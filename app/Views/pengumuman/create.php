<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <?php if (session()->get('role') === 'admin'): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <strong>Perhatian:</strong> TinyMCE memerlukan API key yang valid untuk penggunaan Cloud CDN.
            Mohon admin cek API key di konfigurasi TinyMCE.
            <a href="https://www.tiny.cloud/docs/" target="_blank" rel="noopener">Klik di sini untuk info</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form action="/kelola-pengumuman/store" method="post" enctype="multipart/form-data" class="card p-4">
        <?= csrf_field() ?>
        <input type="hidden" name="author" value="<?= session()->get('username') ?? '' ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= old('title') ?>" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug (otomatis)</label>
            <input type="text" id="slug" class="form-control" readonly value="<?= old('slug', '') ?>">
        </div>

        <!-- Excerpt field removed (not present in pengumuman table) -->

        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea name="content" id="content" rows="10" class="form-control d-none"><?= old('content') ?></textarea>
            <div id="quillEditor" style="height: 400px;"><?= old('content') ?></div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">
            <img id="imgPreview" alt="Preview gambar" style="max-width: 300px; margin-top: .5rem; display: none;">
        </div>

        <div class="mb-3">
            <label for="source" class="form-label">Sumber</label>
            <input type="text" name="source" id="source" class="form-control" value="<?= old('source') ?>">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="draft" <?= old('status') == 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= old('status') == 'published' ? 'selected' : '' ?>>Published</option>
                </select>
            </div>
            <!-- tanggal -->
            <div class="col-md-6 mb-3">
                <label for="tanggal" class="form-label">Tanggal Pengumuman</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"
                    value="<?= old('tanggal', date('Y-m-d')) ?>">
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/kelola-pengumuman" class="btn btn-secondary">Batal</a>
        </div>
    </form>

    <!-- Quill Editor (no API key required) -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill = new Quill('#quillEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        // Initialize editor content from hidden textarea
        (function () {
            var contentInput = document.getElementById('content');
            if (contentInput && contentInput.value.trim() !== '') {
                quill.root.innerHTML = contentInput.value;
            }

            // copy HTML back to textarea before submit
            var form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function () {
                    contentInput.value = quill.root.innerHTML;
                });
            }
        })();

        // Live-generate slug from title for display
        function slugify(text) {
            return text.toString().toLowerCase().trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }

        var titleInput = document.getElementById('title');
        var slugInput = document.getElementById('slug');
        if (titleInput && slugInput) {
            var setSlug = function () { slugInput.value = slugify(titleInput.value || ''); };
            titleInput.addEventListener('input', setSlug);
            // initialize on load
            setSlug();
        }

        document.getElementById('image').addEventListener('change', function () {
            const file = this.files && this.files[0];
            const img = document.getElementById('imgPreview');
            if (!file) { img.style.display = 'none'; img.src = ''; return; }
            const reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    </script>
</div>

<?php echo view('templates/partials') ?>
<?php $this->endSection(); ?>