<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="/assets/img/favicon/logo1.png" alt="Logo" width="100">
            </span>

        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu &amp;
                Utama</span>
        </li>

        <li class="menu-item <?php echo (uri_string() == 'dashboard') ? 'active' : '' ?>">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item <?php echo (uri_string() == 'kelola-berita') ? 'active' : '' ?>">
            <a href="/kelola-berita" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Analytics">Kelola Berita</div>
            </a>
        </li>
        <li class="menu-item <?php echo (uri_string() == 'kelola-artikel') ? 'active' : '' ?>">
            <a href="/kelola-artikel" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file-blank"></i>
                <div data-i18n="Analytics">Kelola Artikel</div>
            </a>
        </li>
        <li class="menu-item <?php echo (uri_string() == 'kelola-pengumuman') ? 'active' : '' ?>">
            <a href="/kelola-pengumuman" class="menu-link">
                <i class="menu-icon tf-icons bx bx-window-open"></i>
                <div data-i18n="Analytics">Kelola Pengumuman</div>
            </a>
        </li>
        <li class="menu-item <?php echo (uri_string() == 'kelola-media') ? 'active' : '' ?>">
            <a href="/kelola-media" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>
                <div data-i18n="Analytics">Kelola Media</div>
            </a>
        </li>
        <li class="menu-item <?php echo (uri_string() == 'kelola-instagram') ? 'active' : '' ?>">
            <a href="/kelola-instagram" class="menu-link">
                <i class="menu-icon tf-icons bx bxl-instagram"></i>
                <div data-i18n="Analytics">Kelola Instagram</div>
            </a>
        </li>



        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu</span></li>
        <!-- Dashboard -->
        <li class="menu-item <?php echo (uri_string() == 'kelola-users') ? 'active' : '' ?>">
            <a href="/kelola-users" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Kelola User</div>
            </a>
        </li>
        <li class="menu-item <?php echo (uri_string() == 'kelola-pegawai') ? 'active' : '' ?>">
            <a href="/kelola-pegawai" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Analytics">Kelola Pegawai</div>
            </a>
        </li>

    </ul>

</aside>
<!-- / Menu -->