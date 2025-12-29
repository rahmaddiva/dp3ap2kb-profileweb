<?php $this->extend('layout_landingpage/main'); ?>
<?php $this->section('content'); ?>

<!-- GLightbox removed; detail page uses dedicated view and full-size links -->

<div class="container" data-aos="fade-up" data-aos-delay="100">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('/infografis_umum') ?>">Infografis</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($infografis['title']) ?></li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-3"><?= esc($infografis['title'] ?? 'Detail Infografis') ?></h1>
            <div style="color:#6b7280; margin-bottom:12px;">oleh
                <strong><?= esc($infografis['author'] ?? 'DP3AP2KB') ?></strong> ·
                <?= date('d F Y', strtotime($infografis['tanggal'] ?? date('Y-m-d'))) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?php if (!empty($files) && is_array($files)): ?>
                <?php foreach ($files as $f): ?>
                    <?php $ext = strtolower(pathinfo($f['filename'] ?? '', PATHINFO_EXTENSION)); ?>
                    <?php if (strpos($f['mime'] ?? '', 'image') === 0): ?>
                        <div style="margin-bottom:16px;">
                            <a href="<?= base_url($f['filepath']) ?>" target="_blank" rel="noopener noreferrer">
                                <img src="<?= base_url($f['filepath']) ?>" alt="<?= esc($f['filename']) ?>"
                                    style="width:100%; height:auto; display:block;" loading="lazy" decoding="async">
                            </a>
                        </div>
                    <?php else: ?>
                        <div style="margin-bottom:12px;">
                            <a href="<?= base_url($f['filepath']) ?>" target="_blank" rel="noopener noreferrer"
                                class="btn btn-outline-primary">Download: <?= esc($f['filename']) ?></a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <?php if (!empty($infografis['image'])): ?>
                    <div style="margin-bottom:16px;">
                        <a href="<?= base_url($infografis['image']) ?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?= base_url($infografis['image']) ?>" alt="<?= esc($infografis['title']) ?>"
                                style="width:100%; height:auto; display:block;" loading="lazy" decoding="async">
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="content" style="color:#374151; line-height:1.7; margin-top:8px;">
                <?= $infografis['content'] ?? '' ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div style="background:#fff; padding:12px; border-radius:8px; box-shadow:0 6px 18px rgba(0,0,0,0.04);">
                <h5>Infografis Lainnya</h5>
                <ul style="list-style:none; padding:0; margin:0;">
                    <?php foreach ($other_infografiss as $oi): ?>
                        <li style="padding:8px 0; border-bottom:1px solid #f1f5f9;"><a
                                href="<?= site_url('infografis/' . $oi['slug']) ?>"><?= esc($oi['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

</div>

<!-- No GLightbox: images open full-size in a new tab -->

<?php $this->endSection(); ?>