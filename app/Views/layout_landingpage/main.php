<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dinas P3AP2KB | Pemberdayaan Perempuan, Perlindungan Anak, Pengendalian Penduduk, dan Keluarga Berencana
  </title>
  <meta name="description" content="">
  <?= $this->renderSection('meta') ?>
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= base_url("landingpage/") ?>assets/img/logo_tanah_laut.png" rel="icon">
  <link href="<?= base_url(
    "landingpage/",
  ) ?>assets/img/logo_tanah_laut.png" rel="apple-touch-icon">

  <!-- Preload hero image to improve LCP on mobile -->
  <link rel="preload" as="image" href="<?= base_url('landingpage/assets/img/education/maria_ulfah-1200.webp') ?>">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <!-- Preload Google Fonts stylesheet to avoid render-blocking and keep preconnect -->
  <link rel="preload"
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    as="style" onload="this.rel='stylesheet'">
  <noscript>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
      rel="stylesheet">
  </noscript>

  <!-- font DM Sans -->
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">
  <!-- font Urbanist -->
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <!-- Load main css with preload to prioritize critical CSS -->
  <link rel="preload" href="<?= base_url("landingpage/") ?>assets/css/main.css" as="style"
    onload="this.rel='stylesheet'">
  <noscript>
    <link href="<?= base_url("landingpage/") ?>assets/css/main.css" rel="stylesheet">
  </noscript>

  <!-- Critical CSS for hero to reduce LCP render-blocking -->
  <style>
    /* Reserve space for hero image and ensure it paints quickly */
    .hero-image .main-image {
      position: relative;
    }

    .hero-main-img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
      aspect-ratio: 16/9;
    }

    @media (max-width:480px) {
      .hero-main-img {
        aspect-ratio: 4/3;
      }
    }
  </style>

  <!-- Lenis Smooth Scroll CSS -->
  <style>
    html.lenis {
      height: auto;
    }

    .lenis.lenis-smooth {
      scroll-behavior: auto;
    }

    .lenis.lenis-smooth [data-lenis-prevent] {
      overscroll-behavior: contain;
    }

    .lenis.lenis-stopped {
      overflow: hidden;
    }

    .lenis.lenis-scrolling iframe {
      pointer-events: none;
    }

    /* Scroll-top button styling */
    #scroll-top {
      transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
    }

    #scroll-top.visible {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    /* Tighten preloader logo on small screens */
    @media (max-width: 480px) {
      #preloader img {
        width: 48%;
        max-width: 160px;
      }
    }
  </style>

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="<?= base_url(
          "landingpage/",
        ) ?>assets/img/logo1.png" class="img-fluid" style="max-height: 40px;" alt="DP3AP2KB-TALA logo">
      </a>

      <!--include-->
      <?= $this->include("layout_landingpage/navbar.php") ?>

    </div>
  </header>


  <?= $this->renderSection("content") ?>

  <?= $this->include("layout_landingpage/footer.php") ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div class="preloader-container">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url(
    "landingpage/",
  ) ?>assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- GSAP core + ScrollTrigger (CDN) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  <!-- Lenis Smooth Scroll Library (unpkg CDN) -->
  <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

  <!-- Lenis Integration with GSAP ScrollTrigger -->
  <script>
    // Initialize Lenis
    const lenis = new Lenis({
      duration: 1.2,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      orientation: 'vertical',
      gestureOrientation: 'vertical',
      smoothWheel: true,
      wheelMultiplier: 1,
      smoothTouch: false,
      touchMultiplier: 2,
      infinite: false,
    });

    // Request animation frame loop
    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    // Integrate Lenis with GSAP ScrollTrigger
    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      lenis.on('scroll', ScrollTrigger.update);

      gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
      });

      gsap.ticker.lagSmoothing(0);
    }

    // Helper function to get header offset
    function getOffset() {
      const header = document.getElementById('header');
      return header ? (header.offsetHeight || 0) + 20 : 20;
    }

    // Smooth scroll to element using Lenis
    function smoothScrollTo(target) {
      let element;

      if (typeof target === 'number') {
        lenis.scrollTo(target, {
          offset: 0,
          duration: 1.2,
          easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
        });
        return;
      }

      if (typeof target === 'string') {
        element = document.querySelector(target);
      } else if (target instanceof Element) {
        element = target;
      }

      if (element) {
        lenis.scrollTo(element, {
          offset: -getOffset(),
          duration: 1.2,
          easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
        });
      }
    }

    // Handle anchor links
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          const href = this.getAttribute('href');

          if (!href || href === '#') {
            e.preventDefault();
            smoothScrollTo(0);
            return;
          }

          const targetElement = document.querySelector(href);
          if (targetElement) {
            e.preventDefault();
            smoothScrollTo(targetElement);
            history.pushState(null, '', href);
          }
        });
      });

      // Scroll-to-top button
      const scrollTopBtn = document.getElementById('scroll-top');

      lenis.on('scroll', ({ scroll }) => {
        if (!scrollTopBtn) return;

        if (scroll > 360) {
          scrollTopBtn.classList.add('visible');
        } else {
          scrollTopBtn.classList.remove('visible');
        }
      });

      if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', function (e) {
          e.preventDefault();
          smoothScrollTo(0);
          if (window.location.hash === '#') {
            history.replaceState(null, '', window.location.pathname + window.location.search);
          }
        });
      }

      // Handle initial hash on page load
      if (window.location.hash) {
        const initialTarget = document.querySelector(window.location.hash);
        if (initialTarget) {
          setTimeout(() => smoothScrollTo(initialTarget), 300);
        }
      }

      // Refresh ScrollTrigger on window resize
      window.addEventListener('resize', () => {
        if (window.ScrollTrigger) {
          ScrollTrigger.refresh();
        }
      });
    });

    // Stop Lenis on specific elements (like modals or carousels)
    // Add data-lenis-prevent attribute to elements that should prevent smooth scroll
    document.querySelectorAll('[data-lenis-prevent]').forEach(el => {
      el.addEventListener('wheel', (e) => {
        e.stopPropagation();
      }, { passive: false });
    });
  </script>

  <!-- Main JS File -->
  <script src="<?= base_url("landingpage/") ?>assets/js/main.js"></script>

</body>

</html>