# Image optimization and responsive variants

Steps to generate responsive images for the hero `maria_ulfah.webp` used by the landing page.

Requirements
- ImageMagick (Windows users: install and ensure `magick` is on PATH)

PowerShell (Windows)
1. From project root run:

```powershell
./scripts/generate-responsive-images.ps1
```

This will create:
- `public/landingpage/assets/img/education/maria_ulfah-480.webp`
- `public/landingpage/assets/img/education/maria_ulfah-800.webp`
- `public/landingpage/assets/img/education/maria_ulfah-1200.webp`

Notes & further improvements
- Consider running `cwebp` for extra WebP tuning if needed.
- Adjust `-quality` values for acceptable visual quality vs file size.
- After generating images, re-run PageSpeed/Lighthouse to confirm LCP improvements.
