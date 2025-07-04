// Animações de partículas de fundo
function createParticles() {
    const container = document.querySelector('.floating-particles');
    if (!container) return;
    for (let i = 0; i < 18; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        const size = Math.random() * 32 + 16;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.top = `${Math.random() * 100}%`;
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.opacity = Math.random() * 0.5 + 0.2;
        container.appendChild(particle);
        anime({
            targets: particle,
            translateY: [0, Math.random() * 60 - 30],
            translateX: [0, Math.random() * 60 - 30],
            direction: 'alternate',
            duration: 4000 + Math.random() * 4000,
            easing: 'easeInOutSine',
            loop: true,
            delay: Math.random() * 2000
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Partículas de fundo
    createParticles();

    // Animação do logo
    anime({
        targets: '.auth-logo',
        scale: [0.7, 1],
        opacity: [0, 1],
        rotate: [0, 360],
        duration: 1200,
        easing: 'easeOutElastic(1, .8)'
    });

    // Animação dos campos
    anime({
        targets: '.form-group',
        translateY: [40, 0],
        opacity: [0, 1],
        delay: anime.stagger(120, {start: 400}),
        duration: 800,
        easing: 'easeOutExpo'
    });

    // Animação do botão
    anime({
        targets: '.btn-primary',
        scale: [0.9, 1],
        opacity: [0, 1],
        delay: 900,
        duration: 700,
        easing: 'easeOutBack'
    });

    // Mensagens de erro/sucesso
    anime({
        targets: '.message',
        translateY: [-20, 0],
        opacity: [0, 1],
        duration: 700,
        easing: 'easeOutExpo'
    });

    // Alternar visibilidade da senha
    const togglePassword = document.querySelector('.password-toggle');
    if (togglePassword) {
        togglePassword.addEventListener('click', function () {
            const input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
                togglePassword.innerHTML = `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-1.657.336-3.236.938-4.675M15 12a3 3 0 11-6 0 3 3 0 016 0z' /></svg>`;
            } else {
                input.type = 'password';
                togglePassword.innerHTML = `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z' /><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.832-.64 1.624-1.09 2.357' /></svg>`;
            }
        });
    }

    // Shake no erro
    const form = document.querySelector('.auth-form');
    if (form && document.querySelector('.message.error')) {
        anime({
            targets: '.auth-card',
            translateX: [0, -10, 10, -10, 10, 0],
            duration: 600,
            easing: 'easeInOutSine'
        });
    }
}); 