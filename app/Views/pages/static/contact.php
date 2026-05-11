<style>
    
/* ==========================================================================
   🎨 POLICY PAGE - ENHANCED PROFESSIONAL STYLES
   ========================================================================== */

/* 1. Hero Section - Premium Gradient */
.policy-hero, .terms-hero {
    height: 340px;
    background: linear-gradient(135deg, 
        #1e3a8a 0%, 
        #3b82f6 25%, 
        #1d4ed8 50%, 
        #1e40af 100%);
    border: 1px solid rgba(255,255,255,0.12);
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.policy-hero:hover {
    box-shadow: 0 30px 80px rgba(30, 58, 138, 0.4);
    transform: translateY(-4px);
}

/* Hero Background Pattern */
.hero-bg-clean {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(ellipse 70% 40% at 15% 25%, rgba(255,255,255,0.12) 0%, transparent 50%),
        radial-gradient(ellipse 50% 25% at 85% 75%, rgba(59,130,246,0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 10%, rgba(255,255,255,0.08) 0%, transparent 40%);
    z-index: 1;
    animation: heroPulse 8s ease-in-out infinite;
}

/* Icon Container */
.policy-icon-large {
    backdrop-filter: blur(20px);
    transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    position: relative;
    overflow: hidden;
}

.policy-icon-large::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: conic-gradient(transparent, rgba(255,255,255,0.1), transparent 30%);
    animation: iconShimmer 3s linear infinite;
    opacity: 0;
    transition: opacity 0.3s;
}

.policy-icon-large:hover::before {
    opacity: 1;
}

.policy-icon-large:hover {
    transform: scale(1.08) rotate(5deg);
    box-shadow: 0 25px 60px rgba(0,0,0,0.3);
}

/* Layout Heights */
.min-vh-60 { min-height: 340px; }

/* Stat Cards - Enhanced Glassmorphism */
.glass-effect {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
    position: relative;
    overflow: hidden;
}

.glass-effect::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255,255,255,0.3), 
        transparent);
    transition: left 0.7s;
}

.glass-effect:hover::before {
    left: 100%;
}

.glass-effect:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.18);
    background: rgba(255, 255, 255, 0.97);
    border-color: rgba(255, 255, 255, 0.5);
}

/* Stat Icons */
.stat-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    border-radius: 50%;
    backdrop-filter: blur(10px);
    transition: all 0.4s ease;
}

.glass-effect:hover .stat-icon {
    transform: scale(1.1) rotate(360deg);
    background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
}

/* Rights Cards Enhancement */
.text-center.p-4.border.rounded-3 {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid rgba(0,0,0,0.05) !important;
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    position: relative;
}

.text-center.p-4.border.rounded-3:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    border-color: rgba(13,110,253,0.2) !important;
}

/* Contact Card */
.card.shadow-lg.rounded-4 {
    transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
}

.card.shadow-lg.rounded-4:hover {
    transform: translateY(-10px);
    box-shadow: 0 40px 100px rgba(0,0,0,0.2) !important;
}

/* Lift Hover Buttons */
.lift-hover {
    transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    position: relative;
    overflow: hidden;
}

.lift-hover::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s;
}

.lift-hover:hover::before {
    left: 100%;
}

.lift-hover:hover {
    transform: translateY(-6px) scale(1.05);
    box-shadow: 0 25px 50px rgba(13,110,253,0.4) !important;
}

/* Footer Gradient */
.bg-gradient-light {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

/* Typography Enhancements */
.h1-lg { font-size: clamp(2.5rem, 5vw, 3.5rem) !important; }
.text-shadow-soft { text-shadow: 0 2px 8px rgba(0,0,0,0.1); }

/* Animations */
@keyframes heroPulse {
    0%, 100% { opacity: 0.9; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.02); }
}

@keyframes iconShimmer {
    0% { transform: rotate(0deg) translateX(-100%); }
    100% { transform: rotate(360deg) translateX(100%); }
}

/* ==========================================================================
   📱 RESPONSIVE PERFECTION
   ========================================================================== */
@media (max-width: 992px) {
    .policy-hero, .terms-hero {
        height: 300px;
        text-align: center !important;
    }
    
    .policy-icon-large {
        width: 120px !important;
        height: 120px !important;
    }
    
    .min-vh-60 { min-height: 300px; }
    .hero-content-clean { padding-top: 2rem !important; }
}

