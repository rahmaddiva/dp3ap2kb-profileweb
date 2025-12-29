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
            <h1 class="mb-4">Kumpulan Berita <span class="accent">DP3AP2KB</span></h1>

        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
            <div class="featured-news-slider">
                <?php // Dynamic slider from $beritas (limit to 3 items) ?>
                <?php
                $sliderItems = [];
                if (!empty($beritas) && is_array($beritas)) {
                    $sliderItems = array_slice($beritas, 0, 3);
                }
                ?>
                <div class="slider-container">
                    <?php if (!empty($sliderItems) && is_array($sliderItems)): ?>
                        <?php foreach ($sliderItems as $i => $b): ?>
                            <div class="slide-item <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>">
                                <div class="slide-image">
                                    <?php if (!empty($b['image'])): ?>
                                        <img src="<?= base_url($b['image']) ?>" alt="<?= esc($b['title']) ?>" loading="lazy" decoding="async">
                                    <?php else: ?>
                                        <img src="<?= base_url('landingpage/assets/img/blog/blog-post-2.webp') ?>"
                                            alt="<?= esc($b['title']) ?>" loading="lazy" decoding="async">
                                    <?php endif; ?>
                                </div>
                                <div class="slide-overlay">
                                    <h3 class="slide-title">
                                        <a href="<?= site_url('berita/' . $b['slug']) ?>"><?= esc($b['title']) ?></a>
                                    </h3>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="slide-item active">
                            <div class="slide-image">
                                <img src="<?= base_url('landingpage/assets/img/blog/blog-post-2.webp') ?>" alt="Default" loading="lazy" decoding="async">
                            </div>
                            <div class="slide-overlay">
                                <h3 class="slide-title"><a href="#">Belum ada berita</a></h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Navigation Buttons -->
                <button class="slider-nav prev" type="button" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="slider-nav next" type="button" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </button>

                <!-- Slider Dots -->
                <div class="slider-dots">
                    <?php if (!empty($sliderItems) && is_array($sliderItems)): ?>
                        <?php foreach ($sliderItems as $i => $b): ?>
                            <span class="dot <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>" role="button" tabindex="0"
                                aria-label="Go to slide <?= $i + 1 ?>"></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="dot active"></span>
                    <?php endif; ?>
                </div>
            </div>

            <script>
                (function () {
                    const slider = document.querySelector('.featured-news-slider');
                    if (!slider) return;

                    const slides = slider.querySelectorAll('.slide-item');
                    const dots = slider.querySelectorAll('.dot');
                    const prevBtn = slider.querySelector('.slider-nav.prev');
                    const nextBtn = slider.querySelector('.slider-nav.next');
                    let current = 0;
                    const total = slides.length;
                    let interval = null;

                    function showSlide(idx) {
                        current = (idx + total) % total;
                        slides.forEach((s, i) => s.classList.toggle('active', i === current));
                        dots.forEach((d, i) => d.classList.toggle('active', i === current));
                    }

                    function next() { showSlide(current + 1); }
                    function prev() { showSlide(current - 1); }

                    // Event bindings
                    if (nextBtn) nextBtn.addEventListener('click', () => { next(); resetAuto(); });
                    if (prevBtn) prevBtn.addEventListener('click', () => { prev(); resetAuto(); });
                    dots.forEach(d => d.addEventListener('click', () => { showSlide(parseInt(d.dataset.index)); resetAuto(); }));

                    // keyboard support for dots
                    dots.forEach(d => d.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); showSlide(parseInt(d.dataset.index)); resetAuto(); }
                    }));

                    // auto-play
                    function startAuto() { interval = setInterval(next, 5000); }
                    function stopAuto() { if (interval) { clearInterval(interval); interval = null; } }
                    function resetAuto() { stopAuto(); startAuto(); }

                    // init
                    showSlide(0);
                    startAuto();
                })();
            </script>
        </div>
        <!-- Right Side - News List with Scroll -->
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="news-list-container">
                <div class="news-list-header">
                    <h4>Berita Terbaru</h4>
                    <a href="#" class="view-all">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="news-list-scroll">
                    <!-- News Item 1 -->
                    <?php foreach ($berita_terbaru as $b): ?>
                        <div class="news-list-item">
                            <div class="news-thumbnail">
                                <img src="<?= !empty($b['image']) ? base_url($b['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp') ?> "
                                    alt="<?= esc($b['title']) ?>" loading="lazy" decoding="async">
                            </div>
                            <div class="news-info">
                                <div class="news-meta-small">
                                    <span class="source"><?= esc($b['source'] ?? 'DP3AP2KB') ?></span>
                                    <span class="date">
                                        <?= date('d M Y', strtotime($b['tanggal'])) ?>
                                    </span>
                                </div>
                                <h5 class="news-title-small">
                                    <a href="<?= site_url('berita/' . $b['slug']) ?>"><?= esc($b['title']) ?></a>
                                </h5>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>
    </div>

    <!-- Card Grid Berita (referensi desain) -->
    <div class="row mt-5" data-aos="fade-up" data-aos-delay="350">
        <?php if (!empty($beritas) && is_array($beritas)): ?>
            <?php foreach ($beritas as $b): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <article class="card-news"
                        style="border-radius:12px; overflow:hidden; background:#fff; box-shadow:0 6px 18px rgba(0,0,0,0.06);">
                        <a href="<?= site_url('berita/' . $b['slug']) ?>" style="display:block;">
                            <div class="card-image" style="height:180px; overflow:hidden;">
                                <img src="<?= !empty($b['image']) ? base_url($b['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp') ?>"
                                    alt="<?= esc($b['title']) ?>"
                                    style="width:100%; height:100%; object-fit:cover; display:block;" loading="lazy" decoding="async">
                            </div>
                        </a>
                        <div class="card-body" style="padding:16px;">
                            <h5 style="font-size:1.05rem; margin:0 0 8px 0; font-weight:600; line-height:1.2;"><a
                                    href="<?= site_url('berita/' . $b['slug']) ?>"
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
                <p class="text-muted">Belum ada berita untuk ditampilkan.</p>
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