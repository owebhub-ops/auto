<!-- 
  ======================================================================
  PREMIUM NAVIGATION BAR – AutoOWH
  Optimized for: SEO, User Engagement, Accessibility, Performance
  Features: Glassmorphism effect, responsive dropdown, Google OAuth integration,
            semantic HTML, accessible ARIA labels, and subtle micro-interactions.
  ======================================================================
-->

<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-glass" aria-label="Main navigation">
    <div class="container-fluid px-3 px-lg-4">
        <!-- Brand with enhanced focus + internal linking strategy -->
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= base_url() ?>" aria-label="AutoOWH Homepage">
            <i class="bi bi-car-front-fill fs-4"></i>
            <span class="fs-4 tracking-wide">AutoOWH</span>
            <!-- <span class="badge bg-white text-primary ms-2 rounded-pill small px-2 d-none d-md-inline-block">2026</span> -->
        </a>

        <!-- Mobile toggler with aria expanded control -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible menu wrapper -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Primary navigation links (semantic & keyword-rich) -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1 gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3 <?= (current_url() == base_url()) ? 'active' : '' ?>" href="<?= base_url() ?>" aria-current="page">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="<?= base_url('cars') ?>">
                        <i class="bi bi-car-front me-1"></i> All Cars
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fw-semibold px-3 dropdown-toggle" href="#" id="carCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-grid-3x3-gap-fill me-1"></i> Categories
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark border-0 shadow-lg mt-2 rounded-4 py-2" aria-labelledby="carCategoriesDropdown">
                        <li><a class="dropdown-item py-2" href="<?= base_url('cars/suv') ?>"><i class="bi bi-truck me-2"></i>SUVs & Crossovers</a></li>
                        <li><a class="dropdown-item py-2" href="<?= base_url('cars/sedan') ?>"><i class="bi bi-car-front me-2"></i>Sedans</a></li>
                        <li><a class="dropdown-item py-2" href="<?= base_url('cars/electric') ?>"><i class="bi bi-lightning-charge me-2"></i>Electric Vehicles</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2" href="<?= base_url('cars/hybrid') ?>"><i class="bi bi-flower2 me-2"></i>Hybrids</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="<?= base_url('cars/compare') ?>">
                        <i class="bi bi-shuffle me-1"></i> Compare Models
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="<?= base_url('reviews') ?>">
                        <i class="bi bi-star-fill me-1"></i> Expert Reviews
                    </a>
                </li>
            </ul>

            <!-- Right section: Google OAuth & user avatar (dynamic) -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <?php if (session()->get('user_id')): ?>
                    <!-- ✅ LOGGED IN: Avatar dropdown with user info -->
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 p-2 rounded-4 transition-all" 
                           href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" 
                           aria-expanded="false" aria-label="User menu">
                            <!-- Avatar with fallback & lazy loading -->
                            <img id="navbarAvatar"
                                src="<?= esc(session()->get('user_avatar') ?: base_url('public/assets/img/avatar-default.png')) ?>"
                                class="rounded-circle shadow-sm object-fit-cover" width="38" height="38"
                                alt="Profile of <?= esc(session()->get('user_name') ?: 'User') ?>"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='<?= base_url('public/assets/img/avatar-default.png') ?>';">
                            
                            <div class="d-none d-lg-block me-1">
                                <div class="fw-semibold small lh-1 text-white"><?= esc(session()->get('user_name') ?: 'Hi there') ?></div>
                                <div class="text-white-50 small" style="font-size: 0.7rem;"><?= esc(substr(session()->get('user_email') ?? '', 0, 18)) ?></div>
                            </div>
                            <i class="bi bi-chevron-down text-white-50 d-none d-lg-inline-block"></i>
                        </a>

                        <!-- Enhanced dropdown card -->
                        <ul class="dropdown-menu dropdown-menu-end shadow-xxl border-0 mt-3 rounded-4 overflow-hidden" style="min-width: 280px; backdrop-filter: blur(8px); background: rgba(15, 25, 45, 0.95);">
                            <li class="px-4 py-4 border-bottom border-white-10">
                                <div class="d-flex align-items-center gap-3">
                                    <img id="dropdownAvatar"
                                        src="<?= esc(session()->get('user_avatar') ?: base_url('public/assets/img/avatar-default.png')) ?>"
                                        class="rounded-circle shadow-lg border border-2 border-primary" width="58" height="58" 
                                        alt="User avatar"
                                        onerror="this.onerror=null;this.src='<?= base_url('public/assets/img/avatar-default.png') ?>';">
                                    <div>
                                        <h6 class="mb-1 fw-bold text-white"><?= esc(session()->get('user_name') ?: 'Car Enthusiast') ?></h6>
                                        <small class="text-light opacity-75"><?= esc(session()->get('user_email')) ?></small>
                                        <div class="mt-1"><span class="badge bg-primary bg-opacity-25 text-white px-2">Premium Access</span></div>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider my-1 opacity-25"></li>
                            <li><a class="dropdown-item py-3 px-4 fw-semibold text-white" href="<?= base_url('mydashboard') ?>"><i class="bi bi-speedometer2 me-3 text-primary fs-5"></i> Dashboard</a></li>
                            <li><a class="dropdown-item py-3 px-4 fw-semibold text-white" href="<?= base_url('profile') ?>"><i class="bi bi-person-circle me-3 text-success fs-5"></i> My Profile</a></li>
                            <li><a class="dropdown-item py-3 px-4 fw-semibold text-white" href="<?= base_url('favorites') ?>"><i class="bi bi-heart-fill me-3 text-danger fs-5"></i> Saved Cars</a></li>
                            <li><a class="dropdown-item py-3 px-4 fw-semibold" href="<?= base_url('my-comparisons') ?>"><i class="bi bi-layout-three-columns me-3 text-warning fs-5"></i> Comparisons</a></li>
                            <li><hr class="dropdown-divider my-1 opacity-25"></li>
                            <li><a class="dropdown-item py-3 px-4 text-danger fw-bold" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-3 fs-5"></i> Sign Out</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- NOT LOGGED IN: Elegant Google CTA -->
                    <li class="nav-item">
                        <a class="btn btn-google-glass fw-semibold px-4 py-2 rounded-pill d-flex align-items-center gap-2 shadow-sm" 
                           href="<?= base_url('login') ?>" aria-label="Continue with Google">
                            <i class="bi bi-google fs-5"></i> 
                            <span>Sign in</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Premium styling (optimized & non-intrusive) -->
