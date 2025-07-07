@echo off
set source_dir=%~dp0
set dest_public_html=C:\Users\User\path\to\public_html
set dest_mitraprestasi=C:\Users\User\path\to\mitraprestasi

REM Buat folder tujuan jika belum ada
if not exist "%dest_public_html%" mkdir "%dest_public_html%"
if not exist "%dest_mitraprestasi%" mkdir "%dest_mitraprestasi%"

REM Copy isi folder public ke public_html
xcopy /E /I /Y "%source_dir%public\*" "%dest_public_html%\"

REM Copy semua folder selain public ke mitraprestasi
for %%F in (app bootstrap config database resources routes storage vendor) do (
    xcopy /E /I /Y "%source_dir%%%F" "%dest_mitraprestasi%\%%F\"
)

REM Copy file-file penting
for %%F in (.env artisan composer.json composer.lock package.json) do (
    copy "%source_dir%%%F" "%dest_mitraprestasi%\%%F"
)

REM Konfirmasi selesai
echo Deployment selesai. Silakan upload ke hosting Anda menggunakan File Manager atau FTP.
pause
