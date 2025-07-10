@echo off
echo ========================================
echo    CoreCRM - Live Preview
echo ========================================
echo.
echo Servidor rodando em: http://localhost:8000
echo.
echo URLs para preview:
echo - Login: http://localhost:8000/login
echo - Admin: http://localhost:8000/admin
echo.
echo Credenciais:
echo - Admin: admin / admin123
echo - User: user / user123
echo.
echo Pressione Ctrl+C para parar
echo ========================================
echo.

REM Inicia o servidor PHP
D:\xampp\php\php.exe -S localhost:8000 