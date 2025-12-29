<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>COMING SOON</title>
    <style>
        :root {
            --bg1: #07103a;
            --bg2: #0f172a;
            --accent1: #6EE7B7;
            --accent2: #60A5FA;
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background:
                radial-gradient(600px 400px at 10% 20%, rgba(96, 165, 250, 0.10), transparent 15%),
                radial-gradient(500px 360px at 90% 80%, rgba(110, 231, 183, 0.06), transparent 14%),
                linear-gradient(135deg, var(--bg1), var(--bg2));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #fff;
            overflow: hidden;
        }

        .card {
            width: 100%;
            max-width: 980px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.02));
            border-radius: 18px;
            padding: 44px;
            display: flex;
            gap: 28px;
            align-items: center;
            box-shadow: 0 20px 50px rgba(2, 6, 23, 0.6);
            backdrop-filter: blur(6px);
        }

        .left {
            flex: 1;
            min-width: 0
        }

        .title {
            margin: 0 0 8px 0;
            font-weight: 800;
            text-transform: uppercase;
            font-size: clamp(28px, 6vw, 64px);
            letter-spacing: 4px;
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .subtitle {
            margin: 0 0 18px 0;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .meta {
            display: flex;
            gap: 14px;
            align-items: center;
            color: rgba(255, 255, 255, 0.88);
            font-size: 0.95rem
        }

        .badge {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.04);
            font-weight: 600;
            color: var(--accent2);
        }

        .action {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 16px;
            border-radius: 12px;
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            color: #06202a;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 8px 26px rgba(96, 165, 250, 0.12);
        }

        .right {
            width: 320px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .illustration {
            width: 260px;
            height: 260px
        }

        .float {
            animation: float 4s ease-in-out infinite
        }

        @keyframes float {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-14px)
            }

            100% {
                transform: translateY(0)
            }
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 12px;
            text-align: center;
            color: rgba(255, 255, 255, 0.38);
            font-size: 13px
        }

        @media (max-width:780px) {
            .card {
                flex-direction: column;
                text-align: center;
                padding: 28px
            }

            .right {
                width: 100%
            }
        }
    </style>
</head>

<body>
    <main class="card" role="main" aria-label="Coming Soon">
        <section class="left">
            <h1 class="title">COMING SOON</h1>
            <p class="subtitle">Situs ini sedang kami siapkan. Terima kasih atas kesabaran Anda — sesuatu yang hebat
                akan segera hadir.</p>
            <div class="meta">
                <span class="badge">Peluncuran: Segera</span>
                <span>Ikuti update untuk pemberitahuan rilis</span>
            </div>
            <a class="action" href="/" role="button">Kembali</a>
        </section>

        <aside class="right" aria-hidden="false">
            <!-- Ilustrasi inline SVG (rocket) sebagai gambar pendukung -->
            <svg class="illustration float" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" role="img"
                aria-label="Ilustrasi roket">
                <defs>
                    <linearGradient id="gradA" x1="0" x2="1">
                        <stop offset="0" stop-color="#6EE7B7" />
                        <stop offset="1" stop-color="#60A5FA" />
                    </linearGradient>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <circle cx="256" cy="256" r="200" fill="url(#gradA)" opacity="0.08" />
                    <g transform="translate(120 56)">
                        <path
                            d="M128 0c-44 0-120 48-120 48s48 92 88 132c40 40 136 88 136 88s44-108 44-152c0-44-76-116-148-116z"
                            fill="url(#gradA)" />
                        <ellipse cx="128" cy="160" rx="28" ry="28" fill="#06202a" opacity="0.12" />
                        <path d="M110 148c-8 0-14 6-14 6s6 6 14 6 14-6 14-6-6-6-14-6z" fill="#fff" opacity="0.2" />
                        <g transform="translate(0 220)" fill="#fff" opacity="0.06">
                            <ellipse cx="18" cy="46" rx="18" ry="28" />
                            <ellipse cx="236" cy="46" rx="18" ry="28" />
                        </g>
                    </g>
                </g>
            </svg>
        </aside>
    </main>

    <div class="footer">dp3ap2kb-tala • &copy; <?= date('Y') ?></div>
</body>

</html>