<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <form action="<?= site_url('kelola-pengumuman/' . $pengumuman['id_pengumuman']) ?>" method="post"
        enctype="multipart/form-data" class="card p-4">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= esc($pengumuman['title']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug (otomatis)</label>
            <input type="text" id="slug" class="form-control" readonly value="<?= esc($pengumuman['slug']) ?>">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea name="content" id="content" rows="10"
                class="form-control d-none"><?= old('content', $pengumuman['content']) ?></textarea>
            <div id="quillEditor" style="height: 400px;"><?= old('content', $pengumuman['content']) ?></div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">
            <?php if (!empty($pengumuman['image'])): ?>
                <img id="imgPreview" src="<?= base_url($pengumuman['image']) ?>" alt="Preview gambar"
                    style="max-width: 300px; margin-top: .5rem; display: block;">
            <?php else: ?>
                <img id="imgPreview" alt="Preview gambar" style="max-width: 300px; margin-top: .5rem; display: none;">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="source" class="form-label">Sumber</label>
            <input type="text" name="source" id="source" class="form-control"
                value="<?= old('source', $pengumuman['source']) ?>">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="draft" <?= old('status', $pengumuman['status']) == 'draft' ? 'selected' : '' ?>>Draft
                    </option>
                    <option value="published" <?= old('status', $pengumuman['status']) == 'published' ? 'selected' : '' ?>>
                        Published</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal" class="form-label">Tanggal Berita</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"
                    value="<?= old('tanggal', date('Y-m-d', strtotime($pengumuman['tanggal']))) ?>">
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/kelola-artikel" class="btn btn-secondary">Batal</a>
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

        (function () {
            var contentInput = document.getElementById('content');
            if (contentInput && contentInput.value.trim() !== '') {
                quill.root.innerHTML = contentInput.value;
            }

            var form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function () {
                    contentInput.value = quill.root.innerHTML;
                });
            }
        })();

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