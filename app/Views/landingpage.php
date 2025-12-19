<?php $this->extend("layout_landingpage/main"); ?>
<?php $this->section("content"); ?>
<main class="main">

  <!-- Courses Hero Section -->
  <section id="courses-hero" class="courses-hero section light-background">

    <div class="hero-content">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="hero-text">
              <h1>Selamat Datang di <span class="accent">Website Resmi</span></h1>
              <h2>Dinas Pemberdayaan Perempuan dan Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana</h2>
              <p>
                **Kami berkomitmen penuh untuk mewujudkan keluarga berkualitas, menekan laju pertumbuhan penduduk, serta
                menjamin pemenuhan hak dan perlindungan yang optimal bagi setiap perempuan dan anak di wilayah ini.**
                Jelajahi layanan dan program unggulan kami.
              </p>

              <div class="hero-buttons">
                <a href="#program" class="btn btn-primary">Lihat Program Kami</a>
                <a href="#kontak" class="btn btn-outline">Hubungi Kami</a>
              </div>

              <div class="hero-features">
                <div class="feature">
                  <i class="bi bi-heart-pulse"></i>
                  <span>Kesehatan Keluarga</span>
                </div>
                <div class="feature">
                  <i class="bi bi-person-fill-lock"></i>
                  <span>Perlindungan Anak</span>
                </div>
                <div class="feature">
                  <i class="bi bi-people"></i>
                  <span>Pemberdayaan Perempuan</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="hero-image">
              <div class="main-image">
                <img src="<?= base_url(
                  "landingpage/",
                ) ?>assets/img/education/maria_ulfah.webp" alt="Online Learning" class="img-fluid hero-main-img"
                  style="object-fit:cover; object-position:center; width:100%; height:420px;">
              </div>


            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="hero-background">
      <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
      </div>
    </div>

  </section><!-- /Courses Hero Section -->

  <!-- Featured News Section -->
  <section id="featured-courses" class="featured-courses section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Berita P3AP2KB</h2>
      <p>Berita Terbaru seputar kegiatan dan program Dinas P3AP2KB</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-4">
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
          <div class="featured-news-slider">
            <div class="slider-container">
              <!-- Slide 1 -->
              <div class="slide-item active">
                <div class="slide-image">
                  <img src="<?= base_url('landingpage/') ?>assets/img/blog/blog-post-1.webp" alt="News 1">
                </div>
                <div class="slide-overlay">
                  <h3 class="slide-title">
                    <a href="#">SPPG Demulih Jadi Motor Ketahanan Gizi dan Ekonomi Lokal</a>
                  </h3>
                </div>
              </div>

              <!-- Slide 2 -->
              <div class="slide-item">
                <div class="slide-image">
                  <img src="<?= base_url('landingpage/') ?>assets/img/blog/blog-post-2.webp" alt="News 2">
                </div>
                <div class="slide-overlay">
                  <h3 class="slide-title">
                    <a href="#">Hasil Seleksi Administrasi Pasca Sanggah Pada Seleksi Pengadaan</a>
                  </h3>
                </div>
              </div>

              <!-- Slide 3 -->
              <div class="slide-item">
                <div class="slide-image">
                  <img src="<?= base_url('landingpage/') ?>assets/img/blog/blog-post-3.webp" alt="News 3">
                </div>
                <div class="slide-overlay">
                  <h3 class="slide-title">
                    <a href="#">Masyarakat Lumajang Merasakan Dampak Positif Penerapan Program</a>
                  </h3>
                </div>
              </div>

              <!-- Slide 4 -->
              <div class="slide-item">
                <div class="slide-image">
                  <img src="<?= base_url(relativePath: 'landingpage/') ?>assets/img/education/education-5.webp" alt="News 4">
                </div>
                <div class="slide-overlay">
                  <h3 class="slide-title">
                    <a href="#">Bupati Adalah Conductor dan Arranger Program MBG di Daerah</a>
                  </h3>
                </div>
              </div>
            </div>

            <!-- Navigation Buttons -->
            <button class="slider-nav prev" onclick="moveSlide(-1)">
              <i class="bi bi-chevron-left"></i>
            </button>
            <button class="slider-nav next" onclick="moveSlide(1)">
              <i class="bi bi-chevron-right"></i>
            </button>

            <!-- Slider Dots -->
            <div class="slider-dots">
              <span class="dot active" onclick="currentSlide(1)"></span>
              <span class="dot" onclick="currentSlide(2)"></span>
              <span class="dot" onclick="currentSlide(3)"></span>
              <span class="dot" onclick="currentSlide(4)"></span>
            </div>
          </div>
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
              <div class="news-list-item">
                <div class="news-thumbnail">
                  <img src="<?= base_url('landingpage/') ?>assets/img/blog/blog-post-2.webp" alt="News Thumbnail">
                </div>
                <div class="news-info">
                  <div class="news-meta-small">
                    <span class="source">BGN</span>
                    <span class="date">14 Desember 2025</span>
                  </div>
                  <h5 class="news-title-small">
                    <a href="#">Hasil Seleksi Administrasi Pasca Sanggah Pada Seleksi Pengadaan...</a>
                  </h5>
                </div>
              </div>

              <!-- News Item 2 -->
              <div class="news-list-item">
                <div class="news-thumbnail">
                  <img src="<?= base_url('landingpage/') ?>assets/img/blog/blog-post-3.webp" alt="News Thumbnail">
                </div>
                <div class="news-info">
                  <div class="news-meta-small">
                    <span class="source">BGN</span>
                    <span class="date">14 Desember 2025</span>
                  </div>
                  <h5 class="news-title-small">
                    <a href="#">Masyarakat Lumajang Merasakan Dampak Positif Penerapan Program...</a>
                  </h5>
                </div>
              </div>

              <!-- News Item 3 -->
              <div class="news-list-item">
                <div class="news-thumbnail">
                  <img src="<?= base_url('landingpage/') ?>assets/img/education/education-5.webp" alt="News Thumbnail">
                </div>
                <div class="news-info">
                  <div class="news-meta-small">
                    <span class="source">BGN</span>
                    <span class="date">14 Desember 2025</span>
                  </div>
                  <h5 class="news-title-small">
                    <a href="#">Bupati Adalah Conductor dan Arranger Program MBG di Daerah</a>
                  </h5>
                </div>
              </div>

              <!-- News Item 4 -->
              <div class="news-list-item">
                <div class="news-thumbnail">
                  <img src="<?= base_url('landingpage/') ?>assets/img/education/activities-3.webp" alt="News Thumbnail">
                </div>
                <div class="news-info">
                  <div class="news-meta-small">
                    <span class="source">BGN</span>
                    <span class="date">13 Desember 2025</span>
                  </div>
                  <h5 class="news-title-small">
                    <a href="#">Eco-Eduwisata MBG: Anak Bangli Belajar Gizi Nyata</a>
                  </h5>
                </div>
              </div>

              <!-- News Item 5 -->
              <div class="news-list-item">
                <div class="news-thumbnail">
                  <img src="<?= base_url('landingpage/') ?>assets/img/education/teacher-6.webp" alt="News Thumbnail">
                </div>
                <div class="news-info">
                  <div class="news-meta-small">
                    <span class="source">BGN</span>
                    <span class="date">13 Desember 2025</span>
                  </div>
                  <h5 class="news-title-small">
                    <a href="#">Program Pemberdayaan Perempuan Tingkatkan Kesejahteraan Keluarga</a>
                  </h5>
                </div>
              </div>

              <!-- News Item 6 -->
              <div class="news-list-item">
                <div class="news-thumbnail">
                  <img src="<?= base_url('landingpage/') ?>assets/img/education/courses-4.webp" alt="News Thumbnail">
                </div>
                <div class="news-info">
                  <div class="news-meta-small">
                    <span class="source">BGN</span>
                    <span class="date">12 Desember 2025</span>
                  </div>
                  <h5 class="news-title-small">
                    <a href="#">Sosialisasi Perlindungan Anak di Era Digital untuk Orang Tua</a>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /Featured News Section --><!-- /Featured Courses Section -->

  <!-- Inovasi Section -->
  <section id="course-categories" class="course-categories section partners-section">
