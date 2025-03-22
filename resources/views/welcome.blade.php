<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pharmacy Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Your fallback styles if needed */
            </style>
        @endif
    </head>
    <body class="font-sans antialiased bg-blue-50 text-gray-800">
        <div class="min-h-screen">
            <!-- Hero Section with Pharmacy Image Background -->
            <div class="relative bg-gradient-to-b from-blue-700 to-blue-500 text-white">
                <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1573883431205-98b5f10aaedb')] bg-cover bg-center"></div>
                <div class="relative max-w-7xl mx-auto px-6 py-16">
                    <header class="flex justify-between items-center py-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            <h1 class="ml-2 text-2xl font-bold">MedManager</h1>
                        </div>
                        
                        @if (Route::has('login'))
                            <nav class="flex items-center space-x-4">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 transition"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-4 py-2 border border-white text-white hover:bg-white hover:text-blue-600 transition"
                                    >
                                        Log in
                                    </a>
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <div class="mt-12 max-w-3xl">
                        <h2 class="text-4xl font-bold leading-tight">Streamlined Pharmacy Management for Administrators</h2>
                        <p class="mt-6 text-xl">Efficiently manage your pharmacy inventory, track medication expirations, and maintain detailed records of your pharmaceutical products.</p>
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="#features" class="px-6 py-3 border border-white text-white rounded-lg font-medium hover:bg-white hover:text-blue-600 transition">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="max-w-7xl mx-auto px-6 py-12">
                <div id="features" class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1: Admin Medicine Management -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:shadow-lg transition">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Inventory Management</h3>
                        <p class="mt-4 text-gray-600">
                            Easily add, update, and delete medicines from the inventory. Keep track of your stock levels and manage your pharmacy effectively.
                        </p>
                    </div>

                    <!-- Feature 2: Medicine Details -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:shadow-lg transition">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Medicine Details</h3>
                        <p class="mt-4 text-gray-600">
                            Maintain comprehensive information about each medication, including usage instructions, side effects, and storage requirements.
                        </p>
                    </div>

                    <!-- Feature 3: Expiration Tracking -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:shadow-lg transition">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Expiration Tracking</h3>
                        <p class="mt-4 text-gray-600">
                            Monitor medication expiration dates and receive alerts for products nearing expiration to ensure inventory freshness and compliance.
                        </p>
                    </div>
                </div>

                <!-- How It Works Section -->
                <div class="mt-20">
                    <h2 class="text-3xl font-bold text-center text-gray-900">How It Works</h2>
                    <div class="mt-12">
                        <!-- Admin Side -->
                        <div class="bg-white p-8 rounded-lg shadow-md border border-blue-100">
                            <h3 class="text-2xl font-semibold text-blue-600 mb-4">Administrator Dashboard</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 mr-3">1</span>
                                    <span>Log in with admin credentials to access the comprehensive dashboard</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 mr-3">2</span>
                                    <span>Manage medicines: add new products, update existing ones, or remove discontinued items</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 mr-3">3</span>
                                    <span>Track expiration dates and receive notifications for medications that are nearing expiry</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 mr-3">4</span>
                                    <span>Record detailed information including usage instructions, contraindications, and storage requirements</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 mr-3">5</span>
                                    <span>Generate reports on inventory status, expiring medications, and stock levels</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-blue-700 text-white">
                <div class="max-w-7xl mx-auto px-6 py-12">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="flex items-center mb-6 md:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            <span class="ml-2 text-xl font-semibold">MedManager</span>
                        </div>
                        <div class="text-sm opacity-80">
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>