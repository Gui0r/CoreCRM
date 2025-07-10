@echo off
echo ========================================
echo    CoreCRM - Build CSS
echo ========================================
echo.
echo Instalando dependencias...
npm install

echo.
echo Gerando CSS...
npm run build:css

echo.
echo CSS gerado com sucesso!
echo Arquivo: output.css
echo.
pause 