<<<<<<< HEAD
    <!-- Background SVG (decorative) -->
    <div class="partners-bg" aria-hidden="true">
      <img src="<?= base_url('landingpage/') ?>assets/img/background_line.svg" alt="" class="bg-svg img-fluid">
    </div>
=======
  
>>>>>>> dbbb264a17e71fa49edeff41932464a2c854d5b0
    <!-- Content -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row align-items-center g-4">

        <!-- Left: Big title + description + CTA -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <div class="left-title mb-4">
            <div class="d-flex align-items-center mb-2">
              <span class="icon-circle bg-accent me-3"><i class="bi bi-people-fill"></i></span>
              <h2 class="mb-0">RaZa SaGala <span class="accent">DP3AP2KB</span></h2>
            </div>
            <p class="lead">
              Kami membuat inovasi kolaboratif dengan berbagai mitra kerja untuk memperkuat dampak program kami dalam
              memberdayakan perempuan, melindungi anak, serta mengelola kependudukan dan keluarga berencana secara
              efektif.
          </div>
        </div>

        <!-- Right: Accordion list of partners -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
          <div class="partner-list">
            <div class="accordion" id="accordionPartners">

              <div class="accordion-item shadow-sm rounded mb-3 border-0">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                    aria-controls="collapseOne">
                    PALING PEKA (Pelayanan Konseling dan Keluarga bagi Pasangan)
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                  data-bs-parent="#accordionPartners">
                  <div class="accordion-body">
                    Layanan konseling pra-nikah, pasca-nikah, dan prakonsepsi untuk mendukung keluarga sehat dan
                    berkualitas.
                  </div>
                </div>
              </div>

              <div class="accordion-item shadow-sm rounded mb-3 border-0">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    SI CANTIK CANGKAL KONSELING & ICRA
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                  data-bs-parent="#accordionPartners">
                  <div class="accordion-body">
                    Program ini bertujuan untuk memperkuat mental dan kesehatan reproduksi calon pengantin muda yang
                    rentan, sekaligus menjadi bagian dari upaya nasional untuk mencegah stunting.
                  </div>
                </div>
              </div>

              <div class="accordion-item shadow-sm rounded mb-3 border-0">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                    aria-controls="collapseThree">
                    Si DIKA
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                  data-bs-parent="#accordionPartners">
                  <div class="accordion-body">SiDika adalah upaya Pengadilan Agama untuk membuat proses permohonan kawin
                    anak menjadi lebih humanis dan edukatif, dengan harapan anak dapat membatalkan atau menunda
                    pernikahan dini mereka.
                  </div>
                </div>
              </div>

              <div class="accordion-item shadow-sm rounded mb-3 border-0">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                    aria-controls="collapseFour">
                    Daycare Tamasya
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                  data-bs-parent="#accordionPartners">
                  <div class="accordion-body">Daycare Tamasya adalah inisiatif untuk menstandardisasi dan meningkatkan
                    kualitas pengasuhan anak usia dini di TPA, serta memberdayakan orang tua melalui konseling parenting
                    untuk menciptakan lingkungan tumbuh kembang anak yang optimal.</div>
                </div>
              </div>

              <div class="accordion-item shadow-sm rounded mb-3 border-0">
                <h2 class="accordion-header" id="headingFive">
                  <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                    aria-controls="collapseFive">
                    Kulaling (Program layanan KB Keliling),
                  </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                  data-bs-parent="#accordionPartners">
                  <div class="accordion-body">Kulaling adalah strategi jemput bola untuk meningkatkan pengetahuan,
                    kesadaran, dan aksesibilitas masyarakat terhadap layanan Keluarga Berencana hingga ke pelosok desa.
                  </div>
                </div>
              </div>

              <div class="accordion-item shadow-sm rounded mb-3 border-0">
                <h2 class="accordion-header" id="headingSix">
                  <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                    aria-controls="collapseSix">
                    Ceting Nasiku
                  </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                  data-bs-parent="#accordionPartners">
                  <div class="accordion-body">Ceting Nasiku adalah program edukasi gizi praktis di tingkat desa yang
                    mengajarkan keluarga berisiko cara mengolah bahan pangan lokal menjadi menu sehat untuk mencegah
                    stunting.
                  </div>
                </div>
              </div>

              <div class="accordion-item shadow-sm rounded mb-3 border-0">
                <h2 class="accordion-header" id="headingSeven">
                  <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false"
                    aria-controls="collapseSeven">
                    GENTING (Gerakan Orang Tua Asuh Cegah Stunting
                    )
                  </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                  data-bs-parent="#accordionPartners">
                  <div class="accordion-body">GENTING adalah inisiatif di Kabupaten Tanah Laut di mana masyarakat
                    umum/donatur (disebut Orang Tua Asuh/Uma Abah Maimpu) menyediakan dukungan berkelanjutan bagi
                    keluarga berisiko untuk memastikan anak-anak mereka terhindar dari stunting.</div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

    </div>

  </section><!-- Inovasi Section -->

  <!-- Tentang Kami / Tujuan DP3AP2KB Section -->
  <section id="about" class="about section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row align-items-center g-4">

        <!-- Left: Text -->
        <div class="col-lg-7" data-aos="fade-up" data-aos-delay="120">
          <div class="about-content">
            <h6 class="section-label">Tentang Kami</h6>
            <h2 class="about-heading mb-3">DP3AP2KB: Dinas Daerah yang Berkomitmen pada <span class="accent">Peningkatan
                Kualitas Hidup dan Kesejahteraan Keluarga</span></h2>
            <p>
              DP3AP2KB (Dinas Pemberdayaan Perempuan, Perlindungan Anak, Pengendalian Penduduk, dan Keluarga Berencana)
              adalah organisasi penting di tingkat daerah yang memiliki mandat untuk menjamin terpenuhinya hak-hak
              perempuan dan anak, sekaligus mengatur pertumbuhan populasi melalui pelaksanaan program Keluarga
              Berencana. Kontribusi utamanya adalah meningkatkan kesejahteraan publik melalui serangkaian program yang
              sistematis, terukur, dan didukung oleh data.
            </p>
          </div>
        </div>

        <!-- Right: Logo -->
        <div class="col-lg-5 text-center" data-aos="fade-up" data-aos-delay="160">
          <div class="about-logo">
            <!-- Replace the src with the official DP3AP2KB logo when available -->
            <img src="<?= base_url('landingpage/') ?>assets/img/logo_dp3ap2kb.svg" alt="DP3AP2KB Logo"
              class="img-fluid" />
          </div>
        </div>
      </div>

    </div>
  </section><!-- /Tentang Kami Section -->

