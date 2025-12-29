<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>
<style>
    .berita h1 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: .5rem;
    }

    .card-news {
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
    }

    /* Custom pager styles (reuse same as other views) */
    .custom-pager .pagination {
        display: flex;
        gap: 10px;
        padding: 0;
        margin: 0;
        list-style: none;
        align-items: center;
    }

    .custom-pager .page-item {
        display: inline-block;
    }

    .custom-pager .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        height: 44px;
        padding: 0 10px;
        border-radius: 8px;
        background: #ffffff;
        color: #0b2e6b;
        border: 1px solid rgba(11, 46, 107, 0.12);
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.02);
        text-decoration: none;
        font-weight: 600;
    }

    .custom-pager .page-item.active .page-link,
    .custom-pager .page-link.active {
        background: #07224e;
        color: #fff;
        border-color: transparent;
    }

    .custom-pager .page-item.disabled .page-link,
    .custom-pager .page-link[aria-disabled="true"] {
        opacity: 0.45;
        pointer-events: none;
    }

    @media (max-width:767px) {
        .card-news img {
            height: 200px;
        }
    }
</style>

<!-- GLightbox removed; listing navigates to detail pages -->

<div class="container berita" data-aos="fade-up" data-aos-delay="100">

    <div class="row">
        <div class="col-12">
            <p class="text-muted small mb-2"><?= esc($title) ?></p>
            <h1 class="mb-4">Kumpulan Infografis <span class="accent">DP3AP2KB</span></h1>
        </div>
    </div>

    <div class="row mt-5" data-aos="fade-up" data-aos-delay="350">
        <?php if (!empty($infografiss) && is_array($infografiss)): ?>
            <?php foreach ($infografiss as $b):
                $item = $b['item'] ?? [];
                $files = $b['files'] ?? [];
                $cover = null;
                if (!empty($files)) {
                    $cover = $files[0]['filepath'] ?? null;
                }
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <article class="card-news" style="box-shadow:0 6px 18px rgba(0,0,0,0.06);">
                        <a href="<?= site_url('infografis/' . ($item['slug'] ?? '')) ?>" style="display:block;">
                            <div class="card-image" style="height:180px; overflow:hidden;">
                                <?php if ($cover): ?>
                                    <img loading="lazy" decoding="async" src="<?= base_url($cover) ?>"
                                        alt="<?= esc($item['title']) ?>"
                                        style="width:100%; height:100%; object-fit:cover; display:block;">
                                <?php elseif (!empty($item['image'])): ?>
                                    <img loading="lazy" decoding="async" src="<?= base_url($item['image']) ?>"
                                        alt="<?= esc($item['title']) ?>"
                                        style="width:100%; height:100%; object-fit:cover; display:block;" loading="lazy" decoding="async">
                                <?php else: ?>
                                    <img loading="lazy" decoding="async"
                                        src="<?= base_url('landingpage/assets/img/blog/blog-post-2.webp') ?>"
                                        alt="<?= esc($item['title']) ?>"
                                        style="width:100%; height:100%; object-fit:cover; display:block;" loading="lazy" decoding="async">          
                                        decoding="async">
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="card-body" style="padding:16px;">
                            <h5 style="font-size:1.05rem; margin:0 0 8px 0; font-weight:600; line-height:1.2;"><a
                                    href="<?= site_url('infografis/' . ($item['slug'] ?? '')) ?>"
                                    style="color:inherit; text-decoration:none;"><?= esc($item['title']) ?></a></h5>
                            <div style="display:flex; align-items:center; gap:8px; color:#8b8f94; font-size:13px;">
                                <span style="color:#136ad5; font-weight:600;"><?= esc($item['source'] ?? 'DP3AP2KB') ?></span>
                                <span>·</span>
                                <span><?= date('d F Y', strtotime($item['tanggal'] ?? date('Y-m-d'))) ?></span>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted">Belum ada infografis untuk ditampilkan.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            <?php if (isset($pager) && $pager): ?>
                <nav class="custom-pager" aria-label="Pagination">
                    <?= $pager->links() ?>
                </nav>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- No JS lightbox: clicking a card navigates to detail page -->

<?php $this->endSection(); ?>