<style>
    /* Glass navbar - elegant & modern */
    .navbar-glass {
        background: rgba(10, 30, 65, 0.92) !important;
        backdrop-filter: blur(16px) saturate(180%);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 0.25s ease-in-out;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }
    
    /* Animated link underline */
    .nav-link {
        position: relative;
        transition: color 0.2s, transform 0.2s;
        font-weight: 500;
        letter-spacing: 0.2px;
    }
    
    .nav-link:hover {
        color: rgba(255, 255, 255, 0.95) !important;
        transform: translateY(-1px);
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 2px;
        left: 50%;
        background: linear-gradient(90deg, #60a5fa, #a78bfa);
        transition: all 0.25s ease;
        transform: translateX(-50%);
        border-radius: 4px;
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 70%;
    }
    
    /* Glass Google Button (modern CTA) */
    .btn-google-glass {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: white !important;
        transition: all 0.25s;
        font-size: 0.9rem;
    }
    
    .btn-google-glass:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        transform: scale(0.98);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    /* Dropdown menu premium treatment */
    .dropdown-menu-dark {
        background: rgba(18, 28, 40, 0.98);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 20px 35px -8px rgba(0,0,0,0.3);
    }
    
    .dropdown-item {
        transition: background 0.2s, padding-left 0.2s;
        font-weight: 500;
    }
    
    .dropdown-item:hover {
        background: rgba(59, 130, 246, 0.25);
        padding-left: 1.8rem !important;
        color: white;
    }
    
    /* Avatar hover effect */
    .user-dropdown .nav-link img {
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.2s;
    }
    
    .user-dropdown .nav-link:hover img {
        border-color: #ffffff;
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    /* Body padding for fixed navbar */
    body {
        padding-top: 78px;
    }
    
    @media (max-width: 992px) {
        body {
            padding-top: 68px;
        }
        .navbar-glass {
            background: rgba(10, 30, 65, 0.96) !important;
        }
        .dropdown-menu {
            background: #0f172a !important;
        }
    }
    
    /* Micro-animation for toggler */
    .navbar-toggler:focus {
        box-shadow: 0 0 0 2px rgba(255,255,255,0.3);
    }
    
    /* Custom utility */
    .tracking-wide {
        letter-spacing: -0.2px;
    }
    .transition-all {
        transition: all 0.2s ease;
    }
    .border-white-10 {
        border-color: rgba(255, 255, 255, 0.1);
    }
</style>

<!-- Optional: add active route detection script (optional enhancement) -->
<script>
    // Set active class on current nav link dynamically (ensures visual feedback)
    document.addEventListener("DOMContentLoaded", function () {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && currentPath === href) {
                link.classList.add('active');
            } else if (href && currentPath.includes(href) && href !== '/' && href !== baseUrl) {
                // subtle for child pages
                if (!link.classList.contains('active') && href !== '/') link.classList.add('active');
            }
        });
    });
</script>