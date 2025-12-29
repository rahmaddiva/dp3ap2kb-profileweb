<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>

<style>
    .org-chart {
        text-align: center;
        padding: 40px 20px;
    }

    .org-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        padding: 20px;
    }

    .org-level {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 40px;
        margin: 40px 0;
        position: relative;
    }

    .org-level.side-by-side {
        gap: 60px;
    }

    .org-card {
        background: white;
        border: 2px solid #333;
        border-radius: 6px;
        padding: 12px 16px;
        min-width: 260px;
        max-width: 300px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 2;
    }

    .org-card.kepala {
        background: #2c3e50;
        color: white;
        border-color: #2c3e50;
    }

    .org-card.sekretaris {
        background: #34495e;
        color: white;
        border-color: #34495e;
    }

    .org-card.sub-bagian {
        background: #7f8c8d;
        color: white;
        border-color: #7f8c8d;
    }

    .org-card.kepala-bidang {
        background: white;
        border-color: #2c3e50;
    }

    .org-card.uptd {
        background: #2c3e50;
        color: white;
        border-color: #2c3e50;
    }

    .org-card.fungsional {
        background: white;
        border: 2px solid #7f8c8d;
    }

    .org-card .jabatan-title {
        font-weight: 700;
        font-size: 11px;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        line-height: 1.3;
    }

    .org-card .nama {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 3px;
        line-height: 1.3;
    }

    .org-card .nip {
        font-size: 11px;
        opacity: 0.9;
        line-height: 1.3;
    }

    .org-card img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
        margin: 0 auto 10px;
        display: block;
        border: 3px solid rgba(255, 255, 255, 0.3);
    }

    .connector-line {
        position: absolute;
        background: #666;
        z-index: 1;
    }

    .vertical-line {
        width: 2px;
        left: 50%;
        transform: translateX(-50%);
    }

    .horizontal-line {
        height: 2px;
        top: 50%;
        transform: translateY(-50%);
    }

    @media (max-width: 768px) {
        .org-level {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .org-card {
            min-width: 260px;
            max-width: 100%;
        }
    }
</style>

<div class="container berita" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h5 class="text-muted small mb-2">BAGAN STRUKTUR ORGANISASI</h5>
            <h2 class="mb-2">DINAS PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK,</h2>
            <h2 class="mb-2">PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA</h2>
            <h3 class="text-muted">KABUPATEN TANAH LAUT</h3>
        </div>
    </div>

    <div class="org-container">
        <?php
        // Group pegawai by jabatan
        $byJabatan = [];
        if (!empty($pegawai)) {
            foreach ($pegawai as $p) {
                $jab = trim($p['jabatan'] ?? '');
                if (!isset($byJabatan[$jab]))
                    $byJabatan[$jab] = [];
                $byJabatan[$jab][] = $p;
            }
        }

        function render_card($label, $items, $cssClass = '', $emptyText = 'Kosong')
        {
            ?>
            <div class="org-card <?= $cssClass ?>">
                <div class="jabatan-title"><?= esc($label) ?></div>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $it): ?>
                        <?php if (!empty($it['image'])): ?>
                            <img src="<?= base_url('foto_pegawai/' . $it['image']) ?>" alt="<?= esc($it['nama']) ?>">
                        <?php endif; ?>
                        <div class="nama"><?= esc($it['nama']) ?></div>
                        <div class="nip">NIP: <?= esc($it['nip']) ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="nama"><?= esc($emptyText) ?></div>
                    <div class="nip">&nbsp;</div>
                <?php endif; ?>
            </div>
            <?php
        }
        ?>

        <!-- Level 1: Kepala Dinas -->
        <div class="org-level">
            <?php render_card('Kepala Dinas', $byJabatan['Kepala Dinas'] ?? [], 'kepala'); ?>
        </div>

        <!-- Level 2: Kelompok Jabatan Fungsional dan Sekretaris -->
        <div class="org-level side-by-side">
            <?php render_card('Kelompok Jabatan Fungsional', $byJabatan['Jabatan Fungsional Lainnya'] ?? [], 'fungsional'); ?>
            <?php render_card('Sekretaris', $byJabatan['Sekretaris'] ?? [], 'sekretaris'); ?>
        </div>

        <!-- Level 3: Sub Bagian -->
        <div class="org-level">
            <?php render_card('Sub Bagian Perencanaan dan Keuangan', $byJabatan['Sub Bagian Perencanaan dan Keuangan'] ?? [], 'sub-bagian'); ?>
            <?php render_card('Sub Bagian Umum dan Kepegawaian', $byJabatan['Sub Bagian Umum dan Kepegawaian'] ?? [], 'sub-bagian'); ?>
        </div>

        <!-- Level 4: Kepala Bidang -->
        <div class="org-level">
            <?php render_card('Kepala Bidang Keluarga Berencana dan Keluarga Sejahtera', $byJabatan['Kepala Bidang Keluarga Berencana dan Keluarga Sejahtera'] ?? [], 'kepala-bidang'); ?>
            <?php render_card('Kepala Bidang Pengendalian Penduduk Data dan Informasi', $byJabatan['Kepala Bidang Pengendalian Penduduk Data dan Informasi'] ?? [], 'kepala-bidang'); ?>
            <?php render_card('Kepala Bidang Pemberdayaan Perempuan dan Perlindungan Anak', $byJabatan['Kepala Bidang Pemberdayaan Perempuan dan Perlindungan Anak'] ?? [], 'kepala-bidang'); ?>
        </div>

        <!-- Level 5: Kepala UPTD PPA -->
        <div class="org-level">
            <?php render_card('Kepala UPTD PPA', $byJabatan['Kepala UPTD PPA'] ?? [], 'uptd'); ?>
        </div>

    </div>
</div>



<?php $this->endSection(); ?>