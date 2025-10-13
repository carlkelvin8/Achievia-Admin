<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achievia - Premium Board Exam Review Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .plan-card:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Navigation -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Achievia Logo" class="h-10 w-auto">
                    <span class="ml-2 text-2xl font-bold text-indigo-600 hidden sm:inline">Achievia</span>
                </a>
            </div>
            
            <!-- Desktop Nav Links -->
            <div class="hidden md:flex space-x-8">
                <a href="#features" class="text-gray-700 hover:text-indigo-600">Features</a>
                <a href="#reviews" class="text-gray-700 hover:text-indigo-600">Reviews</a>
                <a href="#plans" class="text-gray-700 hover:text-indigo-600">Plans</a>
                <a href="#contact" class="text-gray-700 hover:text-indigo-600">Contact</a>
            </div>

            <!-- Mobile Toggle -->
            <div class="md:hidden">
                <button id="menu-btn" class="text-gray-500 focus:outline-none">
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
    <div id="mobile-menu" class="hidden md:hidden bg-white pb-3 px-4">
        <a href="#features" class="block py-2 text-gray-700 hover:text-indigo-600">Features</a>
        <a href="#reviews" class="block py-2 text-gray-700 hover:text-indigo-600">Reviews</a>
        <a href="#plans" class="block py-2 text-gray-700 hover:text-indigo-600">Plans</a>
        <a href="#contact" class="block py-2 text-gray-700 hover:text-indigo-600">Contact</a>
        <a href="#login" class="block py-2 text-indigo-600 font-medium">Login</a>
    </div>
</nav>

    <!-- Hero Section -->
    <section class="hero-gradient">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        <span class="gradient-text">Ace Your Boards</span> With Achievia's Premium Review
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Subscription-based access to top-tier board exam preparation materials, mnemonics, and expert reviewers.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#plans" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300">
                            Get Started
                        </a>
                        <a href="#features" class="border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50 px-6 py-3 rounded-lg font-medium transition duration-300">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b3f64c88-1ee7-4654-acf8-958b9ad51e15.png" alt="Diverse group of medical students studying together in modern library with laptops and textbooks" class="rounded-xl shadow-xl" />
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Comprehensive Review System</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Achievia combines proven methodologies with innovative learning techniques
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg feature-card transition duration-300">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Flexible Subscription</h3>
                    <p class="text-gray-600">
                        Access premium content monthly, quarterly or annually with our flexible subscription plans.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg feature-card transition duration-300">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Certified Reviewers</h3>
                    <p class="text-gray-600">
                        Learn from top-rated reviewers who consistently produce board passers with their proven techniques.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg feature-card transition duration-300">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Effective Mnemonics</h3>
                    <p class="text-gray-600">
                        Master complex concepts faster with our scientifically-designed mnemonics and memory aids.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg feature-card transition duration-300">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Comprehensive Abbreviations</h3>
                    <p class="text-gray-600">
                        All key abbreviations and terminologies consolidated in easy-to-digest formats.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Supplemental Materials Section -->
    <section class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b4220a0f-3a82-4fe4-a617-05429ec44afd.png" alt="Detailed medical textbooks with highlighted sections and handwritten notes arranged neatly" class="rounded-xl shadow-lg" />
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Premium Supplemental Materials</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Our supplementals go beyond standard review materials to provide the competitive edge you need.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Updated board-style questions with detailed explanations</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Condensed notes for last-minute review</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">High-yield clinical case scenarios</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-3 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-700">Visual aids and infographics for complex topics</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="plans" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Flexible Subscription Plans</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose the plan that fits your study timeline and budget
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Monthly Plan -->
                <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden plan-card transition duration-300">
                    <div class="px-6 py-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Monthly</h3>
                        <p class="text-gray-600 mb-6">Perfect for quick review sessions</p>
                        <div class="flex items-end mb-6">
                            <span class="text-4xl font-bold text-gray-800">₱2,499</span>
                            <span class="text-gray-500 ml-1">/month</span>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">All basic reviewers</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Monthly updated materials</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Basic mnemonics</span>
                            </li>
                        </ul>
                        <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition duration-300">
                            Choose Plan
                        </button>
                    </div>
                </div>

                <!-- Quarterly Plan -->
                <div class="bg-indigo-50 rounded-xl shadow-xl overflow-hidden plan-card transition duration-300 border-2 border-indigo-200 transform -translate-y-2">
                    <div class="bg-indigo-600 text-white text-center py-2 px-6">
                        <span class="font-medium">Most Popular</span>
                    </div>
                    <div class="px-6 py-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Quarterly</h3>
                        <p class="text-gray-600 mb-6">Best value for comprehensive review</p>
                        <div class="flex items-end mb-6">
                            <span class="text-4xl font-bold text-gray-800">₱6,599</span>
                            <span class="text-gray-500 ml-1">/quarter</span>
                        </div>
                        <div class="text-sm text-indigo-600 font-medium mb-2">Save 12% vs monthly</div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Everything in Monthly</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Advanced mnemonics</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Premium supplementals</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Weekly live Q&A sessions</span>
                            </li>
                        </ul>
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300">
                            Choose Plan
                        </button>
                    </div>
                </div>

                <!-- Annual Plan -->
                <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden plan-card transition duration-300">
                    <div class="px-6 py-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Annual</h3>
                        <p class="text-gray-600 mb-6">For complete exam preparation cycle</p>
                        <div class="flex items-end mb-6">
                            <span class="text-4xl font-bold text-gray-800">₱22,999</span>
                            <span class="text-gray-500 ml-1">/year</span>
                        </div>
                        <div class="text-sm text-indigo-600 font-medium mb-2">Save 23% vs monthly</div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Everything in Quarterly</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Personalized study plan</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Two mock board exams</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Priority support</span>
                            </li>
                        </ul>
                        <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition duration-300">
                            Choose Plan
                        </button>
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


    <!-- Mission & Vision Section (Premium Design) -->