<<<<<<< HEAD
  <!-- Tujuan Section -->
  <section id="testimonials" class="testimonials section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Misi P3AP2KB</h2>
=======
  <!-- Misi Section -->
  <section id="testimonials" class="testimonials section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Misi DP3AP2KB</h2>
>>>>>>> dbbb264a17e71fa49edeff41932464a2c854d5b0
      <p>Mewujudkan Dinas P3AP2KB yang Profesional, Inovatif, dan Terpercaya dalam Memberikan Pelayanan Terbaik
        kepada Masyarakat
      </p>
    </div><!-- End Section Title -->

    <!-- Misi section -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">
        <div class="col-12">
          <div class="critic-reviews" data-aos="fade-up" data-aos-delay="300">
            <div class="row">
              <div class="col-md-3">
                <div class="critic-review misi-card">
                  <h5 class="misi-title">Misi 1 :</h5>
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana Kabupaten Tanah Laut berperan aktif dalam meningkatkan partisipasi masyarakat terhadap program Pengendalian Penduduk Keluarga Berencana guna meningkatkan ketahanan dan pemberdayaan keluarga di Kabupaten Tanah Laut.</p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="critic-review misi-card">
                  <h5 class="misi-title">Misi 2 :</h5>
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana berupaya untuk pemenuhan hak anak untuk mendapatkan kualitas hidup dan berperan serta di berbagai bidang pembangunan di Kabupaten Tanah Laut.</p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="critic-review misi-card">
                  <h5 class="misi-title">Misi 3 :</h5>
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana berperan dalam meningkatkan perlindungan perempuan dan anak.</p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="critic-review misi-card">
                  <h5 class="misi-title">Misi 4 :</h5>
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana berperan aktif dalam meningkatkan kualitas pelayanan administrasi organisasi.</p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Tujuan Section -->
  <section id="tujuan" class="testimonials section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Tujuan DP3AP2KB</h2>
      <p>Meningkatkann Kualitas Hidup Perempuan, Anak, dan Keluarga melalui Program Pemberdayaan, Perlindungan, Pengendalian Penduduk, dan Keluarga Berencana yang Terintegrasi dan Berkelanjutan</p>
    </div><!-- End Section Title -->

    <!-- Tujuan content -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-12">
          <ul class="tujuan-list">
            <li class="tujuan-item">
              <div class="icon bg-accent"><i class="bi bi-people-fill"></i></div>
              <p>Meningkatkan partisipasi masyarakat terhadap program pengendalian penduduk Keluarga Berencana, ketahanan dan pemberdayaan keluarga;</p>
            </li>

            <li class="tujuan-item">
              <div class="icon bg-accent"><i class="bi bi-person-fill"></i></div>
              <p>Meningkatkan Pemberdayaan Perempuan dan pemenuhan hak anak;</p>
            </li>

            <li class="tujuan-item">
              <div class="icon bg-accent"><i class="bi bi-shield-lock-fill"></i></div>
              <p>Meningkatkan perlindungan perempuan dan anak dari berbagai tindak kekerasan, eksploitasi, Tindak Pidana Perdagangan Orang (TPPO) dan diskriminasi;</p>
            </li>

            <li class="tujuan-item">
              <div class="icon bg-accent"><i class="bi bi-gear-fill"></i></div>
              <p>Meningkatkan Kualitas Pelayanan Administrasi Organisasi.</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section><!-- /tujuan Section -->

  <!-- Link Terkait Section -->
  <section id="recent-blog-posts" class="recent-blog-posts section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <!-- Swiper-based Related Links Carousel -->

      <!-- Swiper CSS (CDN) -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

      <style>
        /* Swiper slide layout */
        .related-swiper .swiper-slide { width: 220px; background: #fff; border-radius: 10px; padding: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,.08); color: inherit; text-decoration: none; }
        .related-swiper .swiper-slide:hover { transform: translateY(-6px); transition: transform .2s; }
        .related-swiper .logo { height: 36px; margin-bottom: 8px; display: block; margin-left: auto; margin-right: auto; }
        .related-swiper .title { font-size: .95rem; color: #333; display: block; }
        .related-prev, .related-next { position: absolute; top:50%; transform: translateY(-50%); z-index: 10; background: rgba(0,0,0,.45); color:#fff; width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; border:none; cursor:pointer; }
        .related-prev { left:8px; }
        .related-next { right:8px; }

        @media (max-width:768px){ .related-swiper .swiper-slide{ width:160px; } }
      </style>

      <div class="related-swiper-wrapper mt-4">
        <button class="related-prev" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>

        <div class="swiper related-swiper" aria-label="Link Terkait">
          <div class="swiper-wrapper">

            <!-- Slides -->
            <div class="swiper-slide" role="listitem">
              <a href="<?= base_url('/') ?>" target="_blank" rel="noopener">
                <img class="logo" src="<?= base_url('landingpage/') ?>assets/img/logo_dp3ap2kb.svg" alt="DP3AP2KB Logo">
                <span class="title">Website Resmi DP3AP2KB</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://kemenpppa.go.id" target="_blank" rel="noopener">
                <i class="bi bi-people-fill" style="font-size:28px;color:#0d6efd;margin-bottom:6px;display:block;"></i>
                <span class="title">Kementerian PPPA</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://www.bkkbn.go.id" target="_blank" rel="noopener">
                <i class="bi bi-motherboard-fill" style="font-size:28px;color:#198754;margin-bottom:6px;display:block;"></i>
                <span class="title">BKKBN</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://v2.ppid.tanahlautkab.go.id/" target="_blank" rel="noopener">
                <i class="bi bi-file-earmark-text" style="font-size:28px;color:#6f42c1;margin-bottom:6px;display:block;"></i>
                <span class="title">PPID / Informasi Publik</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://portal.tanahlautkab.go.id/" target="_blank" rel="noopener">
                <i class="bi bi-chat-left-text" style="font-size:28px;color:#dc3545;margin-bottom:6px;display:block;"></i>
                <span class="title">Portal Tanah Laut</span>
              </a>
            </div>

          </div>
        </div>

        <button class="related-next" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
      </div>

      <!-- Swiper JS (CDN) -->
      <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
      <script>
        (function(){
          if(typeof Swiper === 'undefined') return;

          const container = document.querySelector('.related-swiper');
          if(!container) return;

          const initialSlides = Array.from(container.querySelectorAll('.swiper-slide'));
          const slidesCount = initialSlides.length;

          const swiper = new Swiper('.related-swiper', {
            loop: true,
            loopedSlides: slidesCount,
            slidesPerView: 'auto',
            spaceBetween: 20,
            freeMode: true,
            freeModeMomentum: false,
            speed: 5000,        // increase to slow down continuous motion
            autoplay: {
              delay: 1, // very small delay for continuous effect
              disableOnInteraction: false,
              pauseOnMouseEnter: true,
              waitForTransition: false
            },
            navigation: {
              nextEl: '.related-next',
              prevEl: '.related-prev'
            },
            // accessible keyboard control
            keyboard: { enabled: true, onlyInViewport: true },
            breakpoints: {
              0: { slidesPerView: 'auto' },
              768: { slidesPerView: 'auto' }
            },
            on: {
              init() {
                // If visible area is larger than content, duplicate slides to avoid stopping
                const wrapper = this.el.querySelector('.swiper-wrapper');
                const viewportWidth = this.el.offsetWidth || window.innerWidth;
                const firstSlide = this.slides && this.slides[0];
                const slideWidth = (firstSlide && firstSlide.offsetWidth) || 220;
                const minNeeded = Math.ceil(viewportWidth / (slideWidth + (this.params.spaceBetween || 20))) + slidesCount;
                let added = 0;
                while(this.slides.length < minNeeded && added < slidesCount * 3){
                  // append clones of the originals
                  const node = initialSlides[added % slidesCount].cloneNode(true);
                  wrapper.appendChild(node);
                  added++;
                }
                if(added){
                  this.update();
                  // recreate loop so Swiper picks up new slides
                  this.loopDestroy();
                  this.loopCreate();
                  this.update();
                }

                // ensure autoplay is running
                try { this.autoplay.start(); } catch(e){}
              }
            }
          });

          // Restart autoplay when using controls
          const prev = document.querySelector('.related-prev');
          const next = document.querySelector('.related-next');
          if(prev) prev.addEventListener('click', ()=> { swiper.slidePrev(); swiper.autoplay.start(); });
          if(next) next.addEventListener('click', ()=> { swiper.slideNext(); swiper.autoplay.start(); });

          // Recalculate on resize
          let resizeTimeout = null;
          window.addEventListener('resize', ()=>{
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(()=>{ swiper.update(); try{ swiper.loopFix(); }catch(e){} }, 200);
          });

        })();
      </script>

  </section><!-- /Link Terkait Section -->

  <!-- Cta Section -->
  <section id="cta" class="cta section light-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row align-items-center">

        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
          <div class="cta-content">
            <h2>Transform Your Future with Expert-Led Online Courses</h2>
            <p>Join thousands of successful learners who have advanced their careers through our comprehensive online
              education platform.</p>

            <div class="features-list">
              <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-check-circle-fill"></i>
                <span>20+ Expert instructors with industry experience</span>
              </div>
              <div class="feature-item" data-aos="fade-up" data-aos-delay="350">
                <i class="bi bi-check-circle-fill"></i>
                <span>Certificate of completion for every course</span>
              </div>
              <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-check-circle-fill"></i>
                <span>24/7 access to course materials and resources</span>
              </div>
              <div class="feature-item" data-aos="fade-up" data-aos-delay="450">
                <i class="bi bi-check-circle-fill"></i>
                <span>Interactive assignments and real-world projects</span>
              </div>
            </div>

            <div class="cta-actions" data-aos="fade-up" data-aos-delay="500">
              <a href="courses.html" class="btn btn-primary">Browse Courses</a>
              <a href="enroll.html" class="btn btn-outline">Enroll Now</a>
            </div>

            <div class="stats-row" data-aos="fade-up" data-aos-delay="400">
              <div class="stat-item">
                <h3><span data-purecounter-start="0" data-purecounter-end="15000" data-purecounter-duration="2"
                    class="purecounter"></span>+</h3>
                <p>Students Enrolled</p>
              </div>
              <div class="stat-item">
                <h3><span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="2"
                    class="purecounter"></span>+</h3>
                <p>Courses Available</p>
              </div>
              <div class="stat-item">
                <h3><span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="2"
                    class="purecounter"></span>%</h3>
                <p>Success Rate</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
          <div class="cta-image">
            <img src="<?= base_url(
              "landingpage/",
            ) ?>assets/img/education/courses-4.webp" alt="Online Learning Platform" class="img-fluid">
            <div class="floating-element student-card" data-aos="zoom-in" data-aos-delay="600">
              <div class="card-content">
                <i class="bi bi-person-check-fill"></i>
                <div class="text">
                  <span class="number">2,450</span>
                  <span class="label">New Students This Month</span>
                </div>
              </div>
            </div>
            <div class="floating-element course-card" data-aos="zoom-in" data-aos-delay="700">
              <div class="card-content">
                <i class="bi bi-play-circle-fill"></i>
                <div class="text">
                  <span class="number">50+</span>
                  <span class="label">Hours of Content</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section><!-- /Cta Section -->

</main>

<?php $this->endSection(); ?>