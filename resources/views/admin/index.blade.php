<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievia - Premium Board Exam Review Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;      /* Indigo */
            --secondary: #8b5cf6;    /* Purple */
            --accent: #a78bfa;       /* Light Purple */
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        
        /* Enhanced Animated Gradient Text */
        .gradient-text {
            background: linear-gradient(45deg, #ffffff, #e0e7ff, #c7d2fe, #ffffff, #f0f4ff);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientShift 3s ease infinite;
            text-shadow: 0 0 40px rgba(255, 255, 255, 0.8);
            filter: drop-shadow(0 0 20px rgba(255, 255, 255, 1)) drop-shadow(0 0 40px rgba(199, 210, 254, 0.6));
            font-weight: 900;
            letter-spacing: -0.02em;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        /* Enhanced Hero Background Animation */
        .hero-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, #4c1d95 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 25% 25%, rgba(255,255,255,0.15) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(199, 210, 254, 0.1) 1px, transparent 1px);
            background-size: 60px 60px, 40px 40px;
            animation: moveBackground 25s linear infinite, pulse 4s ease-in-out infinite alternate;
        }
        
        .hero-gradient::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.03) 50%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        /* Enhanced Floating Animation */
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
                filter: drop-shadow(0 10px 20px rgba(99, 102, 241, 0.2));
            }
            33% { 
                transform: translateY(-15px) rotate(1deg); 
                filter: drop-shadow(0 15px 30px rgba(99, 102, 241, 0.3));
            }
            66% { 
                transform: translateY(-25px) rotate(-1deg); 
                filter: drop-shadow(0 20px 40px rgba(99, 102, 241, 0.4));
            }
        }
        
        .float-animation {
            animation: float 4s ease-in-out infinite;
        }
        
        /* Enhanced Pulse Animation */
        @keyframes pulse-glow {
            0%, 100% { 
                box-shadow: 
                    0 0 20px rgba(99, 102, 241, 0.5),
                    0 0 40px rgba(139, 92, 246, 0.3),
                    inset 0 0 20px rgba(255, 255, 255, 0.1);
            }
            50% { 
                box-shadow: 
                    0 0 40px rgba(99, 102, 241, 0.8),
                    0 0 80px rgba(139, 92, 246, 0.6),
                    inset 0 0 30px rgba(255, 255, 255, 0.2);
            }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Enhanced Feature Card Hover Effects */
        .feature-card {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(139, 92, 246, 0.15), 
                rgba(99, 102, 241, 0.15), 
                transparent);
            transition: left 0.6s ease;
        }
        
        .feature-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .feature-card:hover::before {
            left: 100%;
        }
        
        .feature-card:hover::after {
            opacity: 1;
        }
        
        .feature-card:hover {
            transform: translateY(-15px) scale(1.03) rotateX(5deg);
            box-shadow: 
                0 30px 60px -12px rgba(99, 102, 241, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(25px);
        }
        
        /* Enhanced Plan Card Animation */
        .plan-card {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            backdrop-filter: blur(20px);
        }
        
        .plan-card::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 2px;
            background: linear-gradient(45deg, 
                rgba(99, 102, 241, 0.3), 
                rgba(139, 92, 246, 0.3), 
                rgba(99, 102, 241, 0.3));
            border-radius: inherit;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .plan-card:hover::before {
            opacity: 1;
        }
        
        .plan-card:hover {
            transform: translateY(-20px) scale(1.06) rotateX(5deg);
            box-shadow: 
                0 35px 70px -12px rgba(99, 102, 241, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(25px);
        }
        
        /* Glowing Border */
        .glow-border {
            position: relative;
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(45deg, var(--primary), var(--secondary)) border-box;
        }
        
        /* Particle Background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            top: 0;
            left: 0;
            z-index: 0;
        }
        
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: rise 10s infinite ease-in;
        }
        
        @keyframes rise {
            0% {
                bottom: -100px;
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                bottom: 100%;
                opacity: 0;
            }
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Enhanced Button Hover Effects */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(10px);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, rgba(255, 255, 255, 0.1) 70%, transparent 100%);
            transform: translate(-50%, -50%);
            transition: width 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), height 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .btn-primary:hover::before {
            width: 400px;
            height: 400px;
        }
        
        .btn-primary:hover::after {
            transform: translateX(100%);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 
                0 10px 25px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
        
        /* Enhanced Testimonial Card */
        .testimonial-card {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(20px);
            position: relative;
        }
        
        .testimonial-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, 
                rgba(255, 255, 255, 0.1), 
                rgba(255, 255, 255, 0.05), 
                rgba(255, 255, 255, 0.1));
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .testimonial-card:hover::before {
            opacity: 1;
        }
        
        .testimonial-card:hover {
            transform: scale(1.08) translateY(-10px) rotateX(5deg);
            box-shadow: 
                0 25px 50px rgba(99, 102, 241, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(25px);
        }
        
        /* Stats Counter Animation */
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-number {
            animation: countUp 1s ease-out;
        }
        
        /* Navbar Scroll Effect */
        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        /* Icon Background */
        .icon-bg {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        }
        
        /* Section Divider */
        .section-divider {
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            height: 2px;
            width: 100px;
            margin: 0 auto;
        }
        
        /* Advanced Glassmorphism Effects */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
        
        /* Magnetic Hover Effect */
        .magnetic-hover {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .magnetic-hover:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        /* Neon Glow Effect */
        .neon-glow {
            text-shadow: 
                0 0 5px currentColor,
                0 0 10px currentColor,
                0 0 15px currentColor,
                0 0 20px currentColor;
        }
        
        /* Morphing Background */
        @keyframes morphing {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }
        
        .morphing-bg {
            animation: morphing 8s ease-in-out infinite;
        }
        
        /* Particle System */
        .particle-system {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .particle-system::before,
        .particle-system::after {
            content: '';
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particleFloat 6s linear infinite;
        }
        
        .particle-system::before {
            left: 20%;
            animation-delay: -2s;
        }
        
        .particle-system::after {
            left: 80%;
            animation-delay: -4s;
        }
        
        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(1);
                opacity: 0;
            }
        }
        
        /* Enhanced Gradient Animations */
        @keyframes gradientWave {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .gradient-wave {
            background: linear-gradient(270deg, var(--primary), var(--secondary), var(--primary));
            background-size: 200% 200%;
            animation: gradientWave 4s ease infinite;
        }
        
        /* 3D Transform Effects */
        .transform-3d {
            transform-style: preserve-3d;
            perspective: 1000px;
        }
        
        .card-3d {
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .card-3d:hover {
            transform: rotateY(10deg) rotateX(10deg) translateZ(20px);
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Navigation -->
<nav id="navbar" class="bg-white shadow-md sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3" data-aos="fade-right">
                <a href="/" class="flex items-center group">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Achievia Logo" class="h-10 w-auto transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <span class="ml-2 text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent hidden sm:inline">Achievia</span>
                </a>
            </div>
            
            <!-- Desktop Nav Links -->
            <div class="hidden md:flex space-x-8" data-aos="fade-down">
                <a href="#features" class="text-gray-700 hover:text-indigo-600 transition-all duration-300 relative group">
                    Features
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#reviews" class="text-gray-700 hover:text-indigo-600 transition-all duration-300 relative group">
                    Reviews
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#plans" class="text-gray-700 hover:text-indigo-600 transition-all duration-300 relative group">
                    Plans
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#contact" class="text-gray-700 hover:text-indigo-600 transition-all duration-300 relative group">
                    Contact
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Mobile Toggle -->
            <div class="md:hidden" data-aos="fade-left">
                <button id="menu-btn" class="text-gray-500 focus:outline-none hover:text-indigo-600 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white pb-3 px-4 border-t">
        <a href="#features" class="block py-2 text-gray-700 hover:text-indigo-600 transition-colors duration-300">Features</a>
        <a href="#reviews" class="block py-2 text-gray-700 hover:text-indigo-600 transition-colors duration-300">Reviews</a>
        <a href="#plans" class="block py-2 text-gray-700 hover:text-indigo-600 transition-colors duration-300">Plans</a>
        <a href="#contact" class="block py-2 text-gray-700 hover:text-indigo-600 transition-colors duration-300">Contact</a>
    </div>
</nav>

    <!-- Ultra Enhanced Hero Section -->
    <section class="hero-gradient relative min-h-screen flex items-center">
        <!-- Enhanced Animated Particles -->
        <div class="particles">
            <div class="particle" style="left: 10%; width: 12px; height: 12px; animation-delay: 0s; background: linear-gradient(45deg, rgba(255,255,255,0.8), rgba(199,210,254,0.6));"></div>
            <div class="particle" style="left: 20%; width: 18px; height: 18px; animation-delay: 2s; background: linear-gradient(45deg, rgba(255,255,255,0.6), rgba(167,139,250,0.8));"></div>
            <div class="particle" style="left: 30%; width: 10px; height: 10px; animation-delay: 4s; background: linear-gradient(45deg, rgba(199,210,254,0.8), rgba(255,255,255,0.6));"></div>
            <div class="particle" style="left: 40%; width: 15px; height: 15px; animation-delay: 1s; background: linear-gradient(45deg, rgba(167,139,250,0.7), rgba(255,255,255,0.8));"></div>
            <div class="particle" style="left: 50%; width: 13px; height: 13px; animation-delay: 3s; background: linear-gradient(45deg, rgba(255,255,255,0.9), rgba(199,210,254,0.5));"></div>
            <div class="particle" style="left: 60%; width: 16px; height: 16px; animation-delay: 5s; background: linear-gradient(45deg, rgba(167,139,250,0.6), rgba(255,255,255,0.7));"></div>
            <div class="particle" style="left: 70%; width: 11px; height: 11px; animation-delay: 2.5s; background: linear-gradient(45deg, rgba(255,255,255,0.8), rgba(167,139,250,0.6));"></div>
            <div class="particle" style="left: 80%; width: 14px; height: 14px; animation-delay: 4.5s; background: linear-gradient(45deg, rgba(199,210,254,0.7), rgba(255,255,255,0.8));"></div>
            <div class="particle" style="left: 90%; width: 17px; height: 17px; animation-delay: 1.5s; background: linear-gradient(45deg, rgba(255,255,255,0.6), rgba(167,139,250,0.9));"></div>
        </div>
        
        <!-- Enhanced Floating Geometric Shapes -->
        <div class="absolute top-20 left-20 w-32 h-32 border-2 border-white/20 rounded-full animate-spin opacity-30" style="animation-duration: 30s;"></div>
        <div class="absolute bottom-32 right-32 w-24 h-24 border-2 border-white/15 rounded-lg rotate-45 animate-pulse opacity-25"></div>
        <div class="absolute top-1/3 right-1/4 w-16 h-16 bg-white/10 rounded-full animate-bounce opacity-20" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-20 h-20 border border-white/20 rounded-full animate-pulse opacity-30" style="animation-delay: 4s;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Enhanced Left Content -->
                <div class="relative">
                    <!-- Background Glow Effect -->
                    <div class="absolute -inset-10 bg-gradient-to-r from-white/5 to-white/10 rounded-3xl blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <!-- Enhanced Title -->
                        <h1 class="text-5xl md:text-7xl font-black text-white mb-8 leading-tight" data-aos="fade-up">
                            <span class="gradient-text neon-glow block mb-4 transform hover:scale-105 transition-transform duration-300" style="font-size: 1.3em;">
                                Ace Your Boards
                            </span>
                            <span class="text-white/90 block mb-2 text-4xl md:text-5xl">With Achievia's</span>
                            <span class="bg-gradient-to-r from-purple-200 via-white to-indigo-200 bg-clip-text text-transparent block text-4xl md:text-5xl font-bold">
                                Premium Review
                            </span>
                        </h1>
                        
                        <!-- Enhanced Description -->
                        <p class="text-xl md:text-2xl text-indigo-100 mb-10 leading-relaxed font-medium" data-aos="fade-up" data-aos-delay="200">
                            Subscription-based access to 
                            <span class="text-white font-bold">top-tier board exam preparation</span> 
                            materials, mnemonics, and expert reviewers.
                        </p>
                        
                        <!-- Enhanced CTA Buttons -->
                        <div class="flex flex-wrap gap-6 mb-12" data-aos="fade-up" data-aos-delay="400">
                            <a href="#plans" class="group btn-primary bg-white hover:bg-gray-100 text-indigo-600 px-10 py-5 rounded-full font-bold text-lg transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-110 magnetic-hover relative overflow-hidden">
                                <span class="relative z-10 flex items-center">
                                    <i class="fas fa-rocket mr-3 group-hover:animate-bounce"></i>
                                    Get Started Now
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            </a>
                            <a href="#features" class="group btn-primary border-2 border-white text-white hover:bg-white hover:text-indigo-600 px-10 py-5 rounded-full font-bold text-lg transition-all duration-300 shadow-2xl glass-effect hover:scale-110">
                                <span class="flex items-center">
                                    <i class="fas fa-play-circle mr-3 group-hover:animate-pulse"></i>
                                    Learn More
                                </span>
                            </a>
                        </div>
                        
                        <!-- Ultra Enhanced Stats -->
                        <div class="grid grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="group text-center glass-effect rounded-3xl p-6 hover:scale-110 transition-all duration-500 card-3d border border-white/20 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10">
                                    <div class="text-4xl font-black text-white stat-number neon-glow mb-2 group-hover:animate-pulse">10K+</div>
                                    <div class="text-indigo-200 text-sm font-semibold">Students</div>
                                    <div class="w-8 h-0.5 bg-gradient-to-r from-indigo-400 to-purple-400 mx-auto mt-2 rounded-full"></div>
                                </div>
                            </div>
                            <div class="group text-center glass-effect rounded-3xl p-6 hover:scale-110 transition-all duration-500 card-3d border border-white/20 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10">
                                    <div class="text-4xl font-black text-white stat-number neon-glow mb-2 group-hover:animate-pulse">95%</div>
                                    <div class="text-indigo-200 text-sm font-semibold">Pass Rate</div>
                                    <div class="w-8 h-0.5 bg-gradient-to-r from-purple-400 to-indigo-400 mx-auto mt-2 rounded-full"></div>
                                </div>
                            </div>
                            <div class="group text-center glass-effect rounded-3xl p-6 hover:scale-110 transition-all duration-500 card-3d border border-white/20 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10">
                                    <div class="text-4xl font-black text-white stat-number neon-glow mb-2 group-hover:animate-pulse">500+</div>
                                    <div class="text-indigo-200 text-sm font-semibold">Topnotchers</div>
                                    <div class="w-8 h-0.5 bg-gradient-to-r from-indigo-400 to-purple-400 mx-auto mt-2 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Enhanced Trust Indicators -->
                        <div class="flex items-center justify-center gap-8 mt-12" data-aos="fade-up" data-aos-delay="800">
                            <div class="flex items-center text-indigo-200 text-sm font-medium">
                                <i class="fas fa-shield-alt text-green-400 mr-2"></i>
                                Trusted by 10,000+ students
                            </div>
                            <div class="flex items-center text-indigo-200 text-sm font-medium">
                                <i class="fas fa-star text-yellow-400 mr-2"></i>
                                4.9/5 Rating
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Enhanced Right Content -->
                <div class="hidden md:block relative" data-aos="fade-left" data-aos-delay="300">
                    <!-- Enhanced Background Effects -->
                    <div class="absolute -inset-8 bg-gradient-to-r from-white/10 to-white/5 rounded-3xl blur-2xl"></div>
                    <div class="absolute -inset-4 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-3xl blur-xl"></div>
                    
                    <!-- Enhanced Image Container -->
                    <div class="relative float-animation group">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b3f64c88-1ee7-4654-acf8-958b9ad51e15.png" 
                             alt="Diverse group of medical students studying together in modern library with laptops and textbooks" 
                             class="rounded-3xl shadow-2xl pulse-glow transform group-hover:scale-105 transition-all duration-700 border-2 border-white/20" />
                        
                        <!-- Floating Achievement Badges -->
                        <div class="absolute -top-6 -right-6 bg-white/90 backdrop-blur-lg rounded-2xl p-4 shadow-xl border border-white/30 animate-bounce" style="animation-delay: 1s;">
                            <div class="text-2xl font-bold text-indigo-600">95%</div>
                            <div class="text-xs text-gray-600 font-semibold">Success Rate</div>
                        </div>
                        
                        <div class="absolute -bottom-6 -left-6 bg-white/90 backdrop-blur-lg rounded-2xl p-4 shadow-xl border border-white/30 animate-bounce" style="animation-delay: 2s;">
                            <div class="text-2xl font-bold text-purple-600">500+</div>
                            <div class="text-xs text-gray-600 font-semibold">Topnotchers</div>
                        </div>
                        
                        <div class="absolute top-1/2 -right-8 bg-white/90 backdrop-blur-lg rounded-2xl p-3 shadow-xl border border-white/30 animate-pulse">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-400 rounded-full mr-2 animate-ping"></div>
                                <div class="text-xs text-gray-600 font-semibold">Live Support</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <defs>
                    <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#F9FAFB;stop-opacity:1" />
                        <stop offset="50%" style="stop-color:#F3F4F6;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#F9FAFB;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="url(#waveGradient)"/>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-30">
            <div class="absolute top-20 left-20 w-72 h-72 bg-gradient-to-r from-indigo-300 to-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-72 h-72 bg-gradient-to-r from-purple-300 to-indigo-300 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20" data-aos="fade-up">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mb-6">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <h2 class="text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6">
                    Our Comprehensive Review System
                </h2>
                <div class="section-divider mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Achievia combines proven methodologies with innovative learning techniques to deliver unparalleled results
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group transform-3d" data-aos="fade-up" data-aos-delay="0">
                    <div class="bg-white/70 backdrop-blur-lg p-8 rounded-3xl shadow-xl feature-card border border-white/20 hover:bg-white/90 transition-all duration-500 card-3d">
                        <div class="relative mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 magnetic-hover morphing-bg">
                                <i class="fas fa-clock text-white text-2xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full animate-ping"></div>
                            <div class="particle-system"></div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 group-hover:text-indigo-600 transition-colors">Flexible Subscription</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Access premium content monthly, quarterly or annually with our flexible subscription plans designed for your success.
                        </p>
                        <div class="mt-6 flex items-center text-indigo-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="mr-2">Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <div class="group transform-3d" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white/70 backdrop-blur-lg p-8 rounded-3xl shadow-xl feature-card border border-white/20 hover:bg-white/90 transition-all duration-500 card-3d">
                        <div class="relative mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 magnetic-hover morphing-bg">
                                <i class="fas fa-user-graduate text-white text-2xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full animate-ping" style="animation-delay: 0.5s;"></div>
                            <div class="particle-system"></div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 group-hover:text-purple-600 transition-colors">Certified Reviewers</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Learn from top-rated reviewers who consistently produce board passers with their proven techniques and expertise.
                        </p>
                        <div class="mt-6 flex items-center text-purple-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="mr-2">Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <div class="group transform-3d" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white/70 backdrop-blur-lg p-8 rounded-3xl shadow-xl feature-card border border-white/20 hover:bg-white/90 transition-all duration-500 card-3d">
                        <div class="relative mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 magnetic-hover morphing-bg">
                                <i class="fas fa-brain text-white text-2xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full animate-ping" style="animation-delay: 1s;"></div>
                            <div class="particle-system"></div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 group-hover:text-indigo-600 transition-colors">Effective Mnemonics</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Master complex concepts faster with our scientifically-designed mnemonics and advanced memory techniques.
                        </p>
                        <div class="mt-6 flex items-center text-indigo-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="mr-2">Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <div class="group transform-3d" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-white/70 backdrop-blur-lg p-8 rounded-3xl shadow-xl feature-card border border-white/20 hover:bg-white/90 transition-all duration-500 card-3d">
                        <div class="relative mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 magnetic-hover morphing-bg">
                                <i class="fas fa-book-open text-white text-2xl"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full animate-ping" style="animation-delay: 1.5s;"></div>
                            <div class="particle-system"></div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 group-hover:text-purple-600 transition-colors">Comprehensive Materials</h3>
                        <p class="text-gray-600 leading-relaxed">
                            All key abbreviations and terminologies consolidated in easy-to-digest, beautifully formatted materials.
                        </p>
                        <div class="mt-6 flex items-center text-purple-600 font-semibold group-hover:translate-x-2 transition-transform">
                            <span class="mr-2">Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Supplemental Materials Section -->
    <section class="py-24 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900 via-indigo-900 to-purple-800"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 60px 60px; animation: moveBackground 30s linear infinite;"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-10 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-indigo-300 rounded-full mix-blend-overlay filter blur-3xl opacity-10 animate-pulse" style="animation-delay: 2s;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-3xl blur-2xl opacity-30 group-hover:opacity-50 transition-opacity duration-500"></div>
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b4220a0f-3a82-4fe4-a617-05429ec44afd.png" alt="Detailed medical textbooks with highlighted sections and handwritten notes arranged neatly" class="relative rounded-3xl shadow-2xl transform group-hover:scale-105 transition-transform duration-500" />
                        
                        <!-- Floating Stats -->
                        <div class="absolute -top-6 -right-6 bg-white/90 backdrop-blur-lg rounded-2xl p-4 shadow-xl border border-white/20">
                            <div class="text-2xl font-bold text-indigo-600">500+</div>
                            <div class="text-sm text-gray-600">Study Materials</div>
                        </div>
                        
                        <div class="absolute -bottom-6 -left-6 bg-white/90 backdrop-blur-lg rounded-2xl p-4 shadow-xl border border-white/20">
                            <div class="text-2xl font-bold text-purple-600">98%</div>
                            <div class="text-sm text-gray-600">Accuracy Rate</div>
                        </div>
                    </div>
                </div>
                
                <div data-aos="fade-left">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-white/20 to-white/10 rounded-full mb-6 backdrop-blur-lg">
                        <i class="fas fa-gem text-white text-2xl"></i>
                    </div>
                    <h2 class="text-5xl font-bold text-white mb-6">
                        Premium Supplemental 
                        <span class="bg-gradient-to-r from-purple-300 to-indigo-300 bg-clip-text text-transparent">Materials</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full mb-8"></div>
                    <p class="text-xl text-indigo-100 mb-10 leading-relaxed">
                        Our supplementals go beyond standard review materials to provide the competitive edge you need for board exam success.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start group" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Board-Style Questions</h4>
                                <p class="text-indigo-200">Updated questions with detailed explanations and comprehensive rationales</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start group" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Condensed Review Notes</h4>
                                <p class="text-indigo-200">Perfectly formatted notes for efficient last-minute review sessions</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start group" data-aos="fade-up" data-aos-delay="300">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Clinical Case Scenarios</h4>
                                <p class="text-indigo-200">High-yield clinical cases that mirror real board exam situations</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start group" data-aos="fade-up" data-aos-delay="400">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Visual Learning Aids</h4>
                                <p class="text-indigo-200">Stunning infographics and visual aids for complex medical topics</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10">
                        <a href="#plans" class="inline-flex items-center bg-white/10 hover:bg-white/20 text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 backdrop-blur-lg border border-white/20 hover:scale-105">
                            <i class="fas fa-rocket mr-3"></i>
                            Explore Materials
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ultra Enhanced Pricing Section -->
    <section id="plans" class="py-24 relative overflow-hidden">
        <!-- Multi-layered Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-30">
            <div class="absolute top-32 left-32 w-96 h-96 bg-gradient-to-r from-indigo-200 to-purple-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse morphing-bg"></div>
            <div class="absolute bottom-32 right-32 w-96 h-96 bg-gradient-to-r from-purple-200 to-indigo-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse morphing-bg" style="animation-delay: 3s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full mix-blend-multiply filter blur-3xl animate-pulse morphing-bg" style="animation-delay: 1.5s;"></div>
        </div>
        
        <!-- Enhanced floating geometric shapes -->
        <div class="absolute top-20 left-20 w-16 h-16 border-2 border-indigo-300/30 rounded-lg rotate-45 animate-spin magnetic-hover" style="animation-duration: 20s;"></div>
        <div class="absolute bottom-20 right-20 w-12 h-12 border-2 border-purple-300/30 rounded-full animate-bounce magnetic-hover" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/3 right-1/4 w-8 h-8 bg-gradient-to-r from-indigo-300/20 to-purple-300/20 rounded-full animate-pulse morphing-bg" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-1/3 left-1/4 w-10 h-10 bg-gradient-to-r from-purple-300/20 to-indigo-300/20 rounded-lg animate-pulse morphing-bg" style="animation-delay: 6s;"></div>
        
        <!-- Particle Systems -->
        <div class="particle-system"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Ultra Enhanced Section Header -->
            <div class="text-center mb-20 relative" data-aos="fade-up">
                <!-- Floating Background Elements -->
                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-32 h-32 bg-gradient-to-r from-indigo-200/30 to-purple-200/30 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 w-20 h-20 bg-gradient-to-r from-purple-300/40 to-indigo-300/40 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
                
                <!-- Enhanced Icon -->
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mb-8 relative transform-3d magnetic-hover morphing-bg">
                    <i class="fas fa-crown text-white text-4xl neon-glow"></i>
                    <div class="absolute -inset-3 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full animate-ping opacity-20"></div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-white/20 to-white/10 rounded-full"></div>
                    <div class="particle-system"></div>
                </div>
                
                <!-- Enhanced Title -->
                <h2 class="text-7xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-8 neon-glow gradient-wave" style="background-size: 300% 300%;">
                    Flexible Subscription Plans
                </h2>
                
                <!-- Enhanced Decorative Elements -->
                <div class="flex items-center justify-center mb-8">
                    <div class="w-20 h-1 bg-gradient-to-r from-transparent via-indigo-400 to-indigo-600 rounded-full"></div>
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-6 flex items-center justify-center relative magnetic-hover morphing-bg">
                        <i class="fas fa-star text-white text-lg neon-glow"></i>
                        <div class="absolute -inset-1 bg-gradient-to-r from-white/30 to-white/10 rounded-full animate-pulse"></div>
                    </div>
                    <div class="w-20 h-1 bg-gradient-to-r from-purple-600 via-purple-400 to-transparent rounded-full"></div>
                </div>
                
                <!-- Enhanced Description -->
                <div class="relative">
                    <p class="text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed font-medium">
                        Choose the perfect plan that fits your study timeline and budget. 
                        <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent font-bold">All plans include our premium guarantee</span> 
                        and world-class support.
                    </p>
                    
                    <!-- Floating Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-12 max-w-2xl mx-auto">
                        <div class="text-center glass-effect rounded-2xl p-4 hover:scale-110 transition-all duration-500 card-3d">
                            <div class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent neon-glow">3</div>
                            <div class="text-gray-500 text-sm font-medium">Plan Options</div>
                        </div>
                        <div class="text-center glass-effect rounded-2xl p-4 hover:scale-110 transition-all duration-500 card-3d">
                            <div class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent neon-glow">30</div>
                            <div class="text-gray-500 text-sm font-medium">Day Guarantee</div>
                        </div>
                        <div class="text-center glass-effect rounded-2xl p-4 hover:scale-110 transition-all duration-500 card-3d">
                            <div class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent neon-glow">24/7</div>
                            <div class="text-gray-500 text-sm font-medium">Support</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto transform-3d">
                <!-- Monthly Plan -->
                <div class="group" data-aos="fade-up" data-aos-delay="0">
                    <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-xl plan-card border border-white/20 overflow-hidden hover:bg-white/90 transition-all duration-500 card-3d">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Monthly</h3>
                                <div class="w-12 h-12 bg-gradient-to-r from-gray-400 to-gray-500 rounded-full flex items-center justify-center magnetic-hover morphing-bg">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-8">Perfect for quick review sessions and short-term preparation</p>
                            
                            <div class="mb-8">
                                <div class="flex items-end mb-2">
                                    <span class="text-5xl font-bold bg-gradient-to-r from-gray-700 to-gray-800 bg-clip-text text-transparent neon-glow">₱2,499</span>
                                    <span class="text-gray-500 ml-2 text-lg">/month</span>
                                </div>
                                <p class="text-sm text-gray-500">Billed monthly</p>
                            </div>
                            
                            <ul class="space-y-4 mb-8">
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">All basic reviewers and materials</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Monthly updated content</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Basic mnemonics library</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Email support</span>
                                </li>
                            </ul>
                            
                            <button class="w-full bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl btn-primary">
                                Get Started
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quarterly Plan - Featured -->
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl plan-card border-2 border-indigo-200 overflow-hidden transform -translate-y-4 hover:bg-white/95 transition-all duration-500 card-3d">
                        <!-- Popular Badge -->
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-6 py-2 rounded-full text-sm font-semibold shadow-lg gradient-wave">
                                <i class="fas fa-star mr-2"></i>Most Popular
                            </div>
                        </div>
                        
                        <!-- Enhanced Glow Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-3xl"></div>
                        <div class="particle-system"></div>
                        
                        <div class="p-8 pt-12 relative">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Quarterly</h3>
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center magnetic-hover morphing-bg">
                                    <i class="fas fa-gem text-white"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-8">Best value for comprehensive review and maximum results</p>
                            
                            <div class="mb-8">
                                <div class="flex items-end mb-2">
                                    <span class="text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent neon-glow">₱6,599</span>
                                    <span class="text-gray-500 ml-2 text-lg">/quarter</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-indigo-600 font-semibold bg-indigo-50 px-3 py-1 rounded-full">Save 12% vs monthly</span>
                                </div>
                            </div>
                            
                            <ul class="space-y-4 mb-8">
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Everything in Monthly plan</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Advanced mnemonics & techniques</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Premium supplemental materials</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Weekly live Q&A sessions</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Priority support</span>
                                </li>
                            </ul>
                            
                            <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl btn-primary">
                                <i class="fas fa-rocket mr-2"></i>Choose Plan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Annual Plan -->
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-xl plan-card border border-white/20 overflow-hidden hover:bg-white/90 transition-all duration-500 card-3d">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Annual</h3>
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center magnetic-hover morphing-bg">
                                    <i class="fas fa-trophy text-white"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-8">Complete exam preparation cycle with maximum savings</p>
                            
                            <div class="mb-8">
                                <div class="flex items-end mb-2">
                                    <span class="text-5xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent neon-glow">₱22,999</span>
                                    <span class="text-gray-500 ml-2 text-lg">/year</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-purple-600 font-semibold bg-purple-50 px-3 py-1 rounded-full">Save 23% vs monthly</span>
                                </div>
                            </div>
                            
                            <ul class="space-y-4 mb-8">
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Everything in Quarterly plan</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Personalized study plan</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">Two comprehensive mock exams</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-5 h-5 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mr-3 magnetic-hover">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <span class="text-gray-700">VIP support & mentoring</span>
                                </li>
                            </ul>
                            
                            <button class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl btn-primary">
                                Get Started
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Money Back Guarantee -->
            <div class="text-center mt-20 relative" data-aos="fade-up" data-aos-delay="300">
                <!-- Background Glow -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-96 h-24 bg-gradient-to-r from-indigo-200/20 via-purple-200/30 to-indigo-200/20 rounded-full blur-3xl"></div>
                </div>
                
                <!-- Enhanced Guarantee Badge -->
                <div class="inline-flex items-center bg-white/90 backdrop-blur-lg rounded-full px-10 py-6 shadow-2xl border-2 border-white/30 relative transform-3d hover:scale-105 transition-all duration-500 card-3d">
                    <!-- Animated Border -->
                    <div class="absolute inset-0 rounded-full bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 p-0.5 gradient-wave">
                        <div class="bg-white/90 backdrop-blur-lg rounded-full w-full h-full"></div>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center mr-4 magnetic-hover morphing-bg">
                            <i class="fas fa-shield-alt text-white text-xl neon-glow"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                30-Day Money-Back Guarantee
                            </div>
                            <div class="text-sm text-gray-600 font-medium">
                                Risk-free trial on all subscription plans
                            </div>
                        </div>
                        <div class="ml-6 flex space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Trust Indicators -->
                <div class="grid grid-cols-3 gap-6 mt-12 max-w-2xl mx-auto">
                    <div class="text-center glass-effect rounded-xl p-4 hover:scale-105 transition-all duration-300">
                        <i class="fas fa-lock text-indigo-500 text-2xl mb-2"></i>
                        <div class="text-sm font-semibold text-gray-700">Secure Payment</div>
                    </div>
                    <div class="text-center glass-effect rounded-xl p-4 hover:scale-105 transition-all duration-300">
                        <i class="fas fa-sync-alt text-purple-500 text-2xl mb-2"></i>
                        <div class="text-sm font-semibold text-gray-700">Cancel Anytime</div>
                    </div>
                    <div class="text-center glass-effect rounded-xl p-4 hover:scale-105 transition-all duration-300">
                        <i class="fas fa-headset text-indigo-500 text-2xl mb-2"></i>
                        <div class="text-sm font-semibold text-gray-700">24/7 Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Logo Story: Vertical Timeline + Animations -->
<section class="py-24 bg-gradient-to-b from-indigo-50 to-white">
  <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-10">

    <!-- Header -->
    <div class="text-center mb-16" data-aos="fade-up">
      <h2 class="text-4xl font-bold text-indigo-800">The Story Behind the Achievia Logo</h2>
      <p class="mt-4 text-lg text-gray-600">
        Every curve, line, and space in our logo is a metaphor for a learner's journey — filled with ambition, trials, growth, and ultimately, achievement.
      </p>
    </div>

    <!-- Timeline -->
    <div class="relative border-l-4 border-indigo-200 pl-6 space-y-16">

      <!-- Step 1 -->
      <div class="relative" data-aos="fade-right">
        <div class="absolute -left-7 top-1 w-6 h-6 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-semibold text-indigo-700">Peak – The Letter “A”</h3>
        <p class="text-gray-700 mt-2 text-lg">
          The “A” symbolizes <strong>aspiration and ambition</strong>. It stands tall as a marker of excellence, beginning every learner’s climb to success.
        </p>
      </div>

      <!-- Step 2 -->
      <div class="relative" data-aos="fade-left">
        <div class="absolute -left-7 top-1 w-6 h-6 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-semibold text-indigo-700">Ups and Downs</h3>
        <p class="text-gray-700 mt-2 text-lg">
          The lines in our logo reflect the <strong>real learning journey</strong> — full of highs, lows, doubts, and breakthroughs.
        </p>
      </div>

      <!-- Step 3 -->
      <div class="relative" data-aos="fade-right">
        <div class="absolute -left-7 top-1 w-6 h-6 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-semibold text-indigo-700">Mistakes & Curiosity</h3>
        <p class="text-gray-700 mt-2 text-lg">
          The “X” stands for mistakes. Asking “Y?” represents <strong>curiosity as the spark of deeper learning</strong>.
        </p>
      </div>

      <!-- Step 4 -->
      <div class="relative" data-aos="fade-left">
        <div class="absolute -left-7 top-1 w-6 h-6 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-semibold text-indigo-700">Corrections & Improvements</h3>
        <p class="text-gray-700 mt-2 text-lg">
          Our check-like lines represent support and progress — because <strong>growth comes from reflection and guidance</strong>.
        </p>
      </div>

      <!-- Step 5 -->
      <div class="relative" data-aos="fade-right">
        <div class="absolute -left-7 top-1 w-6 h-6 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-semibold text-indigo-700">Rest & Wellness</h3>
        <p class="text-gray-700 mt-2 text-lg">
          The intentional spaces in the logo stand for <strong>mental wellness</strong>. Rest isn’t a pause in learning — it’s part of it.
        </p>
      </div>

      <!-- Step 6 -->
      <div class="relative" data-aos="fade-up">
        <div class="absolute -left-7 top-1 w-6 h-6 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-semibold text-indigo-700">Achievement</h3>
        <p class="text-gray-700 mt-2 text-lg">
          From ambition to growth, the Achievia logo tells a story of <strong>overcoming and becoming</strong>. Every learner, fulfilled.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- Add in <head> -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Add before </body> -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>


    <!-- Ultra Enhanced Mission & Vision Section -->
<section class="py-32 relative overflow-hidden">
        <!-- Multi-layered Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-white via-indigo-50/50 to-purple-50/30"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-20 w-96 h-96 bg-gradient-to-r from-indigo-200 to-purple-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse morphing-bg"></div>
            <div class="absolute bottom-20 right-20 w-80 h-80 bg-gradient-to-r from-purple-200 to-indigo-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse morphing-bg" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full mix-blend-multiply filter blur-3xl animate-pulse morphing-bg" style="animation-delay: 4s;"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-32 right-32 text-indigo-300/30 animate-bounce magnetic-hover" style="animation-delay: 1s;">
            <i class="fas fa-lightbulb text-5xl"></i>
        </div>
        <div class="absolute bottom-32 left-32 text-purple-300/30 animate-bounce magnetic-hover" style="animation-delay: 3s;">
            <i class="fas fa-rocket text-4xl"></i>
        </div>
        <div class="absolute top-1/4 right-1/4 text-indigo-300/30 animate-pulse magnetic-hover" style="animation-delay: 2s;">
            <i class="fas fa-star text-3xl"></i>
        </div>
        <div class="absolute bottom-1/4 left-1/4 text-purple-300/30 animate-pulse magnetic-hover" style="animation-delay: 5s;">
            <i class="fas fa-heart text-2xl"></i>
        </div>
        
        <!-- Particle Systems -->
        <div class="particle-system"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-7xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-8 neon-glow gradient-wave" style="background-size: 300% 300%;">Mission & Vision</h2>
    <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-16">
      At Achievia, we’re more than a review platform—we’re a movement toward excellence, equity, and growth.  
      Discover what drives our purpose and where we’re headed.
    </p>

    <div class="grid md:grid-cols-2 gap-10 text-left">
      <!-- Mission Card -->
      <div class="bg-white rounded-3xl shadow-xl p-10 hover:shadow-2xl transition duration-500">
        <div class="flex items-center mb-6">
          <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center">
            <svg class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m0-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-indigo-700 ml-4">Our Mission</h3>
        </div>
        <p class="text-gray-700 text-lg leading-relaxed">
          We empower learners to transform challenges into opportunities. Through purposeful, inclusive, and values-driven education, we ignite curiosity, build resilience, and inspire excellence. With innovation and integrity, we rise—together.
        </p>
      </div>

      <!-- Vision Card -->
      <div class="bg-white rounded-3xl shadow-xl p-10 hover:shadow-2xl transition duration-500">
        <div class="flex items-center mb-6">
          <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center">
            <svg class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.567-3 3.5S10.343 15 12 15s3-1.567 3-3.5S13.657 8 12 8zm0 0V4m0 11v5m-4-4h8" />
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-indigo-700 ml-4">Our Vision</h3>
        </div>
        <p class="text-gray-700 text-lg leading-relaxed">
          To become the leading platform for transformative, inclusive learning—where dreams are nurtured, differences are celebrated, and every learner is equipped to succeed with confidence, purpose, and pride.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Core Values Section -->
<section class="py-24 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800"></div>
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 80px 80px; animation: moveBackground 40s linear infinite;"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-20 w-96 h-96 bg-gradient-to-r from-purple-400/20 to-indigo-400/20 rounded-full mix-blend-overlay filter blur-3xl animate-pulse"></div>
    <div class="absolute bottom-20 right-20 w-80 h-80 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-white/20 to-white/10 rounded-full mb-8 backdrop-blur-lg border border-white/20">
                <i class="fas fa-heart text-white text-3xl"></i>
            </div>
            <h2 class="text-6xl font-bold text-white mb-6">
                Our Core 
                <span class="bg-gradient-to-r from-purple-300 to-indigo-300 bg-clip-text text-transparent">Values</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full mx-auto mb-8"></div>
            <p class="text-xl text-indigo-100 max-w-3xl mx-auto leading-relaxed">
                The ACHIEVIA values that guide everything we do - from curriculum design to student success
            </p>
        </div>

        <!-- Values Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- A - Aspiration -->
            <div class="group" data-aos="fade-up" data-aos-delay="0">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">A</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-purple-200 transition-colors">Aspiration</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve by setting high goals and dreaming beyond limits. We inspire students to reach for excellence.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- C - Commitment -->
            <div class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">C</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping" style="animation-delay: 0.5s;"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-indigo-200 transition-colors">Commitment</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve through consistent effort and dedication to learning. We stand by our students every step.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- H - Honesty -->
            <div class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">H</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping" style="animation-delay: 1s;"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-purple-200 transition-colors">Honesty</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve with truthfulness, integrity, and trust in every action. Transparency builds lasting success.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- I - Innovation -->
            <div class="group" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">I</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping" style="animation-delay: 1.5s;"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-indigo-200 transition-colors">Innovation</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve through creative thinking and modern learning approaches. We embrace cutting-edge methods.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- E - Excellence -->
            <div class="group" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">E</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping" style="animation-delay: 2s;"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-purple-200 transition-colors">Excellence</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve by striving for the highest quality in all we do. Excellence is our standard, not our goal.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- V - Values -->
            <div class="group" data-aos="fade-up" data-aos-delay="500">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">V</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping" style="animation-delay: 2.5s;"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-indigo-200 transition-colors">Values</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve by learning with purpose, guided by strong principles. Our values shape every decision.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- I - Inclusivity -->
            <div class="group" data-aos="fade-up" data-aos-delay="600">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">I</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping" style="animation-delay: 3s;"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-purple-200 transition-colors">Inclusivity</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve by embracing diversity and ensuring equal opportunity. Every student deserves success.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>

            <!-- A - Achievement -->
            <div class="group" data-aos="fade-up" data-aos-delay="700">
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <div class="relative mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 mx-auto">
                            <span class="text-3xl font-bold text-white">A</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-white/40 to-white/20 rounded-full animate-ping" style="animation-delay: 3.5s;"></div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 text-center group-hover:text-indigo-200 transition-colors">Achievement</h3>
                    <p class="text-indigo-200 leading-relaxed text-center">
                        Achieve by celebrating every milestone toward success. Your victory is our greatest reward.
                    </p>
                    <div class="mt-6 flex justify-center">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom CTA -->
        <div class="text-center mt-20" data-aos="fade-up" data-aos-delay="800">
            <div class="inline-flex items-center bg-white/10 hover:bg-white/20 text-white px-10 py-5 rounded-full font-semibold transition-all duration-300 backdrop-blur-lg border border-white/20 hover:scale-105 cursor-pointer">
                <i class="fas fa-heart mr-3 text-purple-300"></i>
                <span>These values drive everything we do</span>
                <i class="fas fa-heart ml-3 text-indigo-300"></i>
            </div>
        </div>
    </div>
</section>


<!-- Meet the Achievia Authors -->
<section class="py-24 relative overflow-hidden">
  <!-- Animated Background -->
  <div class="absolute inset-0 bg-gradient-to-br from-white via-indigo-50 to-purple-50"></div>
  <div class="absolute top-0 left-0 w-full h-full opacity-20">
    <div class="absolute top-20 left-20 w-80 h-80 bg-gradient-to-r from-indigo-200 to-purple-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
    <div class="absolute bottom-20 right-20 w-96 h-96 bg-gradient-to-r from-purple-200 to-indigo-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 4s;"></div>
  </div>
  
  <!-- Floating Elements -->
  <div class="absolute top-32 right-32 text-indigo-300/30 animate-bounce" style="animation-delay: 1s;">
    <i class="fas fa-user-graduate text-4xl"></i>
  </div>
  <div class="absolute bottom-32 left-32 text-purple-300/30 animate-bounce" style="animation-delay: 3s;">
    <i class="fas fa-chalkboard-teacher text-3xl"></i>
  </div>
  <div class="absolute top-1/4 right-1/4 text-indigo-300/30 animate-pulse" style="animation-delay: 2s;">
    <i class="fas fa-award text-2xl"></i>
  </div>
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
    <!-- Section Header -->
    <div class="mb-20" data-aos="fade-up">
      <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mb-8 relative">
        <i class="fas fa-users text-white text-3xl"></i>
        <div class="absolute -inset-2 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full animate-ping opacity-20"></div>
      </div>
      <h2 class="text-6xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6">
        Meet the Achievia Authors
      </h2>
      <div class="flex items-center justify-center mb-6">
        <div class="w-16 h-0.5 bg-gradient-to-r from-transparent to-indigo-400"></div>
        <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-4 flex items-center justify-center">
          <i class="fas fa-star text-white text-sm"></i>
        </div>
        <div class="w-16 h-0.5 bg-gradient-to-r from-purple-400 to-transparent"></div>
      </div>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
        A diverse team of expert reviewers and educators powering your board exam success with proven methodologies and years of experience.
      </p>
    </div>

    <!-- Authors Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
      <!-- Author 1 - Dr. Angela Cortez -->
      <div class="group" data-aos="fade-up" data-aos-delay="0">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 border border-white/30 relative overflow-hidden">
          <!-- Background Pattern -->
          <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-100/50 to-purple-100/50 rounded-full -translate-y-16 translate-x-16"></div>
          
          <!-- Profile Image -->
          <div class="relative mb-6">
            <div class="w-32 h-32 mx-auto relative">
              <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/author1.png" alt="Dr. Angela Cortez" class="w-full h-full rounded-full object-cover border-4 border-white shadow-lg group-hover:scale-110 transition-transform duration-300">
              <!-- Status Badge -->
              <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                <i class="fas fa-check text-white text-sm"></i>
              </div>
              <!-- Specialty Badge -->
              <div class="absolute -top-2 -left-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Medicine
              </div>
            </div>
          </div>
          
          <!-- Content -->
          <div class="text-center">
            <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition-colors">Dr. Angela Cortez</h4>
            <p class="text-indigo-600 font-semibold mb-1">Medical Topnotcher & Reviewer</p>
            <div class="flex items-center justify-center mb-4">
              <div class="flex space-x-1">
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
              </div>
              <span class="text-gray-500 text-sm ml-2">(4.9/5)</span>
            </div>
            <p class="text-gray-600 leading-relaxed mb-6">
              Dr. Cortez believes in accessible, high-quality education for all. She brings academic rigor and compassion to every learning module with 10+ years of experience.
            </p>
            
            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4 mb-6">
              <div class="text-center">
                <div class="text-2xl font-bold text-indigo-600">500+</div>
                <div class="text-xs text-gray-500">Students Mentored</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">95%</div>
                <div class="text-xs text-gray-500">Pass Rate</div>
              </div>
            </div>
            
            <!-- Social Links -->
            <div class="flex justify-center gap-3">
              <a href="#" class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="#" class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Author 2 - Engr. Carlo Mendoza -->
      <div class="group" data-aos="fade-up" data-aos-delay="100">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 border border-white/30 relative overflow-hidden">
          <!-- Background Pattern -->
          <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-100/50 to-indigo-100/50 rounded-full -translate-y-16 translate-x-16"></div>
          
          <!-- Profile Image -->
          <div class="relative mb-6">
            <div class="w-32 h-32 mx-auto relative">
              <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/author2.png" alt="Engr. Carlo Mendoza" class="w-full h-full rounded-full object-cover border-4 border-white shadow-lg group-hover:scale-110 transition-transform duration-300">
              <!-- Status Badge -->
              <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                <i class="fas fa-check text-white text-sm"></i>
              </div>
              <!-- Specialty Badge -->
              <div class="absolute -top-2 -left-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Engineering
              </div>
            </div>
          </div>
          
          <!-- Content -->
          <div class="text-center">
            <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition-colors">Engr. Carlo Mendoza</h4>
            <p class="text-purple-600 font-semibold mb-1">Engineering Reviewer</p>
            <div class="flex items-center justify-center mb-4">
              <div class="flex space-x-1">
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
              </div>
              <span class="text-gray-500 text-sm ml-2">(4.8/5)</span>
            </div>
            <p class="text-gray-600 leading-relaxed mb-6">
              A professional engineer who mentors future engineers through structured review plans and practical drills based on actual board trends and industry experience.
            </p>
            
            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4 mb-6">
              <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">300+</div>
                <div class="text-xs text-gray-500">Students Mentored</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-indigo-600">92%</div>
                <div class="text-xs text-gray-500">Pass Rate</div>
              </div>
            </div>
            
            <!-- Social Links -->
            <div class="flex justify-center gap-3">
              <a href="#" class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="#" class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Author 3 - Prof. Lea Ramos -->
      <div class="group" data-aos="fade-up" data-aos-delay="200">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 border border-white/30 relative overflow-hidden">
          <!-- Background Pattern -->
          <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-100/50 to-purple-100/50 rounded-full -translate-y-16 translate-x-16"></div>
          
          <!-- Profile Image -->
          <div class="relative mb-6">
            <div class="w-32 h-32 mx-auto relative">
              <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/author3.png" alt="Prof. Lea Ramos" class="w-full h-full rounded-full object-cover border-4 border-white shadow-lg group-hover:scale-110 transition-transform duration-300">
              <!-- Status Badge -->
              <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                <i class="fas fa-check text-white text-sm"></i>
              </div>
              <!-- Specialty Badge -->
              <div class="absolute -top-2 -left-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Nursing
              </div>
            </div>
          </div>
          
          <!-- Content -->
          <div class="text-center">
            <h4 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition-colors">Prof. Lea Ramos</h4>
            <p class="text-indigo-600 font-semibold mb-1">Nursing Content Strategist</p>
            <div class="flex items-center justify-center mb-4">
              <div class="flex space-x-1">
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
                <i class="fas fa-star text-yellow-400 text-sm"></i>
              </div>
              <span class="text-gray-500 text-sm ml-2">(4.9/5)</span>
            </div>
            <p class="text-gray-600 leading-relaxed mb-6">
              Prof. Lea ensures our nursing review paths are evidence-based, updated, and aligned with modern clinical frameworks and best practices in healthcare.
            </p>
            
            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4 mb-6">
              <div class="text-center">
                <div class="text-2xl font-bold text-indigo-600">400+</div>
                <div class="text-xs text-gray-500">Students Mentored</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">97%</div>
                <div class="text-xs text-gray-500">Pass Rate</div>
              </div>
            </div>
            
            <!-- Social Links -->
            <div class="flex justify-center gap-3">
              <a href="#" class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="#" class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Team Stats -->
    <div class="mt-20" data-aos="fade-up" data-aos-delay="300">
      <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 border border-white/30 shadow-xl max-w-4xl mx-auto">
        <h3 class="text-2xl font-bold text-center mb-8 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Our Team's Combined Impact</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div class="text-center">
            <div class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">1,200+</div>
            <div class="text-gray-600 text-sm">Total Students Mentored</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">95%</div>
            <div class="text-gray-600 text-sm">Average Pass Rate</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">25+</div>
            <div class="text-gray-600 text-sm">Years Combined Experience</div>
          </div>
          <div class="text-center">
            <div class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">150+</div>
            <div class="text-gray-600 text-sm">Topnotchers Produced</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Testimonials Section -->
    <section id="reviews" class="py-24 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 60px 60px; animation: moveBackground 25s linear infinite;"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-20 w-80 h-80 bg-gradient-to-r from-purple-400/20 to-indigo-400/20 rounded-full mix-blend-overlay filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-gradient-to-r from-white/10 to-white/5 rounded-full mix-blend-overlay filter blur-3xl animate-pulse" style="animation-delay: 4s;"></div>
        
        <!-- Floating Icons -->
        <div class="absolute top-32 right-32 text-white/20 animate-bounce" style="animation-delay: 1s;">
            <i class="fas fa-graduation-cap text-4xl"></i>
        </div>
        <div class="absolute bottom-32 left-32 text-white/20 animate-bounce" style="animation-delay: 3s;">
            <i class="fas fa-trophy text-3xl"></i>
        </div>
        <div class="absolute top-1/3 left-1/3 text-white/20 animate-pulse" style="animation-delay: 2s;">
            <i class="fas fa-star text-2xl"></i>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Enhanced Section Header -->
            <div class="text-center mb-20" data-aos="fade-up">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-white/20 to-white/10 rounded-full mb-8 backdrop-blur-lg border border-white/20">
                    <i class="fas fa-users text-white text-3xl"></i>
                </div>
                <h2 class="text-6xl font-bold text-white mb-6">
                    Our Successful 
                    <span class="bg-gradient-to-r from-purple-300 to-indigo-300 bg-clip-text text-transparent">Board Passers</span>
                </h2>
                <div class="flex items-center justify-center mb-8">
                    <div class="w-20 h-0.5 bg-gradient-to-r from-transparent to-purple-400"></div>
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full mx-4 flex items-center justify-center">
                        <i class="fas fa-medal text-white text-sm"></i>
                    </div>
                    <div class="w-20 h-0.5 bg-gradient-to-r from-indigo-400 to-transparent"></div>
                </div>
                <p class="text-xl text-indigo-100 max-w-3xl mx-auto leading-relaxed">
                    Join thousands who achieved board success with Achievia's proven methodology and expert guidance
                </p>
                
                <!-- Success Stats -->
                <div class="grid grid-cols-3 gap-8 mt-12 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">10,000+</div>
                        <div class="text-indigo-200 text-sm">Success Stories</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">95%</div>
                        <div class="text-indigo-200 text-sm">Pass Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">500+</div>
                        <div class="text-indigo-200 text-sm">Topnotchers</div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Testimonial Cards -->
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <!-- Testimonial 1 -->
                <div class="group" data-aos="fade-up" data-aos-delay="0">
                    <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 testimonial-card">
                        <!-- Quote Icon -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400/30 to-indigo-400/30 rounded-full flex items-center justify-center">
                                <i class="fas fa-quote-left text-white text-xl"></i>
                            </div>
                            <div class="flex space-x-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                            </div>
                        </div>
                        
                        <!-- Testimonial Text -->
                        <p class="text-indigo-100 leading-relaxed mb-8 text-lg italic">
                            "Achievia's mnemonics made memorizing complex medical concepts effortless. The premium supplementals were exactly what I needed to score in the top 10%."
                        </p>
                        
                        <!-- Profile -->
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-3 border-white/30 mr-4">
                                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/651a5eea-5969-42a2-a2ab-eaf08a70d792.png" alt="Maria Santos" class="w-full h-full object-cover" />
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center border-2 border-white">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Maria Santos</h4>
                                <p class="text-indigo-200 text-sm">Medicine Board Passer 2023</p>
                                <div class="flex items-center mt-1">
                                    <i class="fas fa-medal text-yellow-400 text-xs mr-1"></i>
                                    <span class="text-purple-300 text-xs font-semibold">Top 10% Scorer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 testimonial-card">
                        <!-- Quote Icon -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-indigo-400/30 to-purple-400/30 rounded-full flex items-center justify-center">
                                <i class="fas fa-quote-left text-white text-xl"></i>
                            </div>
                            <div class="flex space-x-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                            </div>
                        </div>
                        
                        <!-- Testimonial Text -->
                        <p class="text-indigo-100 leading-relaxed mb-8 text-lg italic">
                            "The quarterly plan gave me access to weekly Q&As that clarified my weakest areas. The abbreviations guide became my most used resource."
                        </p>
                        
                        <!-- Profile -->
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-3 border-white/30 mr-4">
                                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5a38ec0a-e87d-47a7-9de4-46edd7959476.png" alt="James Reyes" class="w-full h-full object-cover" />
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center border-2 border-white">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">James Reyes</h4>
                                <p class="text-indigo-200 text-sm">Nursing Board Passer 2022</p>
                                <div class="flex items-center mt-1">
                                    <i class="fas fa-award text-blue-400 text-xs mr-1"></i>
                                    <span class="text-indigo-300 text-xs font-semibold">First Time Passer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105 testimonial-card">
                        <!-- Quote Icon -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400/30 to-indigo-400/30 rounded-full flex items-center justify-center">
                                <i class="fas fa-quote-left text-white text-xl"></i>
                            </div>
                            <div class="flex space-x-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                            </div>
                        </div>
                        
                        <!-- Testimonial Text -->
                        <p class="text-indigo-100 leading-relaxed mb-8 text-lg italic">
                            "As a working reviewee, Achievia's flexible subscription allowed me to study efficiently. Their mock exams predicted the actual difficulty perfectly."
                        </p>
                        
                        <!-- Profile -->
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-3 border-white/30 mr-4">
                                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/db49aa52-48f9-45f7-8ad5-b04cf9b6ff91.png" alt="Andrea Lim" class="w-full h-full object-cover" />
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center border-2 border-white">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Andrea Lim</h4>
                                <p class="text-indigo-200 text-sm">Engineering Board Passer 2023</p>
                                <div class="flex items-center mt-1">
                                    <i class="fas fa-briefcase text-purple-400 text-xs mr-1"></i>
                                    <span class="text-purple-300 text-xs font-semibold">Working Professional</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced CTA -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="inline-flex items-center bg-white/10 hover:bg-white/20 text-white px-10 py-5 rounded-full font-semibold transition-all duration-300 backdrop-blur-lg border border-white/20 hover:scale-105 cursor-pointer group">
                    <i class="fas fa-book-open mr-3 text-purple-300 group-hover:animate-pulse"></i>
                    <span>Read more success stories</span>
                    <i class="fas fa-arrow-right ml-3 text-indigo-300 transform group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Ready to Achieve Board Success?</h2>
            <p class="text-xl text-indigo-100 max-w-3xl mx-auto mb-8">
                Join thousands of students who trusted Achievia for their board exam preparation
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#plans" class="bg-white hover:bg-gray-100 text-indigo-700 px-8 py-3 rounded-lg font-medium transition duration-300">
                    View Plans
                </a>
                <a href="#contact" class="border-2 border-white text-white hover:bg-indigo-600 px-8 py-3 rounded-lg font-medium transition duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-indigo-50 to-purple-50"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-20">
            <div class="absolute top-20 left-20 w-80 h-80 bg-gradient-to-r from-indigo-200 to-purple-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-gradient-to-r from-purple-200 to-indigo-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 4s;"></div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-32 right-32 text-indigo-300/30 animate-bounce" style="animation-delay: 1s;">
            <i class="fas fa-envelope text-4xl"></i>
        </div>
        <div class="absolute bottom-32 left-32 text-purple-300/30 animate-bounce" style="animation-delay: 3s;">
            <i class="fas fa-phone text-3xl"></i>
        </div>
        <div class="absolute top-1/4 right-1/4 text-indigo-300/30 animate-pulse" style="animation-delay: 2s;">
            <i class="fas fa-map-marker-alt text-2xl"></i>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-20" data-aos="fade-up">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mb-8 relative">
                    <i class="fas fa-comments text-white text-3xl"></i>
                    <div class="absolute -inset-2 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full animate-ping opacity-20"></div>
                </div>
                <h2 class="text-6xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-6">
                    Get In Touch
                </h2>
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-0.5 bg-gradient-to-r from-transparent to-indigo-400"></div>
                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-4 flex items-center justify-center">
                        <i class="fas fa-heart text-white text-sm"></i>
                    </div>
                    <div class="w-16 h-0.5 bg-gradient-to-r from-purple-400 to-transparent"></div>
                </div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Have questions about our review programs? Our dedicated team is ready to assist you on your journey to board exam success.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-16 items-start">
                <!-- Contact Information -->
                <div data-aos="fade-right">
                    <div class="space-y-8">
                        <!-- Email -->
                        <div class="group">
                            <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 border border-white/30 hover:bg-white/95 transition-all duration-500 hover:scale-105 hover:shadow-xl">
                                <div class="flex items-start">
                                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                        <i class="fas fa-envelope text-white text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition-colors">Email Us</h4>
                                        <p class="text-gray-600 mb-3">Get in touch via email for detailed inquiries</p>
                                        <a href="mailto:support@achievia.com" class="text-indigo-600 hover:text-purple-600 font-semibold text-lg transition-colors">
                                            support@achievia.com
                                        </a>
                                        <div class="mt-3 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>Response within 24 hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="group">
                            <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 border border-white/30 hover:bg-white/95 transition-all duration-500 hover:scale-105 hover:shadow-xl">
                                <div class="flex items-start">
                                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                        <i class="fas fa-phone text-white text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition-colors">Call Us</h4>
                                        <p class="text-gray-600 mb-3">Speak directly with our support team</p>
                                        <a href="tel:+6328123456" class="text-purple-600 hover:text-indigo-600 font-semibold text-lg transition-colors">
                                            +63 2 8123 4567
                                        </a>
                                        <div class="mt-3 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>Mon-Fri 9AM-6PM (PHT)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div class="group">
                            <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 border border-white/30 hover:bg-white/95 transition-all duration-500 hover:scale-105 hover:shadow-xl">
                                <div class="flex items-start">
                                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition-colors">Visit Us</h4>
                                        <p class="text-gray-600 mb-3">Come see us at our main office</p>
                                        <p class="text-gray-700 font-medium text-lg">
                                            12th Floor, Achievia Tower<br>
                                            Manila, Philippines
                                        </p>
                                        <div class="mt-3 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-directions mr-2"></i>
                                            <span>Near major transport hubs</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div data-aos="fade-left">
                    <div class="bg-white/90 backdrop-blur-lg rounded-3xl p-10 border border-white/30 shadow-2xl hover:shadow-3xl transition-all duration-500">
                        <div class="text-center mb-8">
                            <h3 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-3">Send us a message</h3>
                            <p class="text-gray-600">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                        </div>
                        
                        <form class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-gray-700 text-sm font-semibold mb-3">Your Name</label>
                                    <input type="text" id="name" class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 hover:border-indigo-300 bg-white/80 backdrop-blur-sm" placeholder="Enter your full name">
                                </div>
                                <div>
                                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-3">Email Address</label>
                                    <input type="email" id="email" class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 hover:border-indigo-300 bg-white/80 backdrop-blur-sm" placeholder="your.email@example.com">
                                </div>
                            </div>
                            
                            <div>
                                <label for="program" class="block text-gray-700 text-sm font-semibold mb-3">Program of Interest</label>
                                <select id="program" class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 hover:border-indigo-300 bg-white/80 backdrop-blur-sm">
                                    <option value="">Select a program</option>
                                    <option value="medicine">Medicine</option>
                                    <option value="nursing">Nursing</option>
                                    <option value="engineering">Engineering</option>
                                    <option value="accounting">Accounting</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="message" class="block text-gray-700 text-sm font-semibold mb-3">Message</label>
                                <textarea id="message" rows="5" class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 hover:border-indigo-300 bg-white/80 backdrop-blur-sm resize-none" placeholder="Tell us how we can help you achieve your board exam goals..."></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-bold py-5 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl relative overflow-hidden group text-lg">
                                <span class="relative z-10 flex items-center justify-center">
                                    <i class="fas fa-paper-plane mr-3"></i>
                                    Send Message
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
                            </button>
                        </form>
                        
                        <!-- Trust Indicators -->
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <div class="flex items-center justify-center space-x-8 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fas fa-shield-alt text-indigo-500 mr-2"></i>
                                    <span>Secure & Private</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-purple-500 mr-2"></i>
                                    <span>Quick Response</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-users text-indigo-500 mr-2"></i>
                                    <span>Expert Support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800 text-white overflow-hidden">
        <!-- Animated Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <!-- Floating Orbs -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <!-- Main Footer Content -->
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <!-- Brand Section -->
                <div data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Achievia Logo" class="h-12 w-auto mr-3">
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-white to-purple-200 bg-clip-text text-transparent">Achievia</h3>
                    </div>
                    <p class="text-indigo-200 mb-6 leading-relaxed">
                        The premier board exam review center transforming students into topnotchers since 2010.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:rotate-12 backdrop-blur-sm">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:rotate-12 backdrop-blur-sm">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:rotate-12 backdrop-blur-sm">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:rotate-12 backdrop-blur-sm">
                            <i class="fab fa-linkedin-in text-white"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-lg font-bold mb-6 flex items-center">
                        <span class="w-8 h-0.5 bg-gradient-to-r from-purple-400 to-transparent mr-3"></span>
                        Quick Links
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#features" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Features
                            </a>
                        </li>
                        <li>
                            <a href="#reviews" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Success Stories
                            </a>
                        </li>
                        <li>
                            <a href="#plans" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Pricing
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Programs -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-lg font-bold mb-6 flex items-center">
                        <span class="w-8 h-0.5 bg-gradient-to-r from-purple-400 to-transparent mr-3"></span>
                        Programs
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Medicine
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Nursing
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Engineering
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-indigo-200 hover:text-white transition-all duration-300 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 transform group-hover:translate-x-1 transition-transform"></i>
                                Accountancy
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Newsletter -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <h4 class="text-lg font-bold mb-6 flex items-center">
                        <span class="w-8 h-0.5 bg-gradient-to-r from-purple-400 to-transparent mr-3"></span>
                        Stay Updated
                    </h4>
                    <p class="text-indigo-200 mb-4 text-sm">Subscribe to get the latest updates and study tips.</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Your email" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-indigo-300 focus:outline-none focus:ring-2 focus:ring-purple-400 backdrop-blur-sm transition-all duration-300">
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white px-4 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-paper-plane mr-2"></i>Subscribe
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-white/10 pt-8" data-aos="fade-up" data-aos-delay="400">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-indigo-200 text-sm">
                        © 2024 Achievia Review Center. All rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-indigo-200 hover:text-white transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="text-indigo-200 hover:text-white transition-colors duration-300">Terms of Service</a>
                        <a href="#" class="text-indigo-200 hover:text-white transition-colors duration-300">Contact Us</a>
                    </div>
                </div>
            </div>
            
            <!-- Back to Top Button -->
            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center justify-center w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm transition-all duration-300 hover:scale-110 group">
                    <i class="fas fa-arrow-up text-white transform group-hover:-translate-y-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Mobile menu toggle
        document.getElementById('menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation for stats
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
                const increment = target / 100;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = counter.textContent.replace(/\d+/, target);
                        clearInterval(timer);
                    } else {
                        counter.textContent = counter.textContent.replace(/\d+/, Math.floor(current));
                    }
                }, 20);
            });
        }

        // Trigger counter animation when stats come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stat-number');
        if (statsSection) {
            observer.observe(statsSection.parentElement);
        }

        // Parallax effect for floating elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.float-animation');
            
            parallaxElements.forEach(element => {
                const speed = 0.5;
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Add loading animation
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>

