@echo off
echo ========================================
echo    CoreCRM - Quick Preview SEM BANCO
echo ========================================
echo.
echo Abrindo navegador automaticamente...
echo.
echo URLs disponiveis:
echo - Login: http://localhost:8000/login
echo - Admin: http://localhost:8000/admin
echo.
echo Credenciais:
echo - Admin: admin / admin123
echo - User: user / user123
echo.
echo Para parar: Ctrl+C
echo ========================================
echo.

REM Abre o navegador automaticamente
start http://localhost:8000/login

REM Inicia o servidor sem banco
D:\xampp\php\php.exe -S localhost:8000 -t . index_no_db.php 