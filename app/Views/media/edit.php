<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Edit Media</h3>
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
            <form action="<?= site_url('kelola-media/' . $media['id_media']) ?>" method="post"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="<?= old('title', $media['title']) ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="foto" <?= old('kategori', $media['kategori']) === 'foto' ? 'selected' : '' ?>>
                                Foto</option>
                            <option value="video" <?= old('kategori', $media['kategori']) === 'video' ? 'selected' : '' ?>>
                                Video</option>
                            <option value="infografis" <?= old('kategori', $media['kategori']) === 'infografis' ? 'selected' : '' ?>>Infografis</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                            value="<?= old('tanggal', $media['tanggal'] ?? date('Y-m-d')) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Deskripsi / Konten</label>
                    <input type="hidden" name="content" id="content"
                        value="<?= esc(old('content', $media['content'])) ?>">
                    <div id="quill-editor"
                        style="min-height:220px; background:#fff; border:1px solid #dee2e6; border-radius:.375rem; padding:8px;">
                        <?= old('content', $media['content']) ?></div>
                    <div class="form-text">Anda bisa menambahkan deskripsi singkat atau embed untuk video (mis. link).
                    </div>
                </div>

                <div class="mb-3">
                    <label for="media_files" class="form-label">Tambah File Media (opsional)</label>
                    <input type="file" name="media_files[]" id="media_files" class="form-control" multiple
                        accept="image/*,video/*,application/pdf">
                    <div id="file-info" class="form-text mt-1 text-muted">Pilih file baru untuk ditambahkan.</div>
                </div>

                <?php if (!empty($files)): ?>
                    <div class="mb-3">
                        <h6>File Terlampir</h6>
                        <div class="row g-3">
                            <?php foreach ($files as $f): ?>
                                <div class="col-6 col-md-4">
                                    <div class="card h-100">
                                        <div class="card-body p-2 text-center">
                                            <?php $ext = pathinfo($f['filename'], PATHINFO_EXTENSION);
                                            $mime = $f['mime'] ?? ''; ?>

                                            <?php if (strpos($mime, 'image/') === 0 || in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif'])): ?>
                                                <a href="<?= base_url($f['filepath']) ?>" target="_blank">
                                                    <img src="<?= base_url($f['filepath']) ?>" alt="<?= esc($media['title']) ?>"
                                                        style="width:100%; height:160px; object-fit:cover; border-radius:6px;">
                                                </a>
                                            <?php elseif (strpos($mime, 'video/') === 0 || in_array(strtolower($ext), ['mp4', 'webm', 'ogg'])): ?>
                                                <video controls style="width:100%; height:160px; object-fit:cover;">
                                                    <source src="<?= base_url($f['filepath']) ?>" type="<?= esc($mime) ?>">
                                                </video>
                                            <?php else: ?>
                                                <div class="d-flex align-items-center justify-content-center" style="height:160px;">
                                                    <a href="<?= base_url($f['filepath']) ?>" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">Download</a>
                                                </div>
                                            <?php endif; ?>

                                            <div class="mt-2 text-truncate" title="<?= esc($f['filename']) ?>">
                                                <?= esc($f['filename']) ?></div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="delete_files[]"
                                                    value="<?= $f['id'] ?>" id="delfile_<?= $f['id'] ?>">
                                                <label class="form-check-label small" for="delfile_<?= $f['id'] ?>">Hapus file
                                                    ini</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="source" class="form-label">Sumber (opsional)</label>
                    <input type="text" name="source" id="source" class="form-control"
                        value="<?= old('source', $media['source']) ?>">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="draft" <?= old('status', $media['status']) === 'draft' ? 'selected' : '' ?>>Draft
                        </option>
                        <option value="published" <?= old('status', $media['status']) === 'published' ? 'selected' : '' ?>>
                            Published</option>
                    </select>
                </div>

                <input type="hidden" name="author"
                    value="<?= esc(session()->get('username') ?? $media['author'] ?? 'Admin') ?>">

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
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
        const previewsContainer = document.getElementById('previews');
        if (previewsContainer) previewsContainer.innerHTML = '';
        info.textContent = files.length + ' file dipilih';

        // reuse preview logic if needed (not implemented here to keep edit view light)
    });
</script>

<?= $this->endSection(); ?>