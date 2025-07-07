$source = "C:\Users\User\Documents\mitraprestasi"  # Ganti dengan path proyek Laravel kamu
$zipTarget = "C:\Users\User\Documents\laravel_upload.zip"

# Buat daftar folder dan file yang mau di-zip
$include = @("vendor", "bootstrap\cache", ".env")

# Hapus zip lama kalau sudah ada
if (Test-Path $zipTarget) {
    Remove-Item $zipTarget
}

# Buat file ZIP
Compress-Archive -Path ($include | ForEach-Object { Join-Path $source $_ }) -DestinationPath $zipTarget -Force

Write-Host "✅ ZIP berhasil dibuat di: $zipTarget"
