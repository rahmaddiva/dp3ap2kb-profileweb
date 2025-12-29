<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Detail Media</h3>
        <a href="<?= site_url('/kelola-media') ?>" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?= esc($media['title']) ?></h4>
                    <p class="text-muted mb-1">Kategori: <strong><?= esc($media['kategori']) ?></strong></p>
                    <p class="text-muted mb-1">Penulis: <strong><?= esc($media['author']) ?></strong></p>
                    <p class="text-muted mb-3">Tanggal:
                        <strong><?= date('d F Y', strtotime($media['tanggal'] ?? $media['created_at'])) ?></strong>
                    </p>

                    <div class="mb-3">
                        <h6>Deskripsi</h6>
                        <div class="border p-3" style="background:#fff;">
                            <?= $media['content'] ?>
                        </div>
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

                                                <?php if (strpos($mime, 'image/') === 0 || $ext === 'webp' || in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                    <a href="<?= base_url($f['filepath']) ?>" target="_blank">
                                                        <img src="<?= base_url($f['filepath']) ?>" alt="<?= esc($media['title']) ?>"
                                                            style="width:100%; height:160px; object-fit:cover; border-radius:6px;">
                                                    </a>
                                                <?php elseif (strpos($mime, 'video/') === 0 || in_array(strtolower($ext), ['mp4', 'webm', 'ogg'])): ?>
                                                    <video controls style="width:100%; height:160px; object-fit:cover;">
                                                        <source src="<?= base_url($f['filepath']) ?>" type="<?= esc($mime) ?>">
                                                        Browser Anda tidak mendukung video tag.
                                                    </video>
                                                <?php else: ?>
                                                    <div class="d-flex align-items-center justify-content-center"
                                                        style="height:160px;">
                                                        <a href="<?= base_url($f['filepath']) ?>" target="_blank"
                                                            class="btn btn-sm btn-outline-primary">Download
                                                            <?= esc($f['filename']) ?></a>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="mt-2 text-truncate" title="<?= esc($f['filename']) ?>">
                                                    <?= esc($f['filename']) ?>
                                                </div>
                                                <div class="small text-muted"><?= number_format($f['size'] / 1024, 2) ?> KB
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <aside class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6>Informasi</h6>
                    <p class="mb-1"><strong>Status:</strong> <?= esc($media['status']) ?></p>
                    <p class="mb-1"><strong>Slug:</strong> <?= esc($media['slug']) ?></p>
                    <p class="mb-0"><strong>Dibuat:</strong> <?= $media['created_at'] ?? '-' ?></p>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php $this->endSection(); ?>