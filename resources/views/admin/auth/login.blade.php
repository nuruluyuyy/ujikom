<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        }
        .login-bg {
            background: url('https://source.unsplash.com/random/1200x800/?school,education') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .login-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(37, 99, 235, 0.7);
            border-radius: 1rem 0 0 1rem;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="container mx-auto max-w-5xl">
        <div class="grid grid-cols-1 md:grid-cols-2 overflow-hidden rounded-xl shadow-2xl">
            <!-- Left Side - Login Form -->
            <div class="p-8 md:p-12 login-card">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-gray-800">Admin Panel</h1>
                    <p class="text-gray-600 mt-2">Masuk untuk mengakses dashboard</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                        <p class="font-bold">Gagal Masuk</p>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="admin@example.com" value="{{ old('email') }}">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lupa password?</a>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                        Masuk
                    </button>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600">
                    <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </div>

            <!-- Right Side - Image/Content -->
            <div class="hidden md:flex flex-col items-center justify-center p-12 text-white login-bg relative">
                <div class="relative z-10 text-center">
                    <h2 class="text-4xl font-bold mb-4">Selamat Datang Kembali!</h2>
                    <p class="text-blue-100 text-lg mb-8">Masuk untuk mengelola konten dan pengaturan website.</p>
                    <div class="w-20 h-1 bg-blue-300 mx-auto mb-8"></div>
                    <div class="space-y-4 text-left max-w-xs mx-auto">
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-blue-200 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Kelola konten dengan mudah</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-blue-200 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Pantau aktivitas pengguna</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-blue-200 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Keamanan terjamin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
