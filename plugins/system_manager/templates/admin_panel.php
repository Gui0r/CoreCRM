<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - CoreCRM</title>
    <link href="/output.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        .card-shadow {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .pulse-dot {
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }
        .slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .professional-text {
            color: #1e293b;
        }
        .professional-text-light {
            color: #64748b;
        }
        .professional-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(226, 232, 240, 0.8);
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
        .professional-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        .professional-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-lg border-b border-gray-200" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold professional-text">CoreCRM</h1>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></div>
                        <span class="text-sm professional-text-light">Online</span>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">
                                <?php echo strtoupper(substr($_SESSION['user_id'] ?? 'U', 0, 1)); ?>
                            </span>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium professional-text">
                                <?php echo htmlspecialchars($_SESSION['user_id'] ?? 'Usuário'); ?>
                            </p>
                            <p class="text-xs professional-text-light">
                                <?php echo htmlspecialchars($_SESSION['user_role'] ?? 'N/A'); ?>
                            </p>
                        </div>
                    </div>

                    <a href="/logout" 
                       class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white professional-danger focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                       id="logout-btn">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="px-4 py-6 sm:px-0" id="welcome-section">
            <div class="professional-card rounded-lg shadow-lg p-6 mb-6 card-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold professional-text mb-2">
                            Bem-vindo de volta, <?php echo htmlspecialchars($_SESSION['user_id'] ?? 'Usuário'); ?>!
                        </h2>
                        <p class="professional-text-light">
                            Você está logado como <span class="font-semibold text-blue-600"><?php echo htmlspecialchars($_SESSION['user_role'] ?? 'N/A'); ?></span>
                        </p>
                        <p class="text-sm professional-text-light mt-1">
                            Último acesso: <?php echo date('d/m/Y H:i'); ?>
                        </p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center floating-animation">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="px-4 sm:px-0" id="dashboard-cards">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Card 1 - Clientes -->
                <div class="professional-card rounded-lg shadow-lg p-6 card-shadow hover:shadow-xl transition-shadow duration-300 dashboard-card">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold professional-text">Clientes</h3>
                            <p class="text-2xl font-bold text-blue-600">1,234</p>
                            <p class="text-sm professional-text-light">+12% este mês</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 - Vendas -->
                <div class="professional-card rounded-lg shadow-lg p-6 card-shadow hover:shadow-xl transition-shadow duration-300 dashboard-card">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold professional-text">Vendas</h3>
                            <p class="text-2xl font-bold text-green-600">R$ 45.2K</p>
                            <p class="text-sm professional-text-light">+8% este mês</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 - Tarefas -->
                <div class="professional-card rounded-lg shadow-lg p-6 card-shadow hover:shadow-xl transition-shadow duration-300 dashboard-card">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold professional-text">Tarefas</h3>
                            <p class="text-2xl font-bold text-purple-600">23</p>
                            <p class="text-sm professional-text-light">5 pendentes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="px-4 sm:px-0" id="quick-actions">
            <div class="professional-card rounded-lg shadow-lg p-6 card-shadow">
                <h3 class="text-lg font-semibold professional-text mb-4">Ações Rápidas</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 action-btn">
                        <svg class="w-8 h-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span class="text-sm font-medium professional-text">Novo Cliente</span>
                    </button>

                    <button class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 action-btn">
                        <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-sm font-medium professional-text">Nova Venda</span>
                    </button>

                    <button class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 action-btn">
                        <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm font-medium professional-text">Relatório</span>
                    </button>

                    <button class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 action-btn">
                        <svg class="w-8 h-8 text-orange-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm font-medium professional-text">Configurações</span>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Animation timeline
        const tl = anime.timeline({
            easing: 'easeOutExpo',
            duration: 600
        });

        // Initial setup - hide elements
        anime.set(['#navbar', '#welcome-section', '#dashboard-cards', '#quick-actions'], {
            opacity: 0,
            translateY: 30
        });

        // Animate elements in sequence
        tl.add({
            targets: '#navbar',
            opacity: [0, 1],
            translateY: [30, 0],
            duration: 800
        })
        .add({
            targets: '#welcome-section',
            opacity: [0, 1],
            translateY: [30, 0],
            duration: 800
        }, '-=400')
        .add({
            targets: '#dashboard-cards .dashboard-card',
            opacity: [0, 1],
            translateY: [30, 0],
            duration: 600,
            delay: anime.stagger(100)
        }, '-=400')
        .add({
            targets: '#quick-actions',
            opacity: [0, 1],
            translateY: [30, 0],
            duration: 800
        }, '-=200');

        // Dashboard card hover animations
        const dashboardCards = document.querySelectorAll('.dashboard-card');
        dashboardCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                anime({
                    targets: card,
                    scale: 1.02,
                    duration: 300,
                    easing: 'easeOutQuad'
                });
            });
            
            card.addEventListener('mouseleave', () => {
                anime({
                    targets: card,
                    scale: 1,
                    duration: 300,
                    easing: 'easeOutQuad'
                });
            });
        });

        // Action button animations
        const actionBtns = document.querySelectorAll('.action-btn');
        actionBtns.forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                anime({
                    targets: btn,
                    scale: 1.05,
                    duration: 200,
                    easing: 'easeOutQuad'
                });
            });
            
            btn.addEventListener('mouseleave', () => {
                anime({
                    targets: btn,
                    scale: 1,
                    duration: 200,
                    easing: 'easeOutQuad'
                });
            });

            btn.addEventListener('click', () => {
                anime({
                    targets: btn,
                    scale: [1, 0.95, 1],
                    duration: 300,
                    easing: 'easeOutQuad'
                });
            });
        });

        // Logout button animation
        const logoutBtn = document.getElementById('logout-btn');
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            anime({
                targets: logoutBtn,
                scale: [1, 0.95, 1],
                duration: 300,
                easing: 'easeOutQuad',
                complete: () => {
                    // Fade out animation before redirect
                    anime({
                        targets: 'body',
                        opacity: [1, 0],
                        duration: 500,
                        easing: 'easeInQuad',
                        complete: () => {
                            window.location.href = '/logout';
                        }
                    });
                }
            });
        });

        // Responsive adjustments
        function handleResize() {
            if (window.innerWidth < 640) {
                // Mobile adjustments
                anime.set('.dashboard-card', {
                    padding: '1rem'
                });
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Initial call

        // Auto-refresh data every 30 seconds (placeholder)
        setInterval(() => {
            // Placeholder for data refresh
            console.log('Refreshing dashboard data...');
        }, 30000);
    </script>
</body>
</html>

