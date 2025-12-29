<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>
<style>
    .gallery-card {
        cursor: pointer;
    }

    .gallery-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        border-radius: 8px;
    }

    .gallery-title {
        font-weight: 600;
        margin-top: 8px;
    }

    /* Modal */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .modal-content {
        background: #fff;
        width: 90%;
        max-width: 900px;
        border-radius: 8px;
        overflow: hidden;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
    }

    .modal-header {
        padding: 12px 16px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        padding: 12px;
        overflow: auto;
    }

    .modal-image {
        width: 100%;
        height: 420px;
        object-fit: contain;
        background: #111;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-image img {
        max-width: 100%;
        max-height: 100%;
    }

    .modal-controls {
        display: flex;
        gap: 8px;
        margin-top: 8px;
        justify-content: center;
    }

    .btn-small {
        padding: 6px 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background: #fff;
        cursor: pointer;
    }

    /* Custom pager styles */
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

    @media (max-width:767px) {
        .modal-image {
            height: 260px;
        }

        .gallery-card img {
            height: 140px;
        }
    }
</style>

<!-- GLightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

<div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row mb-4">
        <div class="col-12">
            <p class="text-muted small mb-2"><?= esc($title) ?></p>
            <h1 class="mb-0">Kumpulan Foto <span class="accent">DP3AP2KB</span></h1>
        </div>
    </div>

    <div class="row gy-4 mb-5">
        <?php if (!empty($fotos) && is_array($fotos)): ?>
            <?php foreach ($fotos as $idx => $f):
                $g = $f['gallery'];
                $files = $f['files'] ?? [];
                $cover = null;
                if (!empty($files)) {
                    $cover = $files[0]['filepath'] ?? null;
                }
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="gallery-card" tabindex="0"
                        data-files="<?= htmlspecialchars(json_encode($files), ENT_QUOTES, 'UTF-8') ?>"
                        data-gallery="<?= htmlspecialchars(json_encode(['title' => $g['title'] ?? '', 'content' => $g['content'] ?? '', 'tanggal' => $g['tanggal'] ?? '', 'author' => $g['author'] ?? '']), ENT_QUOTES, 'UTF-8') ?>">
                        <div
                            style="border-radius:12px; overflow:hidden; background:#fff; box-shadow:0 6px 18px rgba(0,0,0,0.06); padding:12px;">
                            <div style="height:180px; overflow:hidden; border-radius:8px;">
                                <?php if ($cover): ?>
                                    <img loading="lazy" src="<?= base_url($cover) ?>" alt="<?= esc($g['title']) ?>"
                                        decoding="async">
                                <?php else: ?>
                                    <div
                                        style="width:100%;height:180px;display:flex;align-items:center;justify-content:center;background:#f3f4f6;color:#9ca3af;">
                                        Tidak ada gambar</div>
                                <?php endif; ?>
                            </div>
                            <div style="padding-top:8px;">
                                <div class="gallery-title"><?= esc($g['title']) ?></div>
                                <div style="color:#6b7280; font-size:13px; margin-top:6px;">
                                    <?= date('d F Y', strtotime($g['tanggal'] ?? date('Y-m-d'))) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted">Belum ada foto untuk ditampilkan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if (isset($pager) && $pager): ?>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-5">
                <nav class="custom-pager" aria-label="Pagination">
                    <?= $pager->links() ?>
                </nav>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    (function () {
        // Load GLightbox script dynamically then attach handlers
        function loadScript(src, cb) {
            var s = document.createElement('script'); s.src = src; s.onload = cb; document.head.appendChild(s);
        }

        loadScript('https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', function () {
            // Attach click handlers to cards to open GLightbox
            document.querySelectorAll('.gallery-card').forEach(function (card, idx) {
                card.addEventListener('click', function () {
                    const filesJson = card.getAttribute('data-files') || '[]';
                    const galleryJson = card.getAttribute('data-gallery') || '{}';
                    let files = [];
                    try { files = JSON.parse(filesJson); } catch (e) { files = []; }
                    let gallery = {};
                    try { gallery = JSON.parse(galleryJson); } catch (e) { gallery = {}; }

                    if (!files.length) return;

                    // Build GLightbox elements
                    const elements = files.map(function (f) {
                        const href = f.filepath ? ('<?= site_url('/') ?>' + f.filepath.replace(/^\/+/, '')) : '';
                        return {
                            href: href,
                            type: 'image',
                            title: gallery.title || (f.filename || ''),
                            description: gallery.content ? gallery.content : (f.filename || '')
                        };
                    });

                    const lightbox = GLightbox({ elements: elements, loop: true, touchNavigation: true });
                    lightbox.open();
                });
                card.addEventListener('keypress', function (e) { if (e.key === 'Enter') card.click(); });
            });
        });
    })();
</script>

<?php $this->endSection(); ?>