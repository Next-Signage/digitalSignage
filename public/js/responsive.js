/**
 * Responsive Menu and Mobile Navigation
 * Digital Signage - Responsive Navigation
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const hamburger = document.getElementById('hamburger');
    const leftPanel = document.querySelector('.left-painel');
    const menuOverlay = document.getElementById('menuOverlay');
    const closeMenuBtn = document.getElementById('closeMenu');
    const menuLinks = document.querySelectorAll('.left-painel a');
    
    // Criar elementos do menu hambúrguer se não existirem
    if (!document.getElementById('hamburger')) {
        createHamburgerMenu();
    }
    
    // Criar overlay se não existir
    if (!menuOverlay) {
        createMenuOverlay();
    }
    
    // Função para abrir/fechar menu
    function toggleMenu() {
        const leftPanel = document.querySelector('.left-painel');
        const overlay = document.getElementById('menuOverlay');
        
        if (leftPanel && overlay) {
            leftPanel.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.classList.toggle('menu-open');
            
            // Impedir scroll do body quando menu estiver aberto
            if (leftPanel.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
    }
    
    // Fechar menu ao clicar em um link
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            const leftPanel = document.querySelector('.left-painel');
            const overlay = document.getElementById('menuOverlay');
            
            if (window.innerWidth < 1024) {
                leftPanel.classList.remove('open');
                overlay.classList.remove('active');
                document.body.classList.remove('menu-open');
                document.body.style.overflow = '';
            }
        });
    });
    
    // Fechar menu ao clicar no overlay
    if (menuOverlay) {
        menuOverlay.addEventListener('click', function() {
            const leftPanel = document.querySelector('.left-painel');
            if (leftPanel) {
                leftPanel.classList.remove('open');
                menuOverlay.classList.remove('active');
                document.body.classList.remove('menu-open');
                document.body.style.overflow = '';
            }
        });
    }
    
    // Fechar menu ao redimensionar para desktop
    function handleResize() {
        const leftPanel = document.querySelector('.left-painel');
        const overlay = document.getElementById('menuOverlay');
        
        if (window.innerWidth >= 1024) {
            // Em telas grandes, garantir que o menu esteja visível
            if (leftPanel) {
                leftPanel.classList.remove('open');
            }
            if (overlay) {
                overlay.classList.remove('active');
            }
            document.body.classList.remove('menu-open');
            document.body.style.overflow = '';
        }
    }
    
    // Ajustar menu em redimensionamento
    window.addEventListener('resize', handleResize);
    
    // Fechar menu ao pressionar ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const leftPanel = document.querySelector('.left-painel');
            const overlay = document.getElementById('menuOverlay');
            
            if (leftPanel && leftPanel.classList.contains('open')) {
                leftPanel.classList.remove('open');
                if (overlay) overlay.classList.remove('active');
                document.body.classList.remove('menu-open');
                document.body.style.overflow = '';
            }
        }
    });
    
    // Fechar menu ao clicar fora (para mobile)
    document.addEventListener('click', function(event) {
        const leftPanel = document.querySelector('.left-painel');
        const hamburger = document.getElementById('hamburger');
        const overlay = document.getElementById('menuOverlay');
        
        if (window.innerWidth < 1024 && 
            leftPanel && 
            leftPanel.classList.contains('open') && 
            !event.target.closest('.left-painel') && 
            !event.target.closest('#hamburger') &&
            event.target !== hamburger) {
            
            leftPanel.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.classList.remove('menu-open');
            document.body.style.overflow = '';
        }
    });
    
    // Ajustar tabelas para mobile
    function adjustTablesForMobile() {
        const tables = document.querySelectorAll('table');
        tables.forEach(table => {
            if (window.innerWidth < 768) {
                table.parentElement.classList.add('table-responsive');
            } else {
                table.parentElement.classList.remove('table-responsive');
            }
        });
    }
    
    // Ajustar formulários para mobile
    function adjustFormsForMobile() {
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (window.innerWidth < 768) {
                input.setAttribute('size', '30'); // Tamanho menor para mobile
            }
        });
    }
    
    // Ajustar imagens responsivas
    function makeImagesResponsive() {
        const images = document.querySelectorAll('img:not([data-responsive="false"])');
        images.forEach(img => {
            if (!img.classList.contains('responsive-img')) {
                img.classList.add('responsive-img');
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
            }
        });
    }
    
    // Inicializar
    adjustTablesForMobile();
    makeImagesResponsive();
    adjustFormsForMobile();
    
    // Reajustar ao redimensionar
    window.addEventListener('resize', function() {
        adjustTablesForMobile();
        makeImagesResponsive();
        adjustFormsForMobile();
    });
    
    // Ajustar altura de textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
});

// Função para criar o botão hambúrguer
function createHamburgerMenu() {
    const hamburger = document.createElement('button');
    hamburger.id = 'hamburger';
    hamburger.className = 'hamburger';
    hamburger.setAttribute('aria-label', 'Abrir menu');
    hamburger.setAttribute('aria-expanded', 'false');
    hamburger.setAttribute('aria-controls', 'main-menu');
    hamburger.innerHTML = `
        <span></span>
        <span></span>
        <span></span>
    `;
    
    // Adicionar ao início do body
    document.body.insertBefore(hamburger, document.body.firstChild);
    
    // Adicionar evento de clique
    hamburger.addEventListener('click', function() {
        const leftPanel = document.querySelector('.left-painel');
        const overlay = document.getElementById('menuOverlay');
        
        if (leftPanel) {
            const isOpen = leftPanel.classList.contains('open');
            leftPanel.classList.toggle('open');
            hamburger.setAttribute('aria-expanded', !isOpen);
            
            if (overlay) {
                overlay.classList.toggle('active');
            }
            
            // Bloquear scroll quando menu está aberto
            if (window.innerWidth < 1024) {
                if (leftPanel.classList.contains('open')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            }
        }
    });
    
    return hamburger;
}

// Criar overlay do menu
function createMenuOverlay() {
    const overlay = document.createElement('div');
    overlay.id = 'menuOverlay';
    overlay.className = 'menu-overlay';
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 999;
        display: none;
    `;
    
    document.body.appendChild(overlay);
    return overlay;
}

// Inicializar quando o DOM estiver pronto
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initResponsiveMenu);
} else {
    initResponsiveMenu();
}

function initResponsiveMenu() {
    // Criar elementos do menu hambúrguer se não existirem
    if (!document.getElementById('hamburger')) {
        createHamburgerMenu();
    }
    
    // Criar overlay se não existir
    if (!document.getElementById('menuOverlay')) {
        createMenuOverlay();
    }
    
    // Ajustar menu baseado no tamanho da tela
    function handleResize() {
        const leftPanel = document.querySelector('.left-painel');
        const overlay = document.getElementById('menuOverlay');
        const hamburger = document.getElementById('hamburger');
        
        if (window.innerWidth >= 1024) {
            // Desktop: menu sempre visível
            if (leftPanel) {
                leftPanel.classList.remove('open');
                leftPanel.style.transform = 'none';
            }
            if (overlay) overlay.style.display = 'none';
            if (hamburger) hamburger.style.display = 'none';
        } else {
            // Mobile/Tablet: menu oculto por padrão
            if (hamburger) hamburger.style.display = 'block';
        }
    }
    
    // Inicializar
    handleResize();
    window.addEventListener('resize', handleResize);
}

// Adicionar estilos inline para o overlay
const overlayStyles = document.createElement('style');
overlayStyles.textContent = `
    .menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 998;
        display: none;
    }
    
    .menu-overlay.active {
        display: block;
    }
    
    .hamburger {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1001;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 10px;
        display: none;
    }
    
    .hamburger span {
        display: block;
        width: 25px;
        height: 3px;
        background: #333;
        margin: 5px 0;
        transition: 0.3s;
    }
    
    @media (max-width: 1023px) {
        .hamburger {
            display: block;
        }
    }
`;

document.head.appendChild(overlayStyles);