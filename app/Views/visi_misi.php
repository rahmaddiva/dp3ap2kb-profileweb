<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>

<div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center g-4">

        <!-- Left: VISI & MISI -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <p class="text-muted small mb-2"><?= $title ?></p>
            <div class="left-title mb-4">
                <div class="d-flex align-items-center mb-3">
                    <span class="icon-circle bg-accent me-3"><i class="bi bi-people-fill"></i></span>
                    <h2 class="mb-0">VISI &amp; MISI <span class="accent">DP3AP2KB</span></h2>
                </div>

                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 mb-2 fw-bold">VISI</h3>
                        <blockquote class="blockquote mb-0">
                            <p class="mb-0">“Mewujudkan Pengendalian Penduduk melalui Keluarga Berencana, Kesetaraan dan
                                Keadilan Gender, Pemberdayaan Perempuan dan Perlindungan Anak, menuju Keluarga Kecil
                                yang Sejahtera dan Unggul”</p>
                        </blockquote>
                    </div>
                </div>

                <div class="mb-3">
                    <h3 class="h5 fw-bold">MISI</h3>
                    <ol class="ps-3 mb-0">
                        <li>Meningkatkan partisipasi masyarakat terhadap program pengendalian penduduk Keluarga
                            Berencana, Ketahanan dan Pemberdayaan Keluarga;</li>
                        <li>Meningkatkan pemberdayaan perempuan dan pemenuhan hak anak untuk mendapatkan kualitas hidup
                            dan peran yang setara di berbagai bidang pembangunan;</li>
                        <li>Meningkatkan perlindungan perempuan dan Anak;</li>
                        <li>Meningkatnya Kualitas Pelayanan Administrasi Organisasi</li>
                    </ol>
                </div>

            </div>
        </div>

        <!-- Right: Penjelasan Misi (cards) -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <div class="right-title mb-4">
                <div class="d-flex align-items-center mb-3">
                    <span class="icon-circle bg-accent me-3"><i class="bi bi-journal-text"></i></span>
                    <h2 class="mb-0">Penjelasan <span class="accent">Misi</span></h2>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <div id="misi1" class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Misi 1</h5>
                                <p class="card-text mb-0">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan
                                    Keluarga Berencana Kabupaten Tanah Laut berperan aktif dalam meningkatkan
                                    partisipasi masyarakat terhadap program Pengendalian Penduduk Keluarga Berencana
                                    guna meningkatkan ketahanan dan pemberdayaan keluarga di Kabupaten Tanah Laut.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="misi2" class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Misi 2</h5>
                                <p class="card-text mb-0">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan
                                    Keluarga Berencana berupaya untuk pemenuhan hak anak agar mendapatkan kualitas hidup
                                    yang baik dan berperan serta di berbagai bidang pembangunan di Kabupaten Tanah Laut.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="misi3" class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Misi 3</h5>
                                <p class="card-text mb-0">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan
                                    Keluarga Berencana berperan dalam meningkatkan perlindungan perempuan dan anak.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div id="misi4" class="card shadow-sm mb-0">
                            <div class="card-body">
                                <h5 class="card-title">Misi 4</h5>
                                <p class="card-text mb-0">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan
                                    Keluarga Berencana berperan aktif dalam meningkatkan kualitas pelayanan administrasi
                                    organisasi.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

<?php $this->endSection(); ?>