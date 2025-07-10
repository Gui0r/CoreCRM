@echo off
echo ========================================
echo    CoreCRM - Servidor COM CSS
echo ========================================
echo.
echo Iniciando servidor PHP com suporte a CSS...
echo.
echo URLs disponiveis:
echo - Login: http://localhost:8000/login
echo - Admin: http://localhost:8000/admin
echo.
echo Credenciais de teste:
echo - Admin: admin / admin123
echo - User: user / user123
echo.
echo Pressione Ctrl+C para parar o servidor
echo ========================================
echo.

REM Inicia o servidor usando o router
D:\xampp\php\php.exe -S localhost:8000 router.php

pause 