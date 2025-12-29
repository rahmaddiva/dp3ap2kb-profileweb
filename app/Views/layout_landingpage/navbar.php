<nav id="navmenu" class="navmenu">
  <ul>
    <li><a href="/" class="active">Beranda</a></li>
    <li class="dropdown"><a href="#"><span>Profil P3AP2KB</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="/pejabat">Pegawai P3AP2KB</a></li>
        <li><a href="/visi-misi">Visi Misi</a></li>
        <li><a href="/tugas-pokok">Tugas Pokok</a></li>
        <li><a href="/dasar-hukum">Dasar Hukum</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#"><span>Berita</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li><a href="/berita_umum">Berita Umum</a></li>
        <li><a href="/artikel_umum">Artikel</a></li>
        <li><a href="/pengumuman_umum">Pengumuman</a></li>
        <li><a href="/foto_umum">Foto</a></li>
        <li><a href="/postingan">Reels</a></li>
        <li><a href="/infografis_umum">InfoGrafis</a></li>
      </ul>
    </li>
    <li><a href="/data">Data</a></li>
    <li><a href="/faq">FAQ</a></li>
    <li class="dropdown"><a href="#"><span>Layanan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
      <ul>
        <li class="dropdown"><a href="#"><span>Hotline</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="https://wa.me/6289527808202">Hotline Whatsapp Pengaduan PPA</a></li>
            <li><a href="http://wa.me/6281349420222">Hotline Konsultasi/Pendaftaran KB</a></li>
          </ul>
        </li>
        <li><a href="https://kampungkb.bkkbn.go.id/">Kampung KB</a></li>
        <li><a href="https://siga.bkkbn.go.id/">SIGA BKKBN</a></li>
      </ul>
    </li>
    <li><a href="/login">Masuk</a></li>
  </ul>
  <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

  <script>
    (function () {
      const nav = document.getElementById('navmenu');
      if (!nav) return;
      const links = Array.from(nav.querySelectorAll('a'));

      function clearActive() {
        links.forEach(l => l.classList.remove('active'));
        nav.querySelectorAll('.dropdown-active').forEach(u => u.classList.remove('dropdown-active'));
      }

      function setActiveLink(link) {
        if (!link) return;
        clearActive();
        link.classList.add('active');

        // open ancestor dropdown uls and mark their anchors active
        let parentLi = link.closest('li.dropdown');
        while (parentLi) {
          const topAnchor = parentLi.querySelector(':scope > a');
          if (topAnchor) topAnchor.classList.add('active');
          const childUl = parentLi.querySelector(':scope > ul');
          if (childUl) childUl.classList.add('dropdown-active');
          parentLi = parentLi.parentElement ? parentLi.parentElement.closest('li.dropdown') : null;
        }
      }

      links.forEach(a => {
        a.addEventListener('click', function () {
          setActiveLink(this);
        });
      });

      const currentPath = location.pathname.replace(/\/+$/, '') || '/';
      const currentHash = location.hash || '';
      let match = null;

      for (const a of links) {
        const href = a.getAttribute('href') || '';
        if (!href || href === '#' || href.startsWith('javascript:')) continue;
        if (href.startsWith('#')) {
          if (href === currentHash) { match = a; break; }
          continue;
        }
        try {
          const url = new URL(href, location.origin);
          if (url.origin !== location.origin) continue; // skip external links
          const linkPath = (url.pathname.replace(/\/+$/, '') || '/');
          if (linkPath === currentPath) { match = a; break; }
          const currentFile = currentPath.split('/').pop();
          if (currentFile && href.endsWith(currentFile)) { match = a; break; }
          if (currentPath !== '/' && currentPath.endsWith(linkPath) && linkPath !== '/') { match = a; break; }
        } catch (err) {
          // ignore malformed
        }
      }

      if (!match && (currentPath === '/' || currentPath === '')) {
        match = links.find(a => a.getAttribute('href') === '/' || a.getAttribute('href') === '/index.html' || a.getAttribute('href') === 'index.html');
      }

      if (match) setActiveLink(match);
    })();
  </script>
</nav>