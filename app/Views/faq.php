<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section('meta'); ?>
<link href="<?= base_url('landingpage/') ?>assets/css/faq.css" rel="stylesheet">
<?php $this->endSection(); ?>

<?php $this->section("content"); ?>
<div class="container py-5">
    <h1 class="mb-3"><?= esc($title) ?></h1>
    <p class="lead">Pertanyaan yang sering diajukan tentang DP3AP2KB Kabupaten Tanah Laut.</p>

    <?php
    $faqs = [
        [
            'q' => 'Apa itu DP3AP2KB?',
            'a' => 'DP3AP2KB adalah singkatan dari Dinas Pengendalian Penduduk, Pemberdayaan Perempuan, Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana. Dinas ini bertugas menyusun kebijakan dan melakukan pembinaan terkait urusan kependudukan, pemberdayaan perempuan, perlindungan anak, serta program KB di tingkat kabupaten.'
        ],
        [
            'q' => 'Apa tugas utama DP3AP2KB?',
            'a' => 'Tugas utama meliputi perumusan kebijakan, koordinasi program, pelaksanaaan kegiatan pemberdayaan perempuan, perlindungan anak, pengendalian penduduk, dan pelayanan program KB serta pembinaan terhadap lembaga terkait.'
        ],
        [
            'q' => 'Bagaimana cara menghubungi DP3AP2KB?',
            'a' => 'Informasi kontak tersedia pada halaman kontak atau bagian "Hubungi Kami" pada situs ini. Anda dapat mengunjungi kantor dinas pada jam kerja atau mengirim surat/e-mail sesuai informasi yang dipublikasikan.'
        ],
        [
            'q' => 'Apakah DP3AP2KB menyediakan layanan konsultasi keluarga?',
            'a' => 'Ya. Dinas menyediakan informasi dan rujukan terkait pelayanan keluarga berencana, konseling keluarga, serta program pemberdayaan melalui unit/layanan yang ditunjuk.'
        ],
        [
            'q' => 'Bagaimana cara berpartisipasi dalam program pemberdayaan perempuan atau perlindungan anak?',
            'a' => 'Informasi pendaftaran kegiatan dan program biasanya diumumkan di situs resmi dinas atau media sosial. Untuk partisipasi, ikuti pengumuman tersebut atau hubungi petugas program di dinas.'
        ],
        [
            'q' => 'Di mana saya bisa mendapatkan data dan publikasi DP3AP2KB?',
            'a' => 'Data publikasi dan laporan tahunan biasanya dapat diunduh melalui bagian "Data" atau halaman publikasi pada situs ini. Jika membutuhkan data khusus, Anda dapat mengajukan permintaan melalui kontak resmi.'
        ],
    ];
    ?>

    <div class="accordion" id="faqAccordion">
        <?php foreach ($faqs as $i => $f): ?>
            <div class="card mb-2">
                <div class="card-header" id="heading<?= $i ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link faq-question" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?= $i ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"
                            aria-controls="collapse<?= $i ?>">
                            <?= esc($f['q']) ?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?= $i ?>" class="collapse <?= $i === 0 ? 'show' : '' ?>"
                    aria-labelledby="heading<?= $i ?>" data-bs-parent="#faqAccordion">
                    <div class="card-body">
                        <?= esc($f['a']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<script src="<?= base_url('landingpage/') ?>assets/js/faq.js"></script>

<?php $this->endSection(); ?>