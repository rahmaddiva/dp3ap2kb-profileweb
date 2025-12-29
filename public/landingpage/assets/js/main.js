/**
* Template Name: Learner
* Template URL: https://bootstrapmade.com/learner-bootstrap-course-template/
* Updated: Jul 08 2025 with Bootstrap v5.3.7
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Toggle header background based on scroll direction
   * - scrolling down: add `nav-solid` to show background
   * - scrolling up: remove `nav-solid` to make header transparent
   */
  (function() {
    const header = document.querySelector('#header');
    if (!header) return;
    let lastScroll = window.pageYOffset || document.documentElement.scrollTop;

    function onScrollDirection() {
      const current = window.pageYOffset || document.documentElement.scrollTop;
      // near top -> always transparent
      if (current <= 10) {
        header.classList.remove('nav-solid');
      } else if (current > lastScroll && current > 40) {
        // scrolling down
        header.classList.add('nav-solid');
      } else {
        // scrolling up
        header.classList.remove('nav-solid');
      }
      lastScroll = current <= 0 ? 0 : current;
    }

    window.addEventListener('scroll', onScrollDirection, { passive: true });
    window.addEventListener('load', onScrollDirection);
  })();

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  // Slider initialization: run after load to ensure DOM elements exist
  let currentSlideIndex = 1;
  let autoPlayInterval = null;

  function moveSlide(n) {
    if (autoPlayInterval) clearInterval(autoPlayInterval);
    showSlide(currentSlideIndex += n);
    autoPlayInterval = setInterval(() => {
      moveSlide(1);
    }, 10000);
  }

  function currentSlide(n) {
    if (autoPlayInterval) clearInterval(autoPlayInterval);
    showSlide(currentSlideIndex = n);
    autoPlayInterval = setInterval(() => {
      moveSlide(1);
    }, 10000);
  }

  function showSlide(n) {
    const slides = document.querySelectorAll('.slide-item');
    const dots = document.querySelectorAll('.dot');

    // Guard: if there are no slides, do nothing
    if (!slides || slides.length === 0) return;

    if (n > slides.length) {
      currentSlideIndex = 1;
    }
    if (n < 1) {
      currentSlideIndex = slides.length;
    }

    slides.forEach(slide => {
      slide.classList.remove('active');
    });

    if (dots && dots.length) {
      dots.forEach(dot => {
        dot.classList.remove('active');
      });
    }

    slides[currentSlideIndex - 1].classList.add('active');
    if (dots && dots.length) dots[currentSlideIndex - 1]?.classList.add('active');
  }

  function initFeaturedNewsSlider() {
    const sliderEl = document.querySelector('.featured-news-slider');
    // Start autoplay only if slider exists
    const slides = document.querySelectorAll('.slide-item');
    if (!sliderEl || !slides || slides.length === 0) return;

    // Show first slide immediately
    showSlide(currentSlideIndex);

    // Auto play slider
    autoPlayInterval = setInterval(() => {
      moveSlide(1);
    }, 10000);

    // Pause auto-play when hovering
    sliderEl.addEventListener('mouseenter', () => {
      if (autoPlayInterval) clearInterval(autoPlayInterval);
    });

    sliderEl.addEventListener('mouseleave', () => {
      if (autoPlayInterval) clearInterval(autoPlayInterval);
      autoPlayInterval = setInterval(() => {
        moveSlide(1);
      }, 10000);
    });

    // Expose slider functions to global scope so inline `onclick` handlers work
    window.moveSlide = moveSlide;
    window.currentSlide = currentSlide;
    window.showSlide = showSlide;
  }

  window.addEventListener('load', initFeaturedNewsSlider);

  /*
   * Pricing Toggle
   */

  const pricingContainers = document.querySelectorAll('.pricing-toggle-container');

  pricingContainers.forEach(function(container) {
    const pricingSwitch = container.querySelector('.pricing-toggle input[type="checkbox"]');
    const monthlyText = container.querySelector('.monthly');
    const yearlyText = container.querySelector('.yearly');

    pricingSwitch.addEventListener('change', function() {
      const pricingItems = container.querySelectorAll('.pricing-item');

      if (this.checked) {
        monthlyText.classList.remove('active');
        yearlyText.classList.add('active');
        pricingItems.forEach(item => {
          item.classList.add('yearly-active');
        });
      } else {
        monthlyText.classList.add('active');
        yearlyText.classList.remove('active');
        pricingItems.forEach(item => {
          item.classList.remove('yearly-active');
        });
      }
    });
  });

})();