@media (max-width: 768px) {
    .policy-hero, .terms-hero {
        height: 280px;
        border-radius: 2rem;
    }
    
    .policy-icon-large {
        width: 110px !important;
        height: 110px !important;
    }
    
    .min-vh-60 { min-height: 280px; }
    
    h1 { font-size: 2rem !important; }
    .stat-primary { max-width: 100% !important; }
    
    .container-fluid { padding-left: 1rem !important; padding-right: 1rem !important; }
}

@media (max-width: 576px) {
    .policy-hero, .terms-hero {
        height: 260px;
        margin-bottom: 2rem;
    }
    
    .policy-icon-large {
        width: 100px !important;
        height: 100px !important;
    }
    
    .min-vh-60 { min-height: 260px; }
    
    .glass-effect { padding: 2.5rem 1.5rem !important; }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .glass-effect {
        background: rgba(31, 41, 55, 0.95);
        border-color: rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.95);
    }
    
    .glass-effect .text-dark { color: rgba(255,255,255,0.9) !important; }
}
/* ==========================================================================
   🎨 POLICY HERO - COMPLETE PROFESSIONAL STYLES
   ========================================================================== */

   .policy-hero {
    /* Core Layout */
    height: 340px;
    position: relative;
    overflow: hidden;
    border-radius: 1.5rem;
    margin-bottom: 3rem;
    
    /* Premium Background */
    background: linear-gradient(145deg,
        #1e3a8a 0%,      /* Deep professional blue */
        #3b82f6 30%,     /* Bright accent blue */
        #1d4ed8 60%,     /* Core brand blue */
        #1e40af 100%);   /* Dark blue finish */
    
    /* Glass Border */
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 
        0 20px 60px rgba(30, 58, 138, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.08);
    
    /* Smooth Transitions */
    transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
}

/* Hover Enhancement */
.policy-hero:hover {
    transform: translateY(-8px);
    box-shadow: 
        0 40px 120px rgba(30, 58, 138, 0.5),
        0 0 0 1px rgba(255, 255, 255, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

/* Animated Background Layers */
.policy-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        /* Floating particles */
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.12) 0%, transparent 40%),
        radial-gradient(circle at 80% 80%, rgba(59,130,246,0.15) 0%, transparent 40%),
        radial-gradient(ellipse at 50% 10%, rgba(255,255,255,0.08) 0%, transparent 30%),
        /* Subtle grid pattern */
        linear-gradient(90deg, transparent 49%, rgba(255,255,255,0.03) 50%, transparent 51%),
        linear-gradient(rgba(255,255,255,0.02) 0%, transparent 1%);
    z-index: 1;
    animation: heroFlow 15s ease-in-out infinite;
}

.policy-hero::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 15% 85%, rgba(120,119,198,0.1) 0%, transparent 50%),
        radial-gradient(circle at 85% 15%, rgba(16,185,129,0.08) 0%, transparent 50%);
    z-index: 2;
    opacity: 0.7;
}

/* Container Enhancements */
.policy-hero .container-fluid {
    position: relative;
    z-index: 4;
}

.policy-hero .min-vh-60 {
    min-height: 340px;
    display: flex;
    align-items: center;
}

/* Icon Container */
.policy-hero .policy-icon-large {
    width: 140px;
    height: 140px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(25px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
    position: relative;
    overflow: hidden;
}

/* Icon Shimmer Effect */
.policy-hero .policy-icon-large::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: conic-gradient(
        from 0deg,
        transparent 0deg,
        rgba(255,255,255,0.4) 90deg,
        rgba(255,255,255,0.2) 180deg,
        transparent 270deg
    );
    border-radius: inherit;
    animation: shimmerRotate 4s linear infinite;
    z-index: -1;
    mask: radial-gradient(circle 50%, transparent 30%, black 70%);
    mask-repeat: no-repeat;
    mask-position: center;
}

/* Icon Hover */
.policy-hero .policy-icon-large:hover {
    transform: scale(1.12) rotate(8deg);
    box-shadow: 
        0 30px 80px rgba(0,0,0,0.4),
        0 0 40px rgba(59,130,246,0.3);
    border-color: rgba(255, 255, 255, 0.6);
}

