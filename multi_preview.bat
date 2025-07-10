@echo off
echo ========================================
echo    CoreCRM - Multi Preview
echo ========================================
echo.
echo Abrindo todas as paginas em abas separadas...
echo.

REM Abre todas as páginas em abas separadas
start http://localhost:8000/login
timeout /t 2 /nobreak >nul
start http://localhost:8000/admin

echo.
echo Servidor iniciado em: http://localhost:8000
echo.
echo Pressione Ctrl+C para parar
echo ========================================
echo.

REM Inicia o servidor
D:\xampp\php\php.exe -S localhost:8000 