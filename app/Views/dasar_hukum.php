<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>

<style>
    .dasar-hukum h1 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .dasar-hukum .lead {
        font-size: 1.02rem;
        color: var(--default-color);
    }

    .dasar-hukum .laws-list {
        max-height: 420px;
        overflow: auto;
        padding-right: 8px;
    }

    .dasar-hukum .laws-list li {
        margin-bottom: 0.6rem;
    }

    .dasar-hukum .card {
        border-radius: 10px;
    }

    @media (max-width: 767px) {
        .dasar-hukum h1 {
            font-size: 24px;
        }

        .dasar-hukum .laws-list {
            max-height: 300px;
        }
    }
</style>

<section class="dasar-hukum py-5">
    <div class="container" data-aos="fade-up">
        <div class="row g-4">
            <div class="col-12">
                <p class="text-muted small mb-2"><?= $title ?></p>
                <h1>Dasar Hukum</h1>
                <p class="lead">Berikut adalah peraturan perundang-undangan dan kebijakan yang menjadi dasar tugas dan
                    penyelenggaraan Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan dan
                    Perlindungan Anak Kabupaten Tanah Laut.</p>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">Ketentuan Umum</h5>
                        <p class="mb-0">Dinas dibentuk berdasarkan Peraturan Daerah dan bertugas membantu Bupati dalam
                            penyusunan serta pelaksanaan kebijakan di bidang pemberdayaan perempuan, perlindungan anak,
                            dan keluarga berencana.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-3">Peraturan dan Kebijakan Terkait</h5>
                        <div class="laws-list">
                            <ul class="ps-3 mb-0">
                                <li>Undang-Undang Dasar RI Tahun 1945 pasal 27 menegaskan bahwa segala warga negara
                                    bersamaan kedudukannya di dalam hukum dan pemerintahan;</li>
                                <li>Undang-Undang Dasar RI Tahun 1945 pasal 28 I ayat (2) menegaskan bahwa setiap orang
                                    berhak bebas dari perlakuan yang bersifat diskriminatif dan berhak mendapatkan
                                    perlindungan;</li>
                                <li>Konvensi mengenai Penghapusan Segala Bentuk Diskriminasi terhadap Wanita (UU Nomor 7
                                    Tahun 1984);</li>
                                <li>Undang-Undang Nomor 39 Tahun 1999 tentang Hak Asasi Manusia;</li>
                                <li>Undang-Undang Nomor 23 Tahun 2002 tentang Perlindungan Anak;</li>
                                <li>Undang-Undang Nomor 12 Tahun 2003 tentang Pemilu (keterwakilan perempuan);</li>
                                <li>Undang-Undang Nomor 23 Tahun 2004 tentang Penghapusan Kekerasan Dalam Rumah Tangga;
                                </li>
                                <li>Undang-Undang Nomor 44 Tahun 2008 tentang Pornografi;</li>
                                <li>Undang-Undang Nomor 17 Tahun 2007 tentang Rencana Pembangunan Jangka Panjang
                                    Nasional 2005–2025;</li>
                                <li>Instruksi Presiden Nomor 9 Tahun 2000 tentang Pengarusutamaan Gender dalam
                                    Pembangunan Nasional;</li>
                                <li>Keputusan Presiden dan Peraturan terkait aksi nasional penghapusan pekerjaan
                                    terburuk untuk anak dan eksploitasi seksual komersial anak (Beberapa Keppres
                                    2001–2002);</li>
                                <li>Peraturan Presiden Nomor 7 Tahun 2005 tentang RPJM Nasional 2004–2009;</li>
                                <li>Keputusan Menteri Dalam Negeri Nomor 5 Tahun 2001 tentang Penanggulangan Pekerjaan
                                    Anak;</li>
                                <li>Keputusan Menteri Dalam Negeri Nomor 132 Tahun 2003 tentang Pedoman Pengarusutamaan
                                    Gender di Daerah;</li>
                                <li>Peraturan Bersama tiga menteri tentang percepatan pemberantasan buta aksara
                                    perempuan (Nomor 17/Men-PP/Dep.II/VII/2005 dll.);</li>
                                <li>Peraturan Pemerintah Nomor 41 Tahun 2007 tentang Organisasi Perangkat Daerah;</li>
                                <li>Peraturan Pemerintah Nomor 38 Tahun 2007 tentang Pembagian Urusan Pemerintahan;</li>
                                <li>Peraturan Menteri Dalam Negeri Nomor 13 Tahun 2006 (dan perubahan Nomor 59 Tahun
                                    2007) tentang Pengelolaan Keuangan Daerah;</li>
                                <li>Permen PP dan Menteri Negara terkait SPM bidang layanan terpadu bagi perempuan dan
                                    anak korban kekerasan (Permen Nomor 01 Tahun 2010);</li>
                                <li>Kesepakatan dan Komitmen nasional terkait isu ibu dan HIV/AIDS (antara KemenPP dan
                                    mitra daerah);</li>
                                <li>Peraturan Daerah Provinsi/Kabupaten (RPJMD/RPJPD) dan Peraturan Daerah Kabupaten
                                    Tanah Laut terkait pembentukan dan susunan organisasi Dinas (mis. Perda Kabupaten
                                    Tanah Laut Nomor 73 Tahun 2016, dan Perda pembentukan perangkat daerah lain yang
                                    relevan).</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<?php $this->endSection(); ?>