/* Avatar Status Enhancement */
.policy-hero .avatar-status {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 24px;
    height: 24px;
    background: linear-gradient(135deg, #10b981, #059669);
    border: 4px solid rgba(255,255,255,0.9);
    border-radius: 50%;
    box-shadow: 
        0 4px 16px rgba(16,185,129,0.4),
        0 0 0 4px rgba(16,185,129,0.2);
    animation: statusPulse 2s infinite ease-in-out;
}

/* Hero Content Typography */
.policy-hero .hero-content-clean {
    position: relative;
    z-index: 5;
}

.policy-hero h1 {
    background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #e0f2fe 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 4px 16px rgba(0,0,0,0.3);
    font-weight: 800;
}

/* Stat Primary Card */
.policy-hero .stat-primary {
    max-width: 380px;
    backdrop-filter: blur(20px);
}

.policy-hero .stat-primary > div {
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
}

.policy-hero .stat-primary:hover > div {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* Keyframe Animations */
@keyframes heroFlow {
    0%, 100% { 
        opacity: 0.85; 
        transform: scale(1) rotate(0deg); 
    }
    33% { 
        opacity: 1; 
        transform: scale(1.02) rotate(0.5deg); 
    }
    66% { 
        opacity: 0.9; 
        transform: scale(1.01) rotate(-0.3deg); 
    }
}

@keyframes shimmerRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes statusPulse {
    0%, 100% { 
        box-shadow: 0 0 0 0px rgba(16,185,129,0.7),
                    0 4px 16px rgba(16,185,129,0.4); 
    }
    50% { 
        box-shadow: 0 0 0 12px rgba(16,185,129,0),
                    0 4px 16px rgba(16,185,129,0.4); 
    }
}

/* ==========================================================================
   📱 PERFECT RESPONSIVE BREAKPOINTS
   ========================================================================== */

/* Large Desktop */
@media (min-width: 1400px) {
    .policy-hero { height: 360px; }
    .policy-hero .min-vh-60 { min-height: 360px; }
}

/* Desktop */
@media (max-width: 1199px) {
    .policy-hero { height: 320px; }
    .policy-hero .min-vh-60 { min-height: 320px; }
    .policy-icon-large { width: 130px !important; height: 130px !important; }
}

/* Tablet */
@media (max-width: 992px) {
    .policy-hero { 
        height: 300px; 
        text-align: center !important; 
        border-radius: 2rem; 
    }
    .policy-hero .min-vh-60 { min-height: 300px; }
    .policy-icon-large { width: 120px !important; height: 120px !important; }
    .hero-content-clean { padding-top: 1.5rem !important; padding-bottom: 1rem !important; }
}

/* Mobile Large */
@media (max-width: 768px) {
    .policy-hero { 
        height: 280px; 
        margin-bottom: 2.5rem; 
    }
    .policy-hero .min-vh-60 { min-height: 280px; }
    .policy-icon-large { width: 110px !important; height: 110px !important; }
    .policy-hero h1 { font-size: 2.25rem !important; }
}

/* Mobile Small */
@media (max-width: 576px) {
    .policy-hero { 
        height: 260px; 
        border-radius: 1.75rem; 
    }
    .policy-hero .min-vh-60 { min-height: 260px; }
    .policy-icon-large { width: 100px !important; height: 100px !important; }
    .policy-hero h1 { font-size: 2rem !important; }
    .stat-primary { max-width: 100% !important; }
}

/* Extra Small */
@media (max-width: 400px) {
    .policy-hero { height: 240px; }
    .policy-hero .min-vh-60 { min-height: 240px; }
    .policy-icon-large { width: 90px !important; height: 90px !important; }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .policy-hero {
        border-color: rgba(255,255,255,0.2);
    }
    
    .policy-hero .policy-icon-large {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.2);
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .policy-hero * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
<?php
// ✅ SAFE ACCESS - Static page variables
$current_year = date('Y');
$last_updated = date('F d, Y');
?>
<div class="container py-5 py-lg-7">
    <div class="row justify-content-center">
        <div class="col-xxl-8 col-xl-9 col-lg-10">
            <!-- Success Message Flash Alert -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mb-4 rounded-4 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong class="fw-bold">Message Sent Successfully!</strong>
                            <p class="mb-0 mt-1"><?= session()->getFlashdata('success') ?></p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Hero Contact Section -->
            <div class="contact-hero policy-hero position-relative rounded-4 shadow-xl mb-5 overflow-hidden">
                <div class="hero-bg-clean"></div>
                
                <div class="container-fluid px-4 px-lg-0">
                    <div class="row align-items-center min-vh-60">
                        <div class="col-lg-4 col-md-5 text-center text-md-start">
                            <div class="avatar-wrapper position-relative mx-auto mx-md-0 mb-4 mb-md-0">
                                <div class="policy-icon-large rounded-4 shadow-lg" style="width: 140px; height: 140px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-envelope-heart-fill display-4 text-white"></i>
                                </div>
                                <div class="avatar-status bg-success"></div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8 col-md-7 ps-lg-5">
                            <div class="hero-content-clean ps-lg-4">
                                <h1 class="h2 h1-lg fw-bold mb-3 text-white lh-sm">Contact Support</h1>
                                
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-clock text-white-75 fs-5 me-3"></i>
                                    <span class="text-white-90 fs-6 fw-medium">Response within 24 hours</span>
                                </div>
                                
                                <div class="stat-primary position-relative">
                                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-3 p-3 px-lg-4">
                                        <div class="row align-items-center g-3">
                                            <div class="col-auto">
                                                <i class="bi bi-headset text-success fs-3"></i>
                                            </div>
                                            <div class="col">
                                                <div class="h4 fw-bold text-white mb-1">7 Days/Week</div>
                                                <small class="text-white-75 fw-semibold">support@onlinewebhub.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Contact Methods Grid - Email & Chat Only -->
            <div class="row g-4 mb-5 justify-content-center">
                <!-- Email Support -->
                <div class="col-lg-6 col-md-6">
                    <div class="stat-card glass-effect h-100 p-5 rounded-4 shadow-lg border-0 text-center">
                        <div class="stat-icon mb-4 mx-auto">
                            <i class="bi bi-envelope-fill display-4 text-primary"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3 text-primary">Email Support</h3>
                        <div class="mb-4">
                            <a href="mailto:support@onlinewebhub.com" class="h5 fw-bold text-dark d-block mb-2">support@onlinewebhub.com</a>
                            <p class="text-muted small mb-0">Fastest response for all issues</p>
                        </div>
                        <a href="mailto:support@onlinewebhub.com" class="btn btn-outline-primary lift-hover">
                            <i class="bi bi-send me-2"></i>Send Email
                        </a>
                    </div>
                </div>


                <!-- Live Chat -->
                <div class="col-lg-6 col-md-6">
                    <div class="stat-card glass-effect h-100 p-5 rounded-4 shadow-lg border-0 text-center">
                        <div class="stat-icon mb-4 mx-auto">
                            <i class="bi bi-chat-dots-fill display-4 text-success"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3 text-success">Live Chat</h3>
                        <div class="mb-4">
                            <div class="h5 fw-bold text-dark mb-2">Instant Help</div>
                            <p class="text-muted small mb-0">Available 10AM - 8PM IST</p>
                        </div>
                        <button class="btn btn-success btn-lg lift-hover w-100">
                            <i class="bi bi-chat-dots me-2"></i>Start Chat
                        </button>
                    </div>
                </div>
            </div>


            <!-- Contact Form Section -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-xl rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-light border-0 py-4 px-5">
                        <h3 class="h4 mb-0 fw-bold text-dark">
                            <i class="bi bi-chat-square-text-fill me-2 text-success"></i>
                            Send Message
                        </h3>
                    </div>
                    <div class="card-body p-5">
                        <!-- Error Validation List -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-4 shadow-sm" role="alert">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3 mt-1"></i>
                                    <div>
                                        <strong class="fw-bold">Please fix the following errors:</strong>
                                        <ul class="mb-0 mt-2 ms-3">
                                            <?php foreach($errors->getIterator() as $error): ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('contact/send') ?>" method="POST">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="name">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" required>
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="subject" name="subject" required>
                                            <option value="">Select Category</option>
                                            <option value="technical">Technical Issue</option>
                                            <option value="billing">Billing Question</option>
                                            <option value="content">Course Content</option>
                                            <option value="account">Account Help</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                                        <label for="message">Your Message</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 lift-hover">
                                        <i class="bi bi-send me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Support Hours Only -->
            <div class="row g-4 mt-5">
                <div class="col-12">
                    <div class="glass-effect p-5 rounded-4 shadow-lg border-0 text-center">
                        <h4 class="fw-bold text-success mb-4">
                            <i class="bi bi-clock-history me-2"></i>Support Hours
                        </h4>
                        <div class="row g-4 justify-content-center">
                            <div class="col-lg-6 col-md-6">
                                <div class="h5 fw-bold text-primary mb-2">Email</div>
                                <p class="text-muted mb-0 h5">24/7 Response Time</p>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="h5 fw-bold text-success mb-2">Live Chat</div>
                                <p class="text-muted mb-0 h5">10AM - 8PM IST</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>