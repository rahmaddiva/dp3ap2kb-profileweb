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
            <h1 class="mb-4">Reels <span class="accent">DP3AP2KB</span></h1>
        </div>
    </div>

    <div class="row mt-4" data-aos="fade-up" data-aos-delay="200">
        <?php if (!empty($instagram_posts) && is_array($instagram_posts)): ?>
            <?php foreach ($instagram_posts as $post):

                $url = trim($post['post_url'] ?? '');
                if (empty($url))
                    continue;

                // guard URL — accept only Instagram reel/reels URLs (http/https, optional www)
                if (!preg_match('#^https?://(www\.)?instagram\.com\/(reel|reels)\/[^/]+/?#i', $url))
                    continue;
                ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card-news" style="border-radius:12px; overflow:hidden; background:#fff;
                    box-shadow:0 6px 18px rgba(0,0,0,0.06); padding:12px;">

                        <!-- IMPORTANT: container HARUS KOSONG -->
                        <div class="instagram-embed" data-permalink="<?= esc($url) ?>"
                            style="width:100%; min-height:360px; background:#fafafa;">
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted">Belum ada reels Instagram untuk ditampilkan.</p>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- Pagination -->
<?php if (isset($pager) && $pager): ?>
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            <nav class="custom-pager" aria-label="Pagination">
                <?= $pager->links() ?>
            </nav>
        </div>
    </div>
<?php endif; ?>
</div>
<?php if (!empty($instagram_posts) && is_array($instagram_posts)): ?>
    <script>
        (function () {

            function ensureInstagramReady(callback) {
                if (window.instgrm && window.instgrm.Embeds && typeof window.instgrm.Embeds.process === 'function') {
                    callback();
                    return;
                }

                if (!document.getElementById('instagram-embed-script')) {
                    var script = document.createElement('script');
                    script.id = 'instagram-embed-script';
                    script.async = true;
                    script.defer = true;
                    script.src = 'https://www.instagram.com/embed.js';
                    document.body.appendChild(script);
                }

                // polling (karena IG embed tidak reliable onload)
                var check = setInterval(function () {
                    if (window.instgrm && window.instgrm.Embeds && typeof window.instgrm.Embeds.process === 'function') {
                        clearInterval(check);
                        callback();
                    }
                }, 50);

                setTimeout(function () {
                    clearInterval(check);
                }, 5000);
            }

            function processEmbed(container) {
                if (container.dataset.loaded === '1') return;

                var url = container.dataset.permalink;
                if (!/^https?:\/\/(www\.)?instagram\.com\/(reel|reels)\/[^\/]+\/?/i.test(url)) return;

                // Insert blockquote with an anchor — Instagram embed script expects a link inside
                container.innerHTML =
                    '<blockquote class="instagram-media" ' +
                    'data-instgrm-permalink="' + url + '" ' +
                    'data-instgrm-version="14">' +
                    '<a href="' + url + '"></a>' +
                    '</blockquote>';

                container.dataset.loaded = '1';

                ensureInstagramReady(function () {
                    // DELAY kecil → ini kunci agar tidak stuck
                    setTimeout(function () {
                        window.instgrm.Embeds.process();
                    }, 100);
                });
            }

            var items = document.querySelectorAll('.instagram-embed[data-permalink]');
            if (!items.length) return;

            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function (entries, obs) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            processEmbed(entry.target);
                            obs.unobserve(entry.target);
                        }
                    });
                }, { rootMargin: '300px' });

                items.forEach(function (el) {
                    observer.observe(el);
                });
            } else {
                items.forEach(processEmbed);
            }

        })();
    </script>

<?php endif; ?>


<!-- No JS lightbox: clicking a card navigates to detail page -->

<?php $this->endSection(); ?>