@echo off
echo ========================================
echo    CoreCRM - Servidor Local (FIXED)
echo ========================================
echo.
echo Iniciando servidor PHP...
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

REM Usando o caminho completo do PHP do XAMPP
D:\xampp\php\php.exe -S localhost:8000

pause 