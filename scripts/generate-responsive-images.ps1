# PowerShell script to generate responsive WebP images using ImageMagick
# Run from project root in Windows PowerShell where ImageMagick is available (magick command)

$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$src = Join-Path $root "..\public\landingpage\assets\img\education\maria_ulfah.webp"
$dstDir = Join-Path $root "..\public\landingpage\assets\img\education"

if (-not (Test-Path $src)) {
    Write-Error "Source image not found: $src"
    exit 1
}

# Ensure destination exists
if (-not (Test-Path $dstDir)) { New-Item -ItemType Directory -Path $dstDir | Out-Null }

# Generate sizes (480, 800, 1200) - quality 80
magick "$src" -resize 480 -quality 80 "$dstDir\maria_ulfah-480.webp"
magick "$src" -resize 800 -quality 82 "$dstDir\maria_ulfah-800.webp"
magick "$src" -resize 1200 -quality 84 "$dstDir\maria_ulfah-1200.webp"

Write-Output "Generated responsive images in $dstDir"
