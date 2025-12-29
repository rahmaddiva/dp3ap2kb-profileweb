<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Tambah Media</h3>
        <a href="<?= site_url('/kelola-media') ?>" class="btn btn-secondary">Kembali</a>
    </div>

    <?php $errors = session()->getFlashdata('errors') ?? (isset($errors) ? $errors : null); ?>
    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?= site_url('/kelola-media/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= old('title') ?>"
                        required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="foto" <?= old('kategori') === 'foto' ? 'selected' : '' ?>>Foto</option>
                            <option value="video" <?= old('kategori') === 'video' ? 'selected' : '' ?>>Video</option>
                            <option value="infografis" <?= old('kategori') === 'infografis' ? 'selected' : '' ?>>Infografis
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                            value="<?= old('tanggal', date('Y-m-d')) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Deskripsi / Konten</label>
                    <input type="hidden" name="content" id="content" value="<?= esc(old('content')) ?>">
                    <div id="quill-editor"
                        style="min-height:220px; background:#fff; border:1px solid #dee2e6; border-radius:.375rem; padding:8px;">
                        <?= old('content') ?>
                    </div>
                    <div class="form-text">Anda bisa menambahkan deskripsi singkat atau embed untuk video (mis. link).
                    </div>
                </div>

                <div class="mb-3">
                    <label for="media_files" class="form-label">File Media (bisa lebih dari 1)</label>
                    <input type="file" name="media_files[]" id="media_files" class="form-control" multiple
                        accept="image/*,video/*,application/pdf">
                    <div id="file-info" class="form-text mt-1 text-muted">Pilih satu atau beberapa file.</div>
                </div>

                <div id="previews" class="row g-2 mb-3"></div>

                <div class="mb-3">
                    <label for="source" class="form-label">Sumber (opsional)</label>
                    <input type="text" name="source" id="source" class="form-control" value="<?= old('source') ?>">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="draft" <?= old('status') === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= old('status') === 'published' ? 'selected' : '' ?>>Published</option>
                    </select>
                </div>

                <input type="hidden" name="author" value="<?= esc(session()->get('username') ?? 'Admin') ?>">

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= site_url('/kelola-media') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quill -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    // Initialize Quill and sync to hidden input before submit
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Tulis deskripsi atau embed disini... (HTML akan disimpan)',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    var hiddenContent = document.getElementById('content');
    if (hiddenContent && hiddenContent.value) {
        quill.root.innerHTML = hiddenContent.value;
    }

    var form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function () {
            hiddenContent.value = quill.root.innerHTML;
        });
    }

    document.getElementById('media_files').addEventListener('change', function (e) {
        const files = Array.from(this.files || []);
        const info = document.getElementById('file-info');
        const previews = document.getElementById('previews');
        previews.innerHTML = '';
        info.textContent = files.length + ' file dipilih';

        files.slice(0, 20).forEach((file, idx) => {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-3';

            const card = document.createElement('div');
            card.className = 'card';

            const body = document.createElement('div');
            body.className = 'card-body p-2 text-center';

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.style.maxWidth = '100%';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.className = 'img-fluid';
                const reader = new FileReader();
                reader.onload = function (ev) { img.src = ev.target.result; };
                reader.readAsDataURL(file);
                body.appendChild(img);
            } else {
                const icon = document.createElement('div');
                icon.className = 'py-4';
                icon.textContent = file.type || 'file';
                body.appendChild(icon);
            }

            const small = document.createElement('small');
            small.className = 'd-block text-truncate mt-2';
            small.textContent = file.name;
            body.appendChild(small);

            card.appendChild(body);
            col.appendChild(card);
            previews.appendChild(col);
        });
    });
</script>

<?= $this->endSection(); ?>