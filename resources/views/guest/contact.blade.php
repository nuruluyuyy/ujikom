@extends('layouts.public')

@section('content')
<style>
    /* Futuristic Form Animations */
    .form-input-wrapper {
        position: relative;
    }
    
    .form-input-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 0.75rem;
        padding: 2px;
        background: linear-gradient(45deg, #06b6d4, #14b8a6, #3b82f6);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .form-input-wrapper:focus-within::before {
        opacity: 1;
        animation: borderGlow 2s linear infinite;
    }
    
    @keyframes borderGlow {
        0% { filter: hue-rotate(0deg); }
        100% { filter: hue-rotate(360deg); }
    }
    
    /* Interactive Card Hover */
    .interactive-card {
        position: relative;
        transition: transform 0.3s ease;
    }
    
    .interactive-card::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #06b6d4, #14b8a6);
        border-radius: inherit;
        opacity: 0;
        z-index: -1;
        filter: blur(15px);
        transition: opacity 0.3s ease;
    }
    
    .interactive-card:hover::before {
        opacity: 0.6;
    }
    
    .interactive-card:hover {
        transform: translateY(-5px);
    }
    
    /* Pulse Effect */
    .pulse-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 2px solid #06b6d4;
        border-radius: 50%;
        animation: pulseRing 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
    }
    
    @keyframes pulseRing {
        0% {
            transform: scale(0.8);
            opacity: 1;
        }
        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }
    
    /* Floating Icons */
    .float-icon {
        animation: floatIcon 3s ease-in-out infinite;
    }
    
    @keyframes floatIcon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    /* Submit Button Wave */
    .btn-wave {
        position: relative;
        overflow: hidden;
    }
    
    .btn-wave::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-wave:hover::before {
        left: 100%;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 py-16 px-6">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-16 scroll-reveal">
            <div class="inline-block mb-6">
                <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center shadow-2xl float-gentle overflow-hidden p-2">
                    <img src="{{ asset('images/logo smkn 4.png') }}" alt="SMKN 4 Bogor" class="w-full h-full object-contain">
                </div>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-4 text-gradient-animate tracking-tight">
                Hubungi Kami
            </h1>
            <p class="text-xl text-gray-600 font-medium">Kami siap membantu Anda</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 mb-16">
            
            <!-- Contact Form -->
            <div class="scroll-reveal-left">
                <div class="bg-white rounded-3xl p-8 shadow-xl card-shine">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                        <span class="text-3xl">✉️</span>
                        Kirim Pesan
                    </h2>

                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl">
                            <p class="font-semibold">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('guest.contact.submit') }}" method="POST" class="space-y-5" id="contactForm">
                        @csrf
                        
                        <div class="form-input-wrapper">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-cyan-500 float-icon">👤</span> Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:border-transparent transition-all hover:border-cyan-300 relative z-10 bg-white"
                                   placeholder="Masukkan nama Anda">
                        </div>

                        <div class="form-input-wrapper">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-cyan-500 float-icon" style="animation-delay: 0.2s;">✉️</span> Email
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:border-transparent transition-all hover:border-cyan-300 relative z-10 bg-white"
                                   placeholder="email@example.com">
                        </div>

                        <div class="form-input-wrapper">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-cyan-500 float-icon" style="animation-delay: 0.4s;">📝</span> Subjek
                            </label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:border-transparent transition-all hover:border-cyan-300 relative z-10 bg-white"
                                   placeholder="Perihal pesan Anda">
                        </div>

                        <div class="form-input-wrapper">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-cyan-500 float-icon" style="animation-delay: 0.6s;">💬</span> Pesan
                            </label>
                            <textarea name="message" rows="5" required
                                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:ring-0 focus:border-transparent transition-all resize-none hover:border-cyan-300 relative z-10 bg-white"
                                      placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400 z-20" id="charCount">0 / 500</div>
                        </div>

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-bold py-4 px-6 rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 btn-wave relative overflow-hidden group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <span>Kirim Pesan</span>
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </span>
                        </button>
                    </form>

                    <script>
                        // Character counter
                        const textarea = document.querySelector('textarea[name="message"]');
                        const charCount = document.getElementById('charCount');
                        if (textarea && charCount) {
                            textarea.addEventListener('input', function() {
                                const count = this.value.length;
                                charCount.textContent = count + ' / 500';
                                if (count > 450) {
                                    charCount.classList.add('text-red-500');
                                } else {
                                    charCount.classList.remove('text-red-500');
                                }
                            });
                        }
                    </script>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="scroll-reveal-right space-y-6">
                
                <!-- Info Cards -->
                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl text-white">📍</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 mb-2">Alamat</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $contactInfo['address'] }}<br>{{ $contactInfo['city'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📞</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 mb-2">Telepon & WhatsApp</h3>
                            <p class="text-gray-600">Telepon: {{ $contactInfo['phone'] }}</p>
                            <p class="text-gray-600">WhatsApp: {{ $contactInfo['whatsapp'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">✉️</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 mb-2">Email & Website</h3>
                            <p class="text-gray-600">{{ $contactInfo['email'] }}</p>
                            <p class="text-gray-600">{{ $contactInfo['website'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">🕐</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 mb-3">Jam Operasional</h3>
                            @foreach($contactInfo['operating_hours'] as $day => $time)
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">{{ $day }}</span>
                                    <span class="text-gray-800 font-semibold">{{ $time }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Google Maps -->
        <div class="scroll-reveal scroll-reveal-scale">
            <div class="bg-white rounded-3xl p-4 shadow-xl overflow-hidden">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 px-4 pt-2 flex items-center gap-3">
                    <span class="text-3xl">🗺️</span>
                    Lokasi Kami
                </h2>
                <div class="rounded-2xl overflow-hidden">
                    <iframe 
                        src="{{ $contactInfo['map_embed'] }}"
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="mt-16 scroll-reveal">
            <div class="bg-gradient-to-br from-cyan-500 to-teal-500 rounded-3xl p-8 shadow-2xl text-white text-center">
                <h2 class="text-3xl font-bold mb-4">Ikuti Kami</h2>
                <p class="text-cyan-50 mb-8">Dapatkan update terbaru dari media sosial kami</p>
                <div class="flex justify-center gap-6 flex-wrap">
                    <!-- YouTube -->
                    <a href="https://www.youtube.com/@smknegeri4bogor905" target="_blank" 
                       class="group relative w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-500 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="https://www.google.com/s2/favicons?domain=youtube.com&sz=48" alt="YouTube" class="w-5 h-5 group-hover:invert transition-all duration-300">
                    </a>

                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@smkn4kotabogor" target="_blank" 
                       class="group relative w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-black opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="https://www.google.com/s2/favicons?domain=tiktok.com&sz=48" alt="TikTok" class="w-5 h-5 group-hover:invert transition-all duration-300">
                    </a>
                    
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/smkn4kotabogor" target="_blank" 
                       class="group relative w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="https://www.google.com/s2/favicons?domain=instagram.com&sz=48" alt="Instagram" class="w-5 h-5 group-hover:invert transition-all duration-300">
                    </a>
                    
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/smkn4kotabogor" target="_blank" 
                       class="group relative w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="https://www.google.com/s2/favicons?domain=facebook.com&sz=48" alt="Facebook" class="w-5 h-5 group-hover:invert transition-all duration-300">
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
