<?php
$userName = session()->get('name');
$userEmail = session()->get('email');
?>

<div class="flex-shrink-0 p-3 bg-white sidebar-wrap">
    <div class="mb-3 p-3 rounded bg-light border">
        <div class="fw-bold text-dark"><?= esc($userName ?? 'Admin') ?></div>
        <div class="text-muted small"><?= esc($userEmail ?? 'admin@example.com') ?></div>
    </div>

    <ul class="list-unstyled ps-0 mb-0">
        <li class="mb-2">
            <a href="<?= site_url('admin/dashboard') ?>"
                class="btn btn-toggle align-items-center rounded w-100 text-start">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="mb-2">
            <a href="<?= site_url('admin/contact') ?>"
                class="btn btn-toggle align-items-center rounded w-100 text-start">
                <i class="bi bi-envelope me-2"></i> Contact
            </a>
        </li>

        

        <!-- Vehicles & Pricing -->
        <li class="mb-2">
            <button class="btn btn-toggle align-items-center rounded collapsed w-100 text-start"
                data-bs-toggle="collapse" data-bs-target="#vehicle-collapse" aria-expanded="false"
                aria-controls="vehicle-collapse">
                <i class="bi bi-car-front me-2"></i> Vehicles & Pricing
            </button>
            <div class="collapse" id="vehicle-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3 mt-2">
                    <li>
                        <a href="<?= site_url('admin/vehicle') ?>" class="link-dark rounded d-block py-1">
                            <i class="bi bi-car-front-fill me-2"></i> Vehicles
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('admin/vehicle/pricing') ?>" class="link-dark rounded d-block py-1">
                            <i class="bi bi-cash-stack me-2"></i> Pricing
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Account -->
        <li class="mb-2">
            <button class="btn btn-toggle align-items-center rounded collapsed w-100 text-start"
                data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false"
                aria-controls="account-collapse">
                <i class="bi bi-person-circle me-2"></i> Account
            </button>
            <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3 mt-2">
                    <li>
                        <a href="<?= site_url('admin/profile') ?>" class="link-dark rounded d-block py-1">
                            <i class="bi bi-person me-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('admin/settings') ?>" class="link-dark rounded d-block py-1">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>
                    <li class="py-1">
                        <form action="<?= site_url('admin/logout') ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<style>
    .sidebar-wrap {
        min-height: 100vh;
    }

    .btn-toggle {
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        color: #333;
        background-color: transparent;
        border: 0;
        padding: .5rem .75rem;
        text-decoration: none;
    }

    .btn-toggle:hover,
    .btn-toggle:focus {
        background-color: #f8f9fa;
    }

    .btn-toggle-nav a {
        padding: .25rem .75rem;
        text-decoration: none;
    }
</style>
