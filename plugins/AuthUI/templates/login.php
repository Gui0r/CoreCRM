<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - CoreCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Os assets são carregados via hook do plugin -->
</head>
<body>
<div class="auth-container">
    <div class="auth-background"></div>
    <div class="floating-particles"></div>
    <div class="auth-card shadow-2xl animate-scale-in">
        <div class="auth-header">
            <div class="auth-logo animate-bounce">
                <!-- SVG Logo CRM -->
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="48" height="48" rx="12" fill="#3b82f6"/>
                    <path d="M14 34V14h20v20H14zm2-2h16V16H16v16zm4-8a4 4 0 118 0 4 4 0 01-8 0z" fill="#fff"/>
                </svg>
            </div>
            <div class="auth-title gradient-animate">Bem-vindo ao CoreCRM</div>
            <div class="auth-subtitle">Acesse sua conta para continuar</div>
        </div>
        <?php if (!empty($error)): ?>
            <div class="message error animate-shake">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-1.414-1.414A9 9 0 105.636 18.364l1.414 1.414A9 9 0 1018.364 5.636z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="message success animate-fade-in-down">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        <form class="auth-form" method="post" action="/auth/login" autocomplete="on" spellcheck="false">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect ?? '/admin'); ?>">
            <div class="form-group">
                <label class="form-label" for="username">Usuário ou E-mail</label>
                <div class="input-wrapper">
                    <input class="form-input" type="text" id="username" name="username" placeholder="Digite seu usuário ou e-mail" required autofocus autocomplete="username">
                    <span class="input-icon">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Senha</label>
                <div class="input-wrapper">
                    <input class="form-input" type="password" id="password" name="password" placeholder="Digite sua senha" required autocomplete="current-password">
                    <button type="button" class="password-toggle" tabindex="-1" aria-label="Mostrar/ocultar senha">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.832-.64 1.624-1.09 2.357" /></svg>
                    </button>
                </div>
            </div>
            <div class="checkbox-wrapper">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <span class="checkmark"></span>
                </label>
                <label for="remember" class="text-sm text-gray-600 cursor-pointer">Lembrar de mim</label>
            </div>
            <button type="submit" class="btn-primary">Entrar</button>
        </form>
        <div class="auth-links">
            <a href="/auth/forgot-password" class="auth-link">Esqueceu a senha?</a>
            <span class="mx-2">|</span>
            <a href="/auth/register" class="auth-link">Criar conta</a>
        </div>
        <div class="auth-divider"><span>ou</span></div>
        <div class="flex flex-col gap-2">
            <button class="btn-secondary flex items-center justify-center gap-2" type="button" disabled>
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21.35 11.1l-9.17-9.17c-.39-.39-1.02-.39-1.41 0l-9.17 9.17c-.39.39-.39 1.02 0 1.41l9.17 9.17c.39.39 1.02.39 1.41 0l9.17-9.17c.39-.39.39-1.02 0-1.41z"/></svg>
                Entrar com SSO (em breve)
            </button>
            <button class="btn-secondary flex items-center justify-center gap-2" type="button" disabled>
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.84 3.68 8.84 8.36 9.72.61.11.84-.26.84-.58v-2.02c-3.4.74-4.12-1.64-4.12-1.64-.55-1.4-1.34-1.77-1.34-1.77-1.09-.75.08-.74.08-.74 1.2.08 1.83 1.23 1.83 1.23 1.07 1.83 2.8 1.3 3.48.99.11-.78.42-1.3.76-1.6-2.71-.31-5.56-1.36-5.56-6.06 0-1.34.47-2.44 1.23-3.3-.12-.31-.53-1.56.12-3.25 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 016 0c2.29-1.55 3.3-1.23 3.3-1.23.65 1.69.24 2.94.12 3.25.76.86 1.23 1.96 1.23 3.3 0 4.71-2.85 5.75-5.57 6.06.43.37.81 1.1.81 2.22v3.29c0 .32.23.7.85.58C20.32 20.84 24 16.84 24 12c0-5.52-4.48-10-10-10z"/></svg>
                Entrar com GitHub (em breve)
            </button>
        </div>
    </div>
</div>
</body>
</html> 