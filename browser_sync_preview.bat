@echo off
echo ========================================
echo    CoreCRM - Browser Sync Preview
echo ========================================
echo.
echo Instalando Browser Sync...
npm install -g browser-sync

echo.
echo Iniciando Browser Sync...
echo Servidor local: http://localhost:3000
echo Servidor externo: http://localhost:3001
echo.
echo URLs para preview:
echo - Login: http://localhost:3000/login
echo - Admin: http://localhost:3000/admin
echo.

REM Inicia o Browser Sync
browser-sync start --proxy "localhost:8000" --files "*.php,*.html,*.css,*.js" --port 3000 --ui-port 3001 