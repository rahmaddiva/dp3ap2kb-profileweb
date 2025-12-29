<?php $this->extend('templates/main'); ?>

<?php $this->section('meta') ?>
<?php
$metaTitle = isset($pengumuman['title']) ? $pengumuman['title'] : 'Detail Pengumuman';
$rawDesc = isset($pengumuman['content']) ? strip_tags($pengumuman['content']) : '';
$metaDescription = trim(mb_substr(preg_replace('/\s+/', ' ', $rawDesc), 0, 160));
$ogImage = !empty($pengumuman['image']) ? base_url($pengumuman['image']) : base_url('landingpage/assets/img/blog/blog-post-1.webp');
$canonical = site_url('pengumuman/' . ($pengumuman['slug'] ?? ''));
?>
<title><?= esc($metaTitle) ?> | DP3AP2KB</title>
<meta name="description" content="<?= esc($metaDescription) ?>">
<link rel="canonical" href="<?= esc($canonical) ?>">
<meta property="og:type" content="article">
<meta property="og:title" content="<?= esc($metaTitle) ?>">
<meta property="og:description" content="<?= esc($metaDescription) ?>">
<meta property="og:image" content="<?= esc($ogImage) ?>">
<meta property="og:url" content="<?= esc($canonical) ?>">
<meta name="twitter:card" content="summary_large_image">
<?php $this->endSection() ?>

<?php $this->section('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-lg-8">
            <article class="card shadow-sm mb-4">
                <?php if (!empty($pengumuman['image'])): ?>
                    <img src="<?= base_url($pengumuman['image']) ?>" class="card-img-top img-fluid"
                        alt="<?= esc($pengumuman['title']) ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h1 class="card-title mb-2"><?= esc($pengumuman['title']) ?></h1>
                    <div class="text-muted mb-3 small">
                        <span>By <?= esc($pengumuman['author']) ?></span>
                        <span class="mx-2">•</span>
                        <span><?= date('d F Y', strtotime($pengumuman['tanggal'])) ?></span>
                    </div>

                    <div class="card-text article-content">
                        <?= $pengumuman['content'] ?>
                    </div>

                    <?php if (!empty($pengumuman['source'])): ?>
                        <p class="mt-4"><strong>Sumber:</strong> <?= esc($pengumuman['source']) ?></p>
                    <?php endif; ?>

                    <div class="mt-4 d-flex gap-2">
                        <a href="/kelola-pengumuman" class="btn btn-secondary">Kembali</a>
                        <?php if (session()->get('role') === 'admin' || session()->get('username') === $pengumuman['author']): ?>
                            <a href="<?= site_url('kelola-pengumuman/' . $pengumuman['id_pengumuman'] . '/edit') ?>"
                                class="btn btn-primary">Edit</a>
                            <form method="post"
                                action="<?= site_url('kelola-pengumuman/' . $pengumuman['id_pengumuman']) ?>"
                                onsubmit="return confirm('Hapus pengumuman ini?');" style="display:inline;">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        </div>
        <aside class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Informasi</h5>
                    <p class="mb-1"><strong>Status:</strong> <?= esc($pengumuman['status']) ?></p>
                    <p class="mb-1"><strong>Ditambahkan:</strong>
                        <?= date('d F Y H:i', strtotime($pengumuman['created_at'] ?? $pengumuman['tanggal'])) ?></p>
                </div>
            </div>
            <!-- Placeholder for related posts or metadata -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Lainnya</h6>
                    <p class="small text-muted">Tambahkan widget terkait atau kategori di sini.</p>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php echo view('templates/partials') ?>
<?php $this->endSection(); ?>