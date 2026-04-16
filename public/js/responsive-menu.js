/**
 * Responsive Menu - Menu Hamburguer para Digital Signage
 * Controla o menu hambúrguer e responsividade
 */

document.addEventListener('DOMContentLoaded', function() {
    // Criar botão hambúrguer se não existir
    if (!document.getElementById('hamburger-btn')) {
        createHamburgerButton();
    }
    
    // Criar overlay se não existir
    if (!document.getElementById('menu-overlay')) {
        createMenuOverlay();
    }
    
    // Inicializar menu
    initResponsiveMenu();
});

function createHamburgerButton() {
    const hamburgerBtn = document.createElement('button');
    hamburgerBtn.id = 'hamburger-btn';
    hamburgerBtn.className = 'hamburger-btn';
    hamburgerBtn.setAttribute('aria-label', 'Abrir menu');
    hamburgerBtn.setAttribute('aria-expanded', 'false');
    hamburgerBtn.setAttribute('aria-controls', 'main-menu');
    hamburgerBtn.setAttribute('aria-controls', 'main-menu');
    
    // Criar ícone de hambúrguer (3 linhas)
    for (let i = 0; i < 3; i++) {
        const line = document.createElement('span');
        hamburgerBtn.appendChild(line);
    }
    
    // Adicionar ao início do body
    document.body.appendChild(hamburgerBtn);
    
    return hamburgerBtn;
}

function createMenuOverlay() {
    const overlay = document.createElement('div');
    overlay.id = 'menu-overlay';
    overlay.className = 'menu-overlay';
    overlay.setAttribute('aria-hidden', 'true');
    overlay.setAttribute('role', 'presentation');
    document.body.appendChild(overlay);
    return overlay;
}

function initResponsiveMenu() {
    const hamburgerBtn = document.getElementById('hamburger-btn') || createHamburgerButton();
    const menuOverlay = document.getElementById('menu-overlay') || createMenuOverlay();
    const leftPanel = document.querySelector('.left-painel');
    const mainContent = document.querySelector('main');
    
    if (!hamburgerBtn || !leftPanel) return;
    
    // Estado do menu
    let isMenuOpen = false;
    
    // Função para abrir/fechar menu
    function toggleMenu() {
        isMenuOpen = !isMenuOpen;
        
        if (isMenuOpen) {
            // Abrir menu
            leftPanel.classList.add('open');
            menuOverlay.classList.add('active');
            hamburgerBtn.setAttribute('aria-expanded', 'true');
            hamburgerBtn.setAttribute('aria-label', 'Fechar menu');
            document.body.style.overflow = 'hidden'; // Previne scroll do body
        } else {
            // Fechar menu
            leftPanel.classList.remove('open');
            menuOverlay.classList.remove('active');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
            hamburgerBtn.setAttribute('aria-label', 'Abrir menu');
            document.body.style.overflow = '';
        }
    }
    
    // Evento de clique no botão hambúrguer
    hamburgerBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleMenu();
    });
    
    // Fechar menu ao clicar no overlay
    menuOverlay.addEventListener('click', function() {
        if (isMenuOpen) {
            toggleMenu();
        }
    });
    
    // Fechar menu ao clicar em um link
    const menuLinks = leftPanel.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 1024) {
                toggleMenu();
            }
        });
    });
    
    // Fechar menu com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            toggleMenu();
        }
    });
    
    // Fechar menu ao redimensionar para desktop
    function handleResize() {
        if (window.innerWidth >= 1024) {
            // Em telas grandes, garantir que o menu esteja visível
            leftPanel.classList.remove('open');
            menuOverlay.classList.remove('active');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
            hamburgerBtn.setAttribute('aria-label', 'Abrir menu');
            isMenuOpen = false;
            document.body.style.overflow = '';
        }
    }
    
    window.addEventListener('resize', handleResize);
    
    // Fechar menu ao pressionar ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            toggleMenu();
        }
    });
    
    // Fechar menu ao clicar fora (apenas em mobile)
    document.addEventListener('click', function(e) {
        if (isMenuOpen && 
            !leftPanel.contains(e.target) && 
            e.target !== hamburgerBtn && 
            !hamburgerBtn.contains(e.target)) {
            toggleMenu();
        }
    });
}

// Inicializar quando o DOM estiver pronto
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initResponsiveMenu);
} else {
    initResponsiveMenu();
}

// Adicionar estilos inline para o menu responsivo
const menuStyles = `
/* Estilos do menu responsivo */
.hamburger-btn {
    display: none;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1001;
    background: var(--primario);
    border: none;
    border-radius: 4px;
    width: 44px;
    height: 44px;
    cursor: pointer;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    padding: 10px;
    z-index: 1002;
}

.hamburger-btn span {
    display: block;
    width: 25px;
    height: 3px;
    background: white;
    margin: 4px 0;
    transition: 0.3s;
    border-radius: 2px;
}

.hamburger-btn[aria-expanded="true"] span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.hamburger-btn[aria-expanded="true"] span:nth-child(2) {
    opacity: 0;
}

.hamburger-btn[aria-expanded="true"] span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -6px);
}

.menu-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 999;
    opacity: 0;
    transition: opacity 0.3s;
}

.menu-overlay.active {
    display: block;
    opacity: 1;
}

/* Ajustes para mobile */
@media (max-width: 1023px) {
    .hamburger-btn {
        display: flex;
    }
    
    .left-painel {
        position: fixed;
        top: 0;
        left: -280px;
        height: 100vh;
        width: 280px;
        z-index: 1000;
        transition: transform 0.3s ease;
    }
    
    .left-painel.open {
        transform: translateX(280px);
    }
}

@media (min-width: 1024px) {
    .hamburger-btn {
        display: none;
    }
}

/* Acessibilidade */
.hamburger-btn:focus {
    outline: 2px solid var(--primario);
    outline-offset: 2px;
}

/* Animações suaves */
.left-painel, .menu-overlay {
    transition: all 0.3s ease;
}

/* Ajustes para acessibilidade */
@media (prefers-reduced-motion: reduce) {
    .left-painel,
    .menu-overlay {
        transition: none;
    }
}

/* Suporte a toque em dispositivos móveis */
@media (hover: none) and (pointer: coarse) {
    .hamburger-btn {
        min-height: 44px;
        min-width: 44px;
    }
}

/* Ajustes para alto contraste */
@media (prefers-contrast: high) {
    .hamburger-btn {
        border: 2px solid currentColor;
    }
}

/* Suporte a modo escuro */
@media (prefers-color-scheme: dark) {
    .hamburger-btn {
        background: #333;
    }
    
    .hamburger-btn span {
        background: white;
    }
}

/* Impressão */
@media print {
    .hamburger-btn,
    .menu-overlay {
        display: none !important;
    }
}
`;

// Adicionar estilos ao documento
const styleSheet = document.createElement('style');
styleSheet.textContent = menuStyles;
document.head.appendChild(styleSheet);