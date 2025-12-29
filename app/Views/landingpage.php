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
              <div class="main-image" style="position:relative;">
                <img src="<?= base_url("landingpage/") ?>assets/img/education/maria_ulfah.webp" alt="Online Learning"
                  class="img-fluid hero-main-img"
                  style="object-fit:cover; object-position:center; width:100%; height:420px; display:block;"
                  loading="eager" fetchpriority="high" decoding="async" importance="high">

                <div class="floating-card card shadow-sm"
                  style="position:absolute; left:1rem; bottom:1rem; max-width:320px;">
                  <div class="card-body py-2 px-3">
                    <h6 class="mb-0" style="font-weight:700; font-size:1rem;">Maria Ulfah, S.Psi., M.M</h6>
                    <div class="text-muted small">Kepala DP3AP2KB Tanah Laut</div>
                  </div>
                </div>

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
                    <img src="<?= base_url('landingpage/assets/img/blog/blog-post-2.webp') ?>" alt="Default"
                      loading="lazy" decoding="async">
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
              <a href="berita_umum" class="view-all">Lihat Semua <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="news-list-scroll">
              <!-- News Item 1 -->
              <?php foreach ($berita_terbaru as $b): ?>
                <div class="news-list-item">
                  <div class="news-thumbnail">
                    <img
                      src="<?= !empty($b['image']) ? base_url($b['image']) : base_url('landingpage/assets/img/blog/blog-post-2.webp') ?> "
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
    </div>
  </section><!-- /Featured News Section --><!-- /Featured Courses Section -->

  <!-- Inovasi Section -->
  <section id="course-categories" class="course-categories section partners-section">

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
                  <div class="accordion-body">SiDika adalah upaya Pengadilan Agama untuk membuat proses permohonan
                    kawin
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
                    kualitas pengasuhan anak usia dini di TPA, serta memberdayakan orang tua melalui konseling
                    parenting
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
                    kesadaran, dan aksesibilitas masyarakat terhadap layanan Keluarga Berencana hingga ke pelosok
                    desa.
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
            <img src="<?= base_url('landingpage/') ?>assets/img/logo1.png" alt="DP3AP2KB Logo" class="img-fluid" />
          </div>
        </div>
      </div>

    </div>
  </section><!-- /Tentang Kami Section -->


  <section id="testimonials" class="testimonials section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Misi DP3AP2KB</h2>

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
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana
                    Kabupaten Tanah Laut berperan aktif dalam meningkatkan partisipasi masyarakat terhadap program
                    Pengendalian Penduduk Keluarga Berencana guna meningkatkan ketahanan dan pemberdayaan keluarga
                    di Kabupaten Tanah Laut.</p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="critic-review misi-card">
                  <h5 class="misi-title">Misi 2 :</h5>
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana
                    berupaya untuk pemenuhan hak anak untuk mendapatkan kualitas hidup dan berperan serta di
                    berbagai bidang pembangunan di Kabupaten Tanah Laut.</p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="critic-review misi-card">
                  <h5 class="misi-title">Misi 3 :</h5>
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana
                    berperan dalam meningkatkan perlindungan perempuan dan anak.</p>
                </div>
              </div>

              <div class="col-md-3">
                <div class="critic-review misi-card">
                  <h5 class="misi-title">Misi 4 :</h5>
                  <p class="misi-text">Mengandung makna bahwa Badan Pemberdayaan Perempuan dan Keluarga Berencana
                    berperan aktif dalam meningkatkan kualitas pelayanan administrasi organisasi.</p>
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
      <p>Meningkatkann Kualitas Hidup Perempuan, Anak, dan Keluarga melalui Program Pemberdayaan, Perlindungan,
        Pengendalian Penduduk, dan Keluarga Berencana yang Terintegrasi dan Berkelanjutan</p>
    </div><!-- End Section Title -->

    <!-- Tujuan content -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-12">
          <ul class="tujuan-list">
            <li class="tujuan-item">
              <div class="icon bg-accent"><i class="bi bi-people-fill"></i></div>
              <p>Meningkatkan partisipasi masyarakat terhadap program pengendalian penduduk Keluarga Berencana,
                ketahanan dan pemberdayaan keluarga;</p>
            </li>

            <li class="tujuan-item">
              <div class="icon bg-accent"><i class="bi bi-person-fill"></i></div>
              <p>Meningkatkan Pemberdayaan Perempuan dan pemenuhan hak anak;</p>
            </li>

            <li class="tujuan-item">
              <div class="icon bg-accent"><i class="bi bi-shield-lock-fill"></i></div>
              <p>Meningkatkan perlindungan perempuan dan anak dari berbagai tindak kekerasan, eksploitasi, Tindak
                Pidana Perdagangan Orang (TPPO) dan diskriminasi;</p>
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
        .related-swiper .swiper-slide {
          width: 220px;
          background: #fff;
          border-radius: 10px;
          padding: 12px;
          text-align: center;
          box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
          color: inherit;
          text-decoration: none;
        }

        .related-swiper .swiper-slide:hover {
          transform: translateY(-6px);
          transition: transform .2s;
        }

        .related-swiper .logo {
          height: 36px;
          margin-bottom: 8px;
          display: block;
          margin-left: auto;
          margin-right: auto;
        }

        .related-swiper .title {
          font-size: .95rem;
          color: #333;
          display: block;
        }

        .related-prev,
        .related-next {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          z-index: 10;
          background: rgba(0, 0, 0, .45);
          color: #fff;
          width: 36px;
          height: 36px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          border: none;
          cursor: pointer;
        }

        .related-prev {
          left: 8px;
        }

        .related-next {
          right: 8px;
        }

        @media (max-width:768px) {
          .related-swiper .swiper-slide {
            width: 160px;
          }
        }
      </style>

      <div class="related-swiper-wrapper mt-4">


        <div class="swiper related-swiper" aria-label="Link Terkait">
          <div class="swiper-wrapper">

            <!-- Slides -->
            <div class="swiper-slide" role="listitem">
              <a href="<?= base_url('/') ?>" target="_blank" rel="noopener">
                <img class="logo" src="<?= base_url('landingpage/') ?>assets/img/logo1.png" alt="DP3AP2KB Logo">
                <span class="title">Website Resmi DP3AP2KB</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://kemenpppa.go.id" target="_blank" rel="noopener">
                <img class="logo" src="<?= base_url('landingpage/') ?>assets/img/logo_pppa.svg"
                  alt="Kementerian PPPA Logo">
                <span class="title">Kementerian PPPA</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://www.bkkbn.go.id" target="_blank" rel="noopener">
                <img class="logo" src="<?= base_url('landingpage/') ?>assets/img/logo_bkkbn.png" alt="BKKBN Logo">
                <span class="title">BKKBN</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://v2.ppid.tanahlautkab.go.id/" target="_blank" rel="noopener">
                <img class="logo" src="<?= base_url('landingpage/') ?>assets/img/ppid_tanah_laut.png" alt="PPID Logo">
                <span class="title">PPID / Informasi Publik</span>
              </a>
            </div>

            <div class="swiper-slide" role="listitem">
              <a href="https://portal.tanahlautkab.go.id/" target="_blank" rel="noopener">
                <img class="logo" src="<?= base_url('landingpage/') ?>assets/img/logo_tanah_laut.png"
                  alt="Portal Tanah Laut Logo">
                <span class="title">Portal Tanah Laut</span>
              </a>
            </div>

          </div>
        </div>


      </div>

      <!-- Swiper JS (CDN) -->
      <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
      <script>
        (function () {
          if (typeof Swiper === 'undefined') return;

          const container = document.querySelector('.related-swiper');
          if (!container) return;

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
                while (this.slides.length < minNeeded && added < slidesCount * 3) {
                  // append clones of the originals
                  const node = initialSlides[added % slidesCount].cloneNode(true);
                  wrapper.appendChild(node);
                  added++;
                }
                if (added) {
                  this.update();
                  // recreate loop so Swiper picks up new slides
                  this.loopDestroy();
                  this.loopCreate();
                  this.update();
                }

                // ensure autoplay is running
                try { this.autoplay.start(); } catch (e) { }
              }
            }
          });

          // Restart autoplay when using controls
          const prev = document.querySelector('.related-prev');
          const next = document.querySelector('.related-next');
          if (prev) prev.addEventListener('click', () => { swiper.slidePrev(); swiper.autoplay.start(); });
          if (next) next.addEventListener('click', () => { swiper.slideNext(); swiper.autoplay.start(); });

          // Recalculate on resize
          let resizeTimeout = null;
          window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => { swiper.update(); try { swiper.loopFix(); } catch (e) { } }, 200);
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
            <h2>Layanan Darurat <span class="accent">RAZA LAKAS 112 – Cepat, Tanggap, Terintegrasi</span></h2>
            <div class="features-list">
              <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-check-circle-fill"></i>
                <span>Pusat Panggilan Darurat Tunggal (Single Number 112)</span>
              </div>
              <div class="feature-item" data-aos="fade-up" data-aos-delay="350">
                <i class="bi bi-check-circle-fill"></i>
                <span>Layanan 100% Gratis & Bebas Pulsa dari Operator Manapun</span>
              </div>
              <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-check-circle-fill"></i>
                <span>Siaga 24 Jam Non-Stop untuk Kondisi Kedaruratan</span>
              </div>
              <div class="feature-item" data-aos="fade-up" data-aos-delay="450">
                <i class="bi bi-check-circle-fill"></i>
                <span>Terintegrasi dengan Medis, Damkar, BPBD, dan Kepolisian</span>
              </div>
            </div>

            <div class="stats-row" data-aos="fade-up" data-aos-delay="400">
              <div class="stat-item">
                <h3>24/7</h3>
                <p>Jam Operasional</p>
              </div>
              <div class="stat-item">
                <h3><span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="2"
                    class="purecounter"></span></h3>
                <p>Nomor Tunggal</p>
              </div>
              <div class="stat-item">
                <h3>100%</h3>
                <p>Bebas Biaya</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
          <div class="cta-image">
            <div class="swiper cta-swiper">
              <picture>
                <source type="image/webp"
                  srcset="<?= base_url('landingpage/assets/img/education/maria_ulfah-480.webp') ?> 480w, <?= base_url('landingpage/assets/img/education/maria_ulfah-800.webp') ?> 800w, <?= base_url('landingpage/assets/img/education/maria_ulfah-1200.webp') ?> 1200w"
                  sizes="(max-width:576px) 100vw, (max-width:992px) 50vw, 600px">

              </picture>
              <div class="img-fluid">
              </div>
              <div class="swiper-slide">
                <img src="<?= base_url('landingpage/') ?>assets/img/lapor-tala.png" alt="112 Banner" class="img-fluid">
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>

    </div>

    </div>

    <style>
      /* CTA Swiper styles */
      .cta-swiper {
        width: 100%;
        height: 100%;
        position: relative;
      }

      .cta-swiper .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .cta-swiper .swiper-slide img {
        width: 100%;
        height: auto;
        max-height: 420px;
        object-fit: contain;
        display: block;
        border-radius: 6px;
      }

      @media (max-width: 991px) {
        .cta-swiper .swiper-slide img {
          max-height: 260px;
        }
      }
    </style>

    <script>
      (function () {
        if (typeof Swiper === 'undefined') return;
        try {
          const ctaSwiper = new Swiper('.cta-swiper', {
            loop: true,
            effect: 'slide',
            speed: 800,
            autoplay: { delay: 3500, disableOnInteraction: false, pauseOnMouseEnter: true },
            pagination: { el: '.swiper-pagination', clickable: true },
            slidesPerView: 1
          });
        } catch (e) { console.warn('CTA Swiper init failed', e); }
      })();
    </script>

  </section><!-- /Cta Section -->

</main>

<?php $this->endSection(); ?>