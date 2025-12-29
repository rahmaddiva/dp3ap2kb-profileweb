<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="card p-4">
        <h2 class="mb-2"><?= esc($berita['title']) ?></h2>
        <?php
        function formatDateFriendly($dt)
        {
            if (empty($dt))
                return '-';
            $ts = strtotime($dt);
            if ($ts === false)
                return esc($dt);
            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $day = date('d', $ts);
            $month = $months[(int) date('n', $ts) - 1];
            $year = date('Y', $ts);
            $time = date('H:i', $ts);
            return "$day $month $year, $time";
        }
        ?>
        <p class="text-muted mb-1">By <?= esc($berita['author']) ?> &middot; <?= esc($berita['status']) ?> &middot;
            <?= ($berita['tanggal']) ?>
        </p>
        <!-- published at -->
        <p class="mb-3"><strong>Tanggal Publikasi:</strong>
            <span class="text-muted">
                <?= !empty($berita['published_at']) ? formatDateFriendly($berita['published_at']) : '-' ?>
            </span>
        </p>
        <p class="mb-3"><strong>Slug:</strong> <span class="text-muted"><?= esc($berita['slug']) ?></span></p>

        <?php if (!empty($berita['image'])): ?>
            <div class="mb-3">
                <img src="<?= base_url($berita['image']) ?>" alt="<?= esc($berita['title']) ?>" class="img-fluid"
                    style="max-width:100%; height:auto;">
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <?= $berita['content'] ?>
        </div>

        <div class="d-flex gap-2">
            <a href="/kelola-berita" class="btn btn-secondary">Kembali</a>
            <?php if (session()->get('role') === 'Admin'): ?>
                <a href="/kelola-berita/<?= esc($berita['id_berita']) ?>/edit" class="btn btn-primary">Edit</a>
                <form action="/kelola-berita/<?= esc($berita['id_berita']) ?>" method="post" class="d-inline"
                    onsubmit="return confirm('Hapus berita ini?')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger">Hapus</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php echo view('templates/partials') ?>
<?php $this->endSection(); ?>