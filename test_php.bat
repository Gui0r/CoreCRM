@echo off
echo ========================================
echo    Testando PHP do XAMPP
echo ========================================
echo.

echo 1. Verificando se o PHP existe...
if exist "D:\xampp\php\php.exe" (
    echo PHP encontrado em D:\xampp\php\php.exe
) else (
    echo ERRO: PHP nao encontrado em D:\xampp\php\php.exe
    pause
    exit /b 1
)

echo.
echo 2. Testando versao do PHP...
D:\xampp\php\php.exe --version
if %errorlevel% neq 0 (
    echo ERRO: PHP nao esta funcionando corretamente
    pause
    exit /b 1
)

echo.
echo 3. Testando se o PHP pode executar scripts...
echo ^<?php echo "PHP funcionando!"; ?^> > test.php
D:\xampp\php\php.exe test.php
del test.php

echo.
echo ========================================
echo    PHP funcionando corretamente!
echo ========================================
echo.
echo Agora voce pode executar:
echo start_server.bat
echo.
pause 