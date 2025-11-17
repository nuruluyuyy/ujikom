@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12 scroll-reveal">
            <h1 class="text-4xl md:text-5xl font-bold mb-3 text-gradient-animate tracking-tight">
                Berita & Agenda
            </h1>
            <p class="text-gray-700 text-base md:text-lg font-medium">Informasi terkini dan jadwal kegiatan SMKN 4 Bogor 📰</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left: Berita (2 kolom) -->
            <div class="lg:col-span-2 space-y-8">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-8 bg-gradient-to-b from-cyan-500 to-teal-500 rounded-full"></span>
                    Berita Terbaru
                </h2>

                @if($news->count() > 0)
                    <div class="space-y-6">
                        @foreach($news as $item)
                            <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all overflow-hidden group">
                                <div class="grid md:grid-cols-3 gap-6">
                                    <!-- Image -->
                                    @if($item->image)
                                        <div class="md:col-span-1 relative overflow-hidden h-64 md:h-auto">
                                            <img src="{{ asset('storage/' . $item->image) }}" 
                                                 alt="{{ $item->title }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        </div>
                                    @endif
                                    
                                    <!-- Content -->
                                    <div class="{{ $item->image ? 'md:col-span-2' : 'md:col-span-3' }} p-6">
                                        <div class="flex items-center gap-3 mb-3">
                                            <span class="px-3 py-1 bg-cyan-100 text-cyan-700 text-xs font-semibold rounded-full">
                                                {{ ucfirst($item->category) }}
                                            </span>
                                            <span class="text-sm text-gray-500">
                                                📅 {{ $item->published_date->format('d M Y') }}
                                            </span>
                                        </div>
                                        
                                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-cyan-600 transition-colors">
                                            {{ $item->title }}
                                        </h3>
                                        
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                            {{ Str::limit(strip_tags($item->content), 150) }}
                                        </p>
                                        
                                        <a href="{{ route('guest.news.show', $item->slug) }}" 
                                           class="inline-flex items-center gap-2 text-cyan-600 hover:text-cyan-700 font-semibold text-sm">
                                            Baca Selengkapnya
                                            <span>→</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                        <div class="text-6xl mb-4">📰</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Berita</h3>
                        <p class="text-gray-600">Belum ada berita yang dipublikasikan</p>
                    </div>
                @endif
            </div>

            <!-- Right: Agenda Sidebar (1 kolom) -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Ongoing Agendas -->
                @if($ongoingAgendas->count() > 0)
                    <div class="bg-white rounded-3xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <span class="text-2xl">🔴</span>
                            Sedang Berlangsung
                        </h3>
                        <div class="space-y-4">
                            @foreach($ongoingAgendas as $agenda)
                                <div class="border-l-4 border-green-500 pl-4 py-2">
                                    <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $agenda->title }}</h4>
                                    <div class="text-xs text-gray-600 space-y-1">
                                        <div class="flex items-center gap-1">
                                            <span>📅</span>
                                            <span>{{ $agenda->start_date->format('d M') }} - {{ $agenda->end_date->format('d M Y') }}</span>
                                        </div>
                                        @if($agenda->location)
                                            <div class="flex items-center gap-1">
                                                <span>📍</span>
                                                <span>{{ $agenda->location }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Upcoming Agendas -->
                <div class="bg-white rounded-3xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="text-2xl">📅</span>
                        Agenda Mendatang
                    </h3>
                    
                    @if($upcomingAgendas->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingAgendas as $agenda)
                                <div class="border-l-4 border-cyan-500 pl-4 py-2">
                                    <h4 class="font-bold text-gray-800 text-sm mb-1">{{ $agenda->title }}</h4>
                                    <div class="text-xs text-gray-600 space-y-1">
                                        <div class="flex items-center gap-1">
                                            <span>📅</span>
                                            <span>
                                                @if($agenda->start_date->format('Y-m-d') == $agenda->end_date->format('Y-m-d'))
                                                    {{ $agenda->start_date->format('d M Y') }}
                                                @else
                                                    {{ $agenda->start_date->format('d M') }} - {{ $agenda->end_date->format('d M Y') }}
                                                @endif
                                            </span>
                                        </div>
                                        @if($agenda->start_time)
                                            <div class="flex items-center gap-1">
                                                <span>🕐</span>
                                                <span>{{ $agenda->start_time }}</span>
                                            </div>
                                        @endif
                                        @if($agenda->location)
                                            <div class="flex items-center gap-1">
                                                <span>📍</span>
                                                <span>{{ $agenda->location }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm text-center py-4">Tidak ada agenda mendatang</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
