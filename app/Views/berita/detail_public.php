<?php $this->extend('layout_landingpage/main'); ?>

<?php $this->section('meta') ?>
<?php
$metaTitle = isset($berita['title']) ? $berita['title'] : 'Detail Berita';
$rawDesc = isset($berita['content']) ? strip_tags($berita['content']) : '';
$metaDescription = trim(mb_substr(preg_replace('/\s+/', ' ', $rawDesc), 0, 160));
$ogImage = !empty($berita['image']) ? base_url($berita['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp');
$canonical = site_url('berita_umum/' . ($berita['slug'] ?? ''));
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

<?php $this->section('content') ?>

<style>
    .detail-berita h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: .5rem;
    }

    .detail-meta {
        color: #6b7280;
        font-size: .95rem;
        margin-bottom: 1.25rem;
    }

    .detail-content {
        line-height: 1.8;
        font-size: 1rem;
        color: #222;
    }

    .detail-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }

    @media (max-width:767px) {
        .detail-image {
            height: 220px;
        }
    }

    .sidebar .card {
        border-radius: 8px;
    }
</style>

<div class="container py-5 detail-berita">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('/berita_umum') ?>">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($berita['title']) ?></li>
        </ol>
    </nav>

    <div class="row g-4">
        <main class="col-lg-8">
            <article class="mb-4">
                <?php $img = !empty($berita['image']) ? base_url($berita['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp'); ?>
                <img src="<?= $img ?>" alt="<?= esc($berita['title']) ?>" class="detail-image mb-3">

                <h1><?= esc($berita['title']) ?></h1>
                <div class="detail-meta">
                    <span>By <?= esc($berita['author']) ?></span>
                    <span class="mx-2">•</span>
                    <span><?= date('d F Y', strtotime($berita['tanggal'] ?? date('Y-m-d'))) ?></span>
                </div>

                <div class="detail-content">
                    <?= $berita['content'] ?>
                </div>

                <?php if (!empty($berita['source'])): ?>
                    <p class="mt-4"><strong>Sumber:</strong> <?= esc($berita['source']) ?></p>
                <?php endif; ?>

                <div class="mt-4 d-flex gap-2">
                    <a href="<?= site_url('/berita') ?>" class="btn btn-outline-secondary">Kembali ke Berita</a>
                </div>
            </article>
        </main>

        <aside class="col-lg-4 sidebar">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Informasi</h5>
                    <p class="mb-1"><strong>Status:</strong> <?= esc($berita['status']) ?></p>
                    <p class="mb-0"><strong>Diposting:</strong>
                        <?= date('d F Y H:i', strtotime($berita['created_at'] ?? $berita['tanggal'])) ?></p>
                </div>
            </div>

            <?php
            // Fragment cache for 'Berita Lainnya'
            $cache = \Config\Services::cache();
            $cacheKey = 'sidebar_berita_list_v1';
            $cachedSidebar = $cache->get($cacheKey);
            if ($cachedSidebar):
                echo $cachedSidebar;
            else:
                ob_start();
                ?>
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Berita Lainnya</h6>
                        <ul class="list-unstyled mb-0">
                            <?php if (!empty($other_beritas) && is_array($other_beritas)): ?>
                                <?php foreach ($other_beritas as $o): ?>
                                    <?php $thumb = !empty($o['image']) ? base_url($o['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp'); ?>
                                    <li class="mb-3 d-flex align-items-center">
                                        <a href="<?= site_url('berita/' . $o['slug']) ?>" class="d-flex align-items-center"
                                            style="text-decoration:none; color:inherit;">
                                            <img src="<?= $thumb ?>" alt="<?= esc($o['title']) ?>"
                                                style="width:64px; height:48px; object-fit:cover; border-radius:6px; margin-right:10px;">
                                            <span style="font-size:.95rem"><?= esc($o['title']) ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="mb-2 text-muted">Tidak ada berita lainnya.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <?php
                $html = ob_get_clean();
                try {
                    $cache->save($cacheKey, $html, 600);
                } catch (\Throwable $e) {
                }
                echo $html;
            endif;
            ?>

        </aside>
    </div>
</div>

<?php $this->endSection() ?>