<section class="py-24 bg-gradient-to-b from-white to-indigo-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-4xl font-bold text-indigo-800 mb-4">Mission & Vision</h2>
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

<!-- Mission, Vision, and Core Values Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

     

        <!-- Core Values -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-indigo-700 mb-10">Our Core Values</h2>
            <div class="grid md:grid-cols-4 gap-8 text-left text-gray-700">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">A — Aspiration</h3>
                    <p>Achieve by setting high goals and dreaming beyond limits.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">C — Commitment</h3>
                    <p>Achieve through consistent effort and dedication to learning.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">H — Honesty</h3>
                    <p>Achieve with truthfulness, integrity, and trust in every action.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">I — Innovation</h3>
                    <p>Achieve through creative thinking and modern learning approaches.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">E — Excellence</h3>
                    <p>Achieve by striving for the highest quality in all we do.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">V — Values</h3>
                    <p>Achieve by learning with purpose, guided by strong principles.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">I — Inclusivity</h3>
                    <p>Achieve by embracing diversity and ensuring equal opportunity.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">A — Achievement</h3>
                    <p>Achieve by celebrating every milestone toward success.</p>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- About the Authors -->
<section class="py-20 bg-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Meet the Achievia Authors</h2>
    <p class="text-gray-600 text-lg max-w-3xl mx-auto mb-12">
      A diverse team of expert reviewers and educators powering your board exam success.
    </p>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
      <!-- Author 1 -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/author1.png" alt="Angela Cortez" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-indigo-500">
        <h4 class="text-xl font-semibold text-gray-800">Dr. Angela Cortez</h4>
        <p class="text-sm text-gray-500 mb-3">Medical Topnotcher & Reviewer</p>
        <p class="text-sm text-gray-600 mb-4">
          Dr. Cortez believes in accessible, high-quality education for all. She brings academic rigor and compassion to every learning module.
        </p>
        <div class="flex justify-center gap-4 text-indigo-600">
          <a href="#"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.23 5.924a8.356 8.356 0 01-2.357.646 4.093 4.093 0 001.804-2.27 8.19 8.19 0 01-2.605.992 4.097 4.097 0 00-6.981 3.735A11.622 11.622 0 013.17 4.883a4.086 4.086 0 001.268 5.462 4.073 4.073 0 01-1.857-.512v.052a4.098 4.098 0 003.29 4.014 4.1 4.1 0 01-1.852.07 4.1 4.1 0 003.834 2.85A8.216 8.216 0 012 19.54 11.616 11.616 0 008.29 21c7.547 0 11.675-6.253 11.675-11.675 0-.177-.004-.354-.012-.53A8.344 8.344 0 0022.23 5.924z"/></svg></a>
        </div>
      </div>

      <!-- Author 2 -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/author2.png" alt="Carlo Mendoza" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-indigo-500">
        <h4 class="text-xl font-semibold text-gray-800">Engr. Carlo Mendoza</h4>
        <p class="text-sm text-gray-500 mb-3">Engineering Reviewer</p>
        <p class="text-sm text-gray-600 mb-4">
          A professional engineer who mentors future engineers through structured review plans and practical drills based on actual board trends.
        </p>
        <div class="flex justify-center gap-4 text-indigo-600">
          <a href="#"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">...</svg></a>
        </div>
      </div>

      <!-- Author 3 -->
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/author3.png" alt="Lea Ramos" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-indigo-500">
        <h4 class="text-xl font-semibold text-gray-800">Prof. Lea Ramos</h4>
        <p class="text-sm text-gray-500 mb-3">Nursing Content Strategist</p>
        <p class="text-sm text-gray-600 mb-4">
          Prof. Lea ensures our nursing review paths are evidence-based, updated, and aligned with modern clinical frameworks.
        </p>
        <div class="flex justify-center gap-4 text-indigo-600">
          <a href="#"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">...</svg></a>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Testimonials -->
    <section id="reviews" class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Successful Board Passers</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Join thousands who achieved board success with Achievia
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 mr-4">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/651a5eea-5969-42a2-a2ab-eaf08a70d792.png" alt="Smiling female medical graduate in white coat holding diploma" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Maria Santos</h4>
                            <p class="text-gray-500 text-sm">Medicine Board Passer 2023</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">
                        "Achievia's mnemonics made memorizing complex medical concepts effortless. The premium supplementals were exactly what I needed to score in the top 10%."
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 mr-4">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5a38ec0a-e87d-47a7-9de4-46edd7959476.png" alt="Confident male nursing graduate in scrubs celebrating with stethoscope" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">James Reyes</h4>
                            <p class="text-gray-500 text-sm">Nursing Board Passer 2022</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">
                        "The quarterly plan gave me access to weekly Q&As that clarified my weakest areas. The abbreviations guide became my most used resource."
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 mr-4">
                            <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/db49aa52-48f9-45f7-8ad5-b04cf9b6ff91.png" alt="Serious female engineering graduate pointing at architectural plans" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Andrea Lim</h4>
                            <p class="text-gray-500 text-sm">Engineering Board Passer 2023</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">
                        "As a working reviewee, Achievia's flexible subscription allowed me to study efficiently. Their mock exams predicted the actual difficulty perfectly."
                    </p>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    Read more success stories →
                </a>
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
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Get In Touch</h2>
                    <p class="text-gray-600 mb-8">
                        Have questions about our review programs? Our team is ready to assist you.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-1">Email Us</h4>
                                <p class="text-gray-600">support@achievia.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-1">Call Us</h4>
                                <p class="text-gray-600">+63 2 8123 4567</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 mb-1">Visit Us</h4>
                                <p class="text-gray-600">12th Floor, Achievia Tower, Manila, Philippines</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <h3 class="text-xl font-medium text-gray-800 mb-6">Send us a message</h3>
                        <form>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Your Name</label>
                                <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email Address</label>
                                <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label for="program" class="block text-gray-700 text-sm font-medium mb-2">Program of Interest</label>
                                <select id="program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select a program</option>
                                    <option value="medicine">Medicine</option>
                                    <option value="nursing">Nursing</option>
                                    <option value="engineering">Engineering</option>
                                    <option value="accounting">Accounting</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 text-sm font-medium mb-2">Message</label>
                                <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Achievia</h3>
                    <p class="text-gray-400">
                        The premier board exam review center transforming students into topnotchers since 2010.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Features</a></li>
                        <li><a href="#reviews" class="text-gray-400 hover:text-white transition">Success Stories</a></li>
                        <li><a href="#plans" class="text-gray-400 hover:text-white transition">Pricing</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Programs</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Medicine</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Nursing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Engineering</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Accountancy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>© 2023 Achievia Review Center. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>

