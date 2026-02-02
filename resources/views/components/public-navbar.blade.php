<nav class="kof-navbar">
    <div class="navbar-container">
        <!-- Logo / Brand -->
        <div class="navbar-brand">
            <a href="/" class="brand-link">
                <span class="brand-text">Dr</span>
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
            <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                <span class="nav-text">Home</span>
            </a>


            <a href="{{ route('projects') }}" class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
                <span class="nav-text">Projects</span>
            </a>

            <a href="{{ route('blog.index') }}" class="nav-link {{ Request::is('blog*') ? 'active' : '' }}">
                <span class="nav-text">Blog</span>
            </a>


            <a href="{{ route('comments') }}" class="nav-link {{ Request::is('comments*') ? 'active' : '' }}">
                <span class="nav-text">Comments</span>
            </a>
        </div>
    </div>

    <!-- Decorative Line -->
    <div class="navbar-line"></div>
</nav>