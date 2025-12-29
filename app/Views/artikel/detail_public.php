<?php $this->extend('layout_landingpage/main'); ?>
<?php $this->section('content'); ?>

<style>
    .article-detail h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: .5rem;
    }

    .article-meta {
        color: #6b7280;
        font-size: .95rem;
        margin-bottom: 1.25rem;
    }

    .article-content {
        line-height: 1.8;
        font-size: 1rem;
        color: #222;
    }

    .article-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }

    @media (max-width:767px) {
        .article-image {
            height: 220px;
        }
    }

    .sidebar .card {
        border-radius: 8px;
    }
</style>

<div class="container py-5 article-detail">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('/artikel_umum') ?>">Artikel</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($artikel['title']) ?></li>
        </ol>
    </nav>

    <div class="row g-4">
        <main class="col-lg-8">
            <article class="mb-4">
                <?php $img = !empty($artikel['image']) ? base_url($artikel['image']) : base_url('landingpage/assets/img/blog/blog-post-1.webp'); ?>
                <img src="<?= $img ?>" alt="<?= esc($artikel['title']) ?>" class="article-image mb-3">

                <h1><?= esc($artikel['title']) ?></h1>
                <div class="article-meta">
                    <span>By <?= esc($artikel['author']) ?></span>
                    <span class="mx-2">•</span>
                    <span><?= date('d F Y', strtotime($artikel['tanggal'] ?? date('Y-m-d'))) ?></span>
                </div>

                <div class="article-content">
                    <?= $artikel['content'] ?>
                </div>

                <?php if (!empty($artikel['source'])): ?>
                    <p class="mt-4"><strong>Sumber:</strong> <?= esc($artikel['source']) ?></p>
                <?php endif; ?>

                <div class="mt-4 d-flex gap-2">
                    <a href="<?= site_url('/artikel_umum') ?>" class="btn btn-outline-secondary">Kembali ke Artikel</a>
                </div>
            </article>
        </main>

        <aside class="col-lg-4 sidebar">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Informasi</h5>
                    <p class="mb-1"><strong>Status:</strong> <?= esc($artikel['status']) ?></p>
                    <p class="mb-0"><strong>Diposting:</strong>
                        <?= date('d F Y H:i', strtotime($artikel['created_at'] ?? $artikel['tanggal'])) ?></p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Artikel Lainnya</h6>
                    <ul class="list-unstyled mb-0">
                        <?php if (!empty($other_artikels) && is_array($other_artikels)): ?>
                            <?php foreach ($other_artikels as $o): ?>
                                <?php $thumb = !empty($o['image']) ? base_url($o['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp'); ?>
                                <li class="mb-3 d-flex align-items-center">
                                    <a href="<?= site_url('artikel/' . $o['slug']) ?>" class="d-flex align-items-center"
                                        style="text-decoration:none; color:inherit;">
                                        <img src="<?= $thumb ?>" alt="<?= esc($o['title']) ?>"
                                            style="width:64px; height:48px; object-fit:cover; border-radius:6px; margin-right:10px;">
                                        <span style="font-size:.95rem"><?= esc($o['title']) ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="mb-2 text-muted">Tidak ada artikel lainnya.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php $this->endSection(); ?>