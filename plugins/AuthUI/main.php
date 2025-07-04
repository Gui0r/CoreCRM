<?php

// Hook para carregar assets do plugin
HookHandler::register_hook("before_render", function() {
    $pluginPath = __DIR__;
    $pluginData = json_decode(file_get_contents($pluginPath . "/plugin.json"), true);
    
    if (isset($pluginData["assets"]["css"])) {
        foreach ($pluginData["assets"]["css"] as $cssFile) {
            $cssPath = $pluginPath . "/" . $cssFile;
            if (file_exists($cssPath)) {
                echo "<link rel='stylesheet' href='/plugins/auth-ui/" . $cssFile . "'>\n";
            }
        }
    }
    
    if (isset($pluginData["assets"]["js"])) {
        foreach ($pluginData["assets"]["js"] as $jsFile) {
            $jsPath = $pluginPath . "/" . $jsFile;
            if (file_exists($jsPath)) {
                echo "<script src='/plugins/auth-ui/" . $jsFile . "'></script>\n";
            }
        }
    }
});

// Rota de login (GET) - Interface moderna
RoutesHandler::addRoute("GET", "/auth/login", function() {
    $error = $_GET['error'] ?? '';
    $success = $_GET['success'] ?? '';
    $redirect = $_GET['redirect'] ?? '/admin';
    
    // Hook antes do login
    HookHandler::execute_hook("before_login", ['action' => 'display_form']);
    
    include __DIR__ . '/templates/login.php';
});

// Rota de login (POST) - Processamento
RoutesHandler::addRoute("POST", "/auth/login", function() {
    $error = '';
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    $redirect = $_POST['redirect'] ?? '/admin';
    $remember = isset($_POST['remember']);
    
    // Hook antes do login
    HookHandler::execute_hook("before_login", ['username' => $user, 'action' => 'process']);
    
    // Usuários de teste (em produção, viria do banco de dados)
    $users = [
        'admin' => [
            'password' => '$argon2id$v=19$m=65536,t=4,p=1$VlBaWVhocXRpcHBLSXdNZA$junmjqeOW2EN90RPy0Z5MLxu30YgUVg4/yrvY0pzqs4',
            'role' => 'admin',
            'name' => 'Administrador',
            'email' => 'admin@crm.com',
            'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face'
        ],
        'user' => [
            'password' => '$argon2id$v=19$m=65536,t=4,p=1$cXNHUzU3aVBUbEUudEZLVQ$qLfEhKVj0ssf7re1zwiOsHWL4bA7Y+y1CqEJY9x5p0c',
            'role' => 'user',
            'name' => 'Usuário Padrão',
            'email' => 'user@crm.com',
            'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face'
        ],
        'manager' => [
            'password' => '$argon2id$v=19$m=65536,t=4,p=1$cXNHUzU3aVBUbEUudEZLVQ$qLfEhKVj0ssf7re1zwiOsHWL4bA7Y+y1CqEJY9x5p0c',
            'role' => 'manager',
            'name' => 'Gerente',
            'email' => 'manager@crm.com',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face'
        ]
    ];
    
    if (isset($users[$user]) && AuthHandler::verifyPassword($pass, $users[$user]['password'])) {
        // Login bem-sucedido
        AuthHandler::login($user, $users[$user]['role']);
        
        // Salvar dados adicionais na sessão
        $_SESSION['user_name'] = $users[$user]['name'];
        $_SESSION['user_email'] = $users[$user]['email'];
        $_SESSION['user_avatar'] = $users[$user]['avatar'];
        
        if ($remember) {
            // Implementar "Lembrar de mim" com cookie seguro
            setcookie('remember_token', bin2hex(random_bytes(32)), time() + (30 * 24 * 60 * 60), '/', '', true, true);
        }
        
        // Hook após login bem-sucedido
        HookHandler::execute_hook("after_login", [
            'username' => $user,
            'role' => $users[$user]['role'],
            'success' => true
        ]);
        
        // Redirecionar para a rota original, se for segura
        if (strpos($redirect, '/') === 0) {
            AuthHandler::redirect($redirect);
        } else {
            AuthHandler::redirect('/admin');
        }
    } else {
        // Login falhou
        $error = 'Usuário ou senha inválidos!';
        
        // Hook após login falhado
        HookHandler::execute_hook("after_login", [
            'username' => $user,
            'success' => false,
            'error' => $error
        ]);
        
        AuthHandler::redirect("/auth/login?error=" . urlencode($error) . "&redirect=" . urlencode($redirect));
    }
});

// Rota de logout
RoutesHandler::addRoute("GET", "/auth/logout", function() {
    // Hook antes do logout
    HookHandler::execute_hook("before_logout", ['user_id' => $_SESSION['user_id'] ?? null]);
    
    AuthHandler::logout();
    
    // Hook após logout
    HookHandler::execute_hook("after_logout", ['success' => true]);
    
    AuthHandler::redirect("/auth/login?success=" . urlencode("Logout realizado com sucesso!"));
});

// Rota de recuperação de senha (GET)
RoutesHandler::addRoute("GET", "/auth/forgot-password", function() {
    $error = $_GET['error'] ?? '';
    $success = $_GET['success'] ?? '';
    include __DIR__ . '/templates/forgot-password.php';
});

// Rota de recuperação de senha (POST)
RoutesHandler::addRoute("POST", "/auth/forgot-password", function() {
    $email = $_POST['email'] ?? '';
    
    // Em produção, aqui seria enviado um email com link de reset
    // Por enquanto, apenas simular sucesso
    $success = "Se o email existir em nossa base, você receberá um link para redefinir sua senha.";
    
    AuthHandler::redirect("/auth/forgot-password?success=" . urlencode($success));
});

// Rota de registro (GET)
RoutesHandler::addRoute("GET", "/auth/register", function() {
    $error = $_GET['error'] ?? '';
    $success = $_GET['success'] ?? '';
    include __DIR__ . '/templates/register.php';
});

// Rota de registro (POST)
RoutesHandler::addRoute("POST", "/auth/register", function() {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validações básicas
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Todos os campos são obrigatórios.";
        AuthHandler::redirect("/auth/register?error=" . urlencode($error));
        return;
    }
    
    if ($password !== $confirm_password) {
        $error = "As senhas não coincidem.";
        AuthHandler::redirect("/auth/register?error=" . urlencode($error));
        return;
    }
    
    if (strlen($password) < 6) {
        $error = "A senha deve ter pelo menos 6 caracteres.";
        AuthHandler::redirect("/auth/register?error=" . urlencode($error));
        return;
    }
    
    // Em produção, aqui seria salvo no banco de dados
    $success = "Conta criada com sucesso! Você pode fazer login agora.";
    AuthHandler::redirect("/auth/login?success=" . urlencode($success));
});

// Log de carregamento do plugin
System::log("Plugin AuthUI carregado com sucesso."); 