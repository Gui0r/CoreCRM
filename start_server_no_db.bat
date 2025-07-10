@echo off
echo ========================================
echo    CoreCRM - Servidor SEM BANCO
echo ========================================
echo.
echo Iniciando servidor PHP SEM banco de dados...
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

REM Inicia o servidor usando o index sem banco
D:\xampp\php\php.exe -S localhost:8000 -t . index_no_db.php

pause 