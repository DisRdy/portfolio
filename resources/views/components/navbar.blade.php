<nav class="kof-navbar">
    <div class="navbar-container">
        <!-- Logo / Brand -->
        <div class="navbar-brand">
            <a href="/" class="brand-link">
                <span class="brand-text">Disna Radita</span>
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="navbar-toggle" id="navToggle" aria-label="Toggle Navigation">
            <span class="toggle-line"></span>
            <span class="toggle-line"></span>
            <span class="toggle-line"></span>
        </button>

        <!-- Navigation Links -->
        <div class="navbar-menu" id="navMenu">
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                <span class="nav-text">Home</span>
            </a>

            <a href="/projects" class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
                <span class="nav-text">Projects</span>
            </a>

            <a href="/comments" class="nav-link {{ Request::is('comments*') ? 'active' : '' }}">
                <span class="nav-text">Comments</span>
            </a>
        </div>
    </div>

    <!-- Decorative Line -->
    <div class="navbar-line"></div>
</nav>

<style>
    /* === KOF NAVBAR STYLES === */
    .kof-navbar {
        background: linear-gradient(180deg, rgba(10, 10, 10, 0.98) 0%, rgba(26, 26, 26, 0.95) 100%);
        backdrop-filter: blur(20px);
        border-bottom: 3px solid var(--kof-red);
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 30px rgba(230, 57, 70, 0.3);
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        min-height: 80px;
    }

    /* === BRAND === */
    .navbar-brand {
        position: relative;
        z-index: 1001;
    }

    .brand-link {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .brand-link:hover {
        transform: translateX(5px);
    }

    .brand-icon {
        font-size: 2rem;
        animation: iconPulse 2s ease-in-out infinite;
    }

    @keyframes iconPulse {

        0%,
        100% {
            transform: scale(1);
            filter: drop-shadow(0 0 5px rgba(255, 215, 0, 0.5));
        }

        50% {
            transform: scale(1.1);
            filter: drop-shadow(0 0 15px rgba(255, 215, 0, 0.8));
        }
    }

    .brand-text {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #E63946 0%, #FFD700 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: 2px;
    }

    .brand-subtitle {
        font-family: 'Press Start 2P', cursive;
        font-size: 0.5rem;
        color: var(--kof-gold);
        position: absolute;
        bottom: -8px;
        right: 0;
        letter-spacing: 1px;
    }

    /* === MOBILE TOGGLE === */
    .navbar-toggle {
        display: none;
        flex-direction: column;
        gap: 6px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 8px;
        z-index: 1001;
    }

    .toggle-line {
        width: 30px;
        height: 3px;
        background: var(--kof-gold);
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .navbar-toggle:hover .toggle-line {
        background: var(--kof-red);
    }

    .navbar-toggle.active .toggle-line:nth-child(1) {
        transform: translateY(9px) rotate(45deg);
    }

    .navbar-toggle.active .toggle-line:nth-child(2) {
        opacity: 0;
    }

    .navbar-toggle.active .toggle-line:nth-child(3) {
        transform: translateY(-9px) rotate(-45deg);
    }

    /* === NAVIGATION MENU === */
    .navbar-menu {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: rgba(45, 45, 45, 0.4);
        border: 2px solid transparent;
        border-radius: 8px;
        color: var(--kof-white);
        text-decoration: none;
        font-family: 'Orbitron', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(230, 57, 70, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .nav-link:hover::before {
        left: 100%;
    }

    .nav-link:hover {
        background: rgba(45, 45, 45, 0.8);
        border-color: var(--kof-red);
        color: var(--kof-gold);
        transform: translateY(-2px);
        box-shadow: 0 0 20px rgba(230, 57, 70, 0.4);
    }

    .nav-link.active {
        background: linear-gradient(135deg, #E63946 0%, #FFD700 100%);
        color: var(--kof-black);
        border-color: var(--kof-gold);
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
    }

    .nav-link.active .nav-icon {
        animation: iconBounce 0.6s ease;
    }

    @keyframes iconBounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .nav-icon {
        font-size: 1.2rem;
    }

    .nav-text {
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    /* === SPECIAL LINKS === */
    .nav-link-login {
        background: rgba(30, 144, 255, 0.2);
        border-color: var(--kof-blue);
    }

    .nav-link-login:hover {
        background: var(--kof-blue);
        color: white;
    }

    .nav-link-register {
        background: rgba(255, 215, 0, 0.2);
        border-color: var(--kof-gold);
    }

    .nav-link-register:hover {
        background: var(--kof-gold);
        color: var(--kof-black);
    }

    .nav-link-logout {
        background: rgba(220, 20, 60, 0.2);
        border-color: var(--kof-dark-red);
    }

    .nav-link-logout:hover {
        background: var(--kof-dark-red);
        color: white;
    }

    /* === DECORATIVE LINE === */
    .navbar-line {
        height: 2px;
        background: linear-gradient(90deg,
                transparent 0%,
                var(--kof-red) 20%,
                var(--kof-gold) 50%,
                var(--kof-red) 80%,
                transparent 100%);
        animation: lineShift 3s linear infinite;
        background-size: 200% 100%;
    }

    @keyframes lineShift {
        0% {
            background-position: 0% 0%;
        }

        100% {
            background-position: 200% 0%;
        }
    }

    /* === RESPONSIVE === */
    @media (max-width: 968px) {
        .navbar-toggle {
            display: flex;
        }

        .navbar-menu {
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            background: rgba(10, 10, 10, 0.98);
            backdrop-filter: blur(20px);
            border-top: 2px solid var(--kof-red);
            flex-direction: column;
            gap: 0;
            padding: 20px;
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .navbar-menu.active {
            max-height: 600px;
            opacity: 1;
        }

        .nav-link {
            width: 100%;
            justify-content: center;
            padding: 16px;
            margin-bottom: 8px;
        }
    }

    @media (max-width: 480px) {
        .navbar-container {
            min-height: 70px;
            padding: 0 16px;
        }

        .brand-text {
            font-size: 1.2rem;
        }

        .brand-subtitle {
            font-size: 0.4rem;
        }

        .nav-text {
            font-size: 0.85rem;
        }
    }
</style>
