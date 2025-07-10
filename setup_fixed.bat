@echo off
echo ========================================
echo    CoreCRM - Setup Completo (FIXED)
echo ========================================
echo.

echo 1. Verificando PHP do XAMPP...
if exist "D:\xampp\php\php.exe" (
    echo PHP encontrado em D:\xampp\php\php.exe
    D:\xampp\php\php.exe --version
) else (
    echo ERRO: PHP nao encontrado em D:\xampp\php\php.exe
    echo Verifique se o XAMPP esta instalado corretamente
    pause
    exit /b 1
)

echo.
echo 2. Verificando Composer...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo AVISO: Composer nao encontrado!
    echo Instale o Composer: https://getcomposer.org/
    echo Ou baixe o composer.phar que ja esta no projeto
    goto :composer_skip
)
echo Composer encontrado!

echo.
echo 3. Instalando dependencias PHP...
if exist "composer.phar" (
    D:\xampp\php\php.exe composer.phar install
) else (
    composer install
)

:composer_skip
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
echo start_server_fixed.bat
echo.
echo Ou manualmente:
echo D:\xampp\php\php.exe -S localhost:8000
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