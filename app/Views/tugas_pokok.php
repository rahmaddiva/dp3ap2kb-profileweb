<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>

<style>
    .tugas-pokok h1 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .tugas-pokok .lead {
        font-size: 1.02rem;
        color: var(--default-color);
    }

    .tugas-pokok .func-list li {
        margin-bottom: 0.6rem;
    }

    .tugas-pokok .card {
        border-radius: 10px;
    }

    @media (max-width: 767px) {
        .tugas-pokok h1 {
            font-size: 24px;
        }
    }
</style>

<section class="tugas-pokok py-5">
    <div class="container" data-aos="fade-up">
        <div class="row g-4">
            <div class="col-12">
                <p class="text-muted small mb-2"><?= $title ?></p>
                <h1 class="mb-4">Tugas Pokok <span class="accent">DP3AP2KB</span></h1>

                <p class="lead">Dinas Pengendalian Penduduk Keluarga Berencana Pemberdayaan Perempuan dan Perlindungan
                    Anak Kabupaten Tanah Laut dibentuk berdasarkan Peraturan Daerah Nomor 6 Tahun 2016 tentang
                    pembentukan dan susunan Perangkat Daerah (Lembaran Daerah Kabupaten Tanah Laut Tahun 2016 Nomor 6,
                    Tambahan Lembaran Daerah Kabupaten Tanah Laut Nomor 25). Pemerintah Daerah Kabupaten Tanah Laut
                    mempunyai tugas membantu Bupati dalam melaksanakan penyusunan dan pelaksanaan kebijakan
                    penyelenggaraan pemerintahan di bidang Pemberdayaan Perempuan, Perlindungan Anak dan Keluarga
                    Berencana (KB).</p>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">Fungsi BPPKB</h5>
                        <ul class="func-list ps-3 mb-0">
                            <li>Perumusan Kebijakan Teknis di Bidang Pemberdayaan Perempuan, Perlindungan Anak dan KB.
                            </li>
                            <li>Pemberian dukungan atas penyelenggaraan Pemerintah Daerah di Bidang Pemberdayaan
                                Perempuan, Perlindungan Anak dan KB.</li>
                            <li>Pembinaan dan Pelaksanaan tugas di Bidang Pemberdayaan Perempuan, Perlindungan Anak dan
                                KB.</li>
                            <li>Pengelolaan administrasi umum meliputi ketatalaksanaan, keuangan, kepegawaian,
                                perlengkapan dan peralatan.</li>
                            <li>Pengelolaan unit pelaksana teknis Badan.</li>
                            <li>Pelaksanaan tugas lain yang diberikan oleh Bupati sesuai dengan tugas dan fungsinya.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">Ringkasan Tugas</h5>
                        <p class="mb-0">Secara umum, Dinas memiliki tugas utama untuk menyusun kebijakan teknis, membina
                            pelaksanaan program, dan memberikan dukungan administratif agar program Keluarga Berencana,
                            pemberdayaan perempuan, serta perlindungan anak dapat berjalan efektif dan berdampak bagi
                            keluarga di Kabupaten Tanah Laut.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php $this->endSection(); ?>