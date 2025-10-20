<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Portal Berita Perusahaan')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS if needed -->
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold text-gray-800">Portal Berita</h1>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('news.index') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                            Beranda
                        </a>
                        <a href="{{ route('news.index') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                            Berita
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                            Profil Perusahaan
                        </a>
                    </div>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center space-x-4">
                            <!-- User info if logged in -->
                            @auth
                                <span class="text-gray-700 text-sm">{{ auth()->user()->nip ?? 'User' }}</span>
                                <a href="{{ route('news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                    Tulis Berita
                                </a>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-gray-700 text-sm">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 text-sm">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- Page Header -->
        @hasSection('header')
            <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </div>
        @endif

        <!-- Content -->
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-8 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Portal Berita Perusahaan</h3>
                    <p class="text-gray-300 text-sm">
                        Portal informasi dan berita terkini dari perusahaan untuk seluruh karyawan.
                    </p>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('news.index') }}" class="text-gray-300 hover:text-white">Berita</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Profil Perusahaan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Kontak</h4>
                    <p class="text-gray-300 text-sm">
                        Email: info@perusahaan.com<br>
                        Tel: (021) 123-4567
                    </p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300 text-sm">&copy; {{ date('Y') }} Portal Berita Perusahaan. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    @stack('scripts')
</body>
</html>
