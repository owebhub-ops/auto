<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
            <i class="bi bi-mortarboard-fill me-2"></i> LearnOWH
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="<?= base_url() ?>">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="<?= base_url('courses') ?>">
                        <i class="bi bi-journal-bookmark me-1"></i> Courses
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link fw-semibold" href="<?= base_url('quizzes') ?>">
                        <i class="bi bi-question-circle me-1"></i> Quizzes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="<?= base_url('about') ?>">
                        <i class="bi bi-info-circle me-1"></i> About
                    </a>
                </li> -->
            </ul>

            <!-- Right Menu - Google OAuth User Avatar -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (session()->get('user_id')): ?>
                    <!-- ✅ LOGGED IN - Google User Avatar Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold p-2" 
                           href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- ✅ Google User Avatar (picture from Google profile) -->
                            <img id="navbarAvatar" 
                                 src="<?= esc(session()->get('user_avatar') ?: base_url('public/assets/img/avatar-default.png')) ?>" 
                                 class="rounded-circle me-2 shadow-sm" 
                                 width="36" height="36" 
                                 alt="<?= esc(session()->get('user_name') ?: 'Profile') ?>"
                                 onerror="this.onerror=null;this.src='<?= base_url('public/assets/img/avatar-default.png') ?>';">
                            
                            <!-- User Info -->
                            <div class="d-none d-lg-block me-2 text-truncate" style="max-width: 150px;">
                                <div class="fw-bold small"><?= esc(session()->get('user_name') ?: 'User') ?></div>
                                <div class="text-muted small text-truncate"><?= esc(substr(session()->get('user_email') ?? '', 0, 20)) . (strlen(session()->get('user_email') ?? '') > 20 ? '...' : '') ?></div>
                            </div>
                            
                            <!-- Mobile Chevron -->
                            <i class="bi bi-chevron-down ms-auto d-lg-none"></i>
                        </a>
                        
                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="min-width: 280px;">
                            <!-- User Profile Card with Google Avatar -->
                            <li class="px-4 py-3 border-bottom bg-light">
                                <div class="d-flex align-items-center">
                                    <img id="dropdownAvatar" 
                                         src="<?= esc(session()->get('user_avatar') ?: base_url('public/assets/img/avatar-default.png')) ?>" 
                                         class="rounded-circle shadow-lg" 
                                         width="56" height="56" 
                                         alt="Profile Photo" 
                                         onerror="this.onerror=null;this.src='<?= base_url('public/assets/img/avatar-default.png') ?>';">
                                    <div class="ms-3">
                                        <h6 class="mb-1 fw-bold"><?= esc(session()->get('user_name') ?: 'Google User') ?></h6>
                                        <small class="text-muted"><?= esc(session()->get('user_email')) ?></small>
                                    </div>
                                </div>
                            </li>
                            
                            <li><hr class="dropdown-divider mx-3 my-0"></li>
                            
                            <!-- Navigation Links -->
                            <li>
                                <a class="dropdown-item py-2 px-4 fw-semibold" href="<?= base_url('dashboard') ?>">
                                    <i class="bi bi-speedometer2 me-3 text-primary fs-5"></i>Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-4 fw-semibold" href="<?= base_url('profile') ?>">
                                    <i class="bi bi-person-circle me-3 text-success fs-5"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-4 fw-semibold" href="<?= base_url('courses/my-courses') ?>">
                                    <i class="bi bi-bookmark-heart me-3 text-warning fs-5"></i>My Courses
                                </a>
                            </li>
                           
                            <li><hr class="dropdown-divider mx-3 my-0"></li>
                            <li>
                                <a class="dropdown-item py-3 px-4 text-danger fw-semibold border-top" href="<?= base_url('logout') ?>">
                                    <i class="bi bi-box-arrow-right me-3 fs-5"></i>Sign Out
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php else: ?>
                    <!-- Not Logged In -->
                
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>