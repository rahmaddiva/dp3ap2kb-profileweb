<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>
<style>
    .berita h1 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: .5rem;
    }

    /* Featured slider */
    .featured-news-slider {
        position: relative;
    }

    .featured-news-slider .slider-container {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .slide-item {
        display: none;
    }

    .slide-item.active {
        display: block;
    }

    .slide-image img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        display: block;
    }

    .slide-overlay {
        position: absolute;
        left: 16px;
        right: 16px;
        bottom: 16px;
        color: #fff;
        padding: 12px;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.45) 100%);
        border-radius: 8px;
    }

    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.45);
        border: none;
        color: #fff;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
    }

    .slider-nav.prev {
        left: 8px;
    }

    .slider-nav.next {
        right: 8px;
    }

    .slider-dots {
        display: flex;
        gap: 6px;
        justify-content: center;
        margin-top: 8px;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #ddd;
        display: inline-block;
        cursor: pointer;
    }

    .dot.active {
        background: var(--accent-color);
    }

    /* News list */
    .news-list-scroll {
        max-height: 520px;
        overflow: auto;
        padding-right: 8px;
    }

    .news-list-item {
        display: flex;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
    }

    .news-thumbnail img {
        width: 96px;
        height: 64px;
        object-fit: cover;
        border-radius: 6px;
    }

    .news-meta-small .date {
        color: #6b7280;
        font-size: 13px;
        margin-left: 8px;
    }

    @media (max-width:767px) {
        .slide-image img {
            height: 200px;
        }

        .news-list-scroll {
            max-height: 300px;
        }
    }

    /* Custom pager styles (matches provided reference image) */
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
        color: #ffffff;
        border-color: transparent;
    }

    .custom-pager .page-item.disabled .page-link,
    .custom-pager .page-link[aria-disabled="true"] {
        opacity: 0.45;
        pointer-events: none;
    }

    .custom-pager .pagination .ellipsis {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        height: 44px;
        color: #7b8794;
        font-weight: 600;
    }

    @media (max-width:575px) {

        .custom-pager .page-link,
        .custom-pager .pagination .ellipsis {
            min-width: 36px;
            height: 36px;
        }
    }
</style>
<div class="container berita" data-aos="fade-up" data-aos-delay="100">

    <!-- title -->
    <div class="row">
        <div class="col-12">
            <p class="text-muted small mb-2"><?= $title ?></p>
            <h1 class="mb-4">Kumpulan Pengumuman <span class="accent">DP3AP2KB</span></h1>

        </div>
    </div>

    <!-- Card Grid Pengumuman (referensi desain) -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="350">
        <?php if (!empty($pengumumans) && is_array($pengumumans)): ?>
            <?php foreach ($pengumumans as $b): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <article class="card-news"
                        style="border-radius:12px; overflow:hidden; background:#fff; box-shadow:0 6px 18px rgba(0,0,0,0.06);">
                        <a href="<?= site_url('pengumuman/' . $b['slug']) ?>" style="display:block;">
                            <div class="card-image" style="height:180px; overflow:hidden;">
                                <img src="<?= !empty($b['image']) ? base_url($b['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp') ?>"
                                    alt="<?= esc($b['title']) ?>"
                                    style="width:100%; height:100%; object-fit:cover; display:block;" loading="lazy"
                                    decoding="async">
                            </div>
                        </a>
                        <div class="card-body" style="padding:16px;">
                            <h5 style="font-size:1.05rem; margin:0 0 8px 0; font-weight:600; line-height:1.2;"><a
                                    href="<?= site_url('pengumuman/' . $b['slug']) ?>"
                                    style="color:inherit; text-decoration:none;"><?= esc($b['title']) ?></a></h5>
                            <div style="display:flex; align-items:center; gap:8px; color:#8b8f94; font-size:13px;">
                                <span style="color:#136ad5; font-weight:600;"><?= esc($b['source'] ?? 'DP3AP2KB') ?></span>
                                <span>·</span>
                                <span><?= date('d F Y', strtotime($b['tanggal'] ?? date('Y-m-d'))) ?></span>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted">Belum ada pengumuman untuk ditampilkan.</p>
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

<?php $this->endSection(); ?>