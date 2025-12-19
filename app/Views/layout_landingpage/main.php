<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dinas P3AP2KB | Pemberdayaan Perempuan, Perlindungan Anak, Pengendalian Penduduk, dan Keluarga Berencana
  </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= base_url("landingpage/") ?>assets/img/logo_tanah_laut.png" rel="icon">
  <link href="<?= base_url(
    "landingpage/",
  ) ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    rel="stylesheet">

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
  <link href="<?= base_url(
    "landingpage/",
  ) ?>assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="<?= base_url(
          "landingpage/",
        ) ?>assets/img/logo1.png" class="img-fluid site-logo" alt="DP3AP2KB-TALA logo">
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
  <div id="preloader"></div>

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

  <!-- Main JS File -->
  <script src="<?= base_url("landingpage/") ?>assets/js/main.js"></script>

</body>

</html>