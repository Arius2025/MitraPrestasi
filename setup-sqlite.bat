@echo off
:: Membuat file SQLite jika belum ada
if not exist database\database.sqlite (
    echo Membuat database.sqlite...
    type nul > database\database.sqlite
) else (
    echo File database.sqlite sudah ada.
)

:: Set konfigurasi .env
echo Mengatur .env untuk SQLite...
powershell -Command "(Get-Content .env) -replace 'DB_CONNECTION=.*', 'DB_CONNECTION=sqlite' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_DATABASE=.*', 'DB_DATABASE=database/database.sqlite' | Set-Content .env"

:: Clear config cache dan migrasi
echo Membersihkan cache konfigurasi dan menjalankan migrasi...
php artisan config:clear
php artisan migrate

echo === Setup SQLite selesai! ===
pause