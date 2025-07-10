@echo off
echo ========================================
echo    CoreCRM - Setup Completo
echo ========================================
echo.

echo 1. Verificando PHP...
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERRO: PHP nao encontrado!
    echo Instale o PHP e adicione ao PATH
    pause
    exit /b 1
)
echo PHP encontrado!

echo.
echo 2. Verificando Composer...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERRO: Composer nao encontrado!
    echo Instale o Composer: https://getcomposer.org/
    pause
    exit /b 1
)
echo Composer encontrado!

echo.
echo 3. Instalando dependencias PHP...
composer install

echo.
echo 4. Verificando Node.js...
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo AVISO: Node.js nao encontrado!
    echo O CSS ja esta gerado, mas se quiser modificar:
    echo Instale o Node.js: https://nodejs.org/
    goto :css_skip
)

echo.
echo 5. Instalando dependencias Node.js...
npm install

echo.
echo 6. Gerando CSS...
npm run build:css

:css_skip
echo.
echo ========================================
echo    Setup Concluido!
echo ========================================
echo.
echo Para iniciar o servidor, execute:
echo start_server.bat
echo.
echo Ou manualmente:
echo php -S localhost:8000
echo.
echo URLs disponiveis:
echo - Login: http://localhost:8000/login
echo - Admin: http://localhost:8000/admin
echo.
echo Credenciais de teste:
echo - Admin: admin / admin123
echo - User: user / user123
echo.
pause 