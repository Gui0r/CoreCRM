<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CoreCRM</title>
    <link href="/output.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .professional-text {
            color: #1e293b;
        }
        .professional-text-light {
            color: #64748b;
        }
        .professional-border {
            border-color: #cbd5e1;
        }
        .professional-input {
            background: rgba(255, 255, 255, 0.9);
            border-color: #cbd5e1;
            color: #1e293b;
        }
        .professional-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .professional-button {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .professional-button:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden">
        
        <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-slate-200 opacity-40 rounded-full floating-animation" style="animation-delay: -3s;"></div>
        <div class="absolute top-3/4 left-1/2 w-32 h-32 bg-gray-200 opacity-50 rounded-full floating-animation" style="animation-delay: -1.5s;"></div>
    </div>

    <!-- Main login container -->
    <div class="relative z-10 w-full max-w-md">
        <!-- Logo/Brand section -->
        <div class="text-center mb-8" id="brand-section">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold professional-text mb-2">CoreCRM</h1>
            <p class="professional-text-light text-sm">Sistema de Gestão de Relacionamento</p>
        </div>

        <!-- Login form -->
        <div class="glass-effect rounded-2xl p-8" id="login-form">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-semibold professional-text mb-2">Bem-vindo de volta</h2>
                <p class="professional-text-light text-sm">Faça login para acessar sua conta</p>
            </div>

            <form method="post" action="/login" class="space-y-6">
                <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect ?? '/admin'); ?>">
                
                <!-- Username field -->
                <div class="form-group">
                    <label for="user" class="block text-sm font-medium professional-text mb-2">
                        Usuário
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 professional-text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="user" 
                            name="user" 
                            required
                            class="w-full pl-10 pr-4 py-3 professional-input border rounded-lg placeholder-gray-400 focus:outline-none transition-all duration-300"
                            placeholder="Digite seu usuário"
                        >
                    </div>
                </div>

                <!-- Password field -->
                <div class="form-group">
                    <label for="password" class="block text-sm font-medium professional-text mb-2">
                        Senha
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 professional-text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full pl-10 pr-4 py-3 professional-input border rounded-lg placeholder-gray-400 focus:outline-none transition-all duration-300"
                            placeholder="Digite sua senha"
                        >
                    </div>
                </div>

                <!-- Submit button -->
                <button 
                    type="submit" 
                    id="login-btn"
                    class="w-full professional-button font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                >
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Entrar
                    </span>
                </button>
            </form>

            <!-- Error message -->
            <?php if (!empty($error)) { ?>
                <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg" id="error-message">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-red-700 text-sm"><?php echo htmlspecialchars($error); ?></p>
                    </div>
                </div>
            <?php } ?>

            <!-- Additional links -->
            <div class="mt-6 text-center">
                <p class="professional-text-light text-sm">
                    Esqueceu sua senha? 
                    <a href="#" class="text-blue-600 hover:text-blue-700 transition-colors duration-300 underline">
                        Recuperar acesso
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="professional-text-light text-xs">
                © 2024 CoreCRM. Todos os direitos reservados.
            </p>
        </div>
    </div>

    <script>
        // Animation timeline
        const tl = anime.timeline({
            easing: 'easeOutExpo',
            duration: 800
        });

        // Initial setup - hide elements
        anime.set(['#brand-section', '#login-form'], {
            opacity: 0,
            translateY: 50
        });

        // Animate elements in sequence
        tl.add({
            targets: '#brand-section',
            opacity: [0, 1],
            translateY: [50, 0],
            duration: 1000
        })
        .add({
            targets: '#login-form',
            opacity: [0, 1],
            translateY: [50, 0],
            duration: 1000
        }, '-=500');

        // Form field animations
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            const input = group.querySelector('input');
            
            input.addEventListener('focus', () => {
                anime({
                    targets: input,
                    scale: [1, 1.02],
                    duration: 300,
                    easing: 'easeOutQuad'
                });
            });
            
            input.addEventListener('blur', () => {
                anime({
                    targets: input,
                    scale: [1.02, 1],
                    duration: 300,
                    easing: 'easeOutQuad'
                });
            });
        });

        // Button hover animation
        const loginBtn = document.getElementById('login-btn');
        loginBtn.addEventListener('mouseenter', () => {
            anime({
                targets: loginBtn,
                scale: 1.05,
                duration: 200,
                easing: 'easeOutQuad'
            });
        });

        loginBtn.addEventListener('mouseleave', () => {
            anime({
                targets: loginBtn,
                scale: 1,
                duration: 200,
                easing: 'easeOutQuad'
            });
        });

        // Form submission animation
        loginBtn.addEventListener('click', (e) => {
            anime({
                targets: loginBtn,
                scale: [1, 0.95, 1],
                duration: 300,
                easing: 'easeOutQuad'
            });
        });

        // Error message animation (if present)
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            anime({
                targets: errorMessage,
                opacity: [0, 1],
                translateX: [-20, 0],
                duration: 500,
                easing: 'easeOutQuad',
                delay: 1500
            });
        }

        // Responsive adjustments
        function handleResize() {
            if (window.innerWidth < 640) {
                // Mobile adjustments
                anime.set('#login-form', {
                    padding: '1.5rem'
                });
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Initial call
    </script>
</body>
</html>

