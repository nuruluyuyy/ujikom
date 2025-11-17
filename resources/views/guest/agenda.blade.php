@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12 scroll-reveal">
            <h1 class="text-4xl md:text-5xl font-bold mb-3 text-gradient-animate tracking-tight">
                Agenda Sekolah
            </h1>
            <p class="text-gray-700 text-base md:text-lg font-medium">Jadwal kegiatan dan acara SMKN 4 Bogor 📅</p>
        </div>

        <!-- Ongoing Agendas -->
        @if($ongoingAgendas->count() > 0)
            <div class="mb-12 scroll-reveal">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-8 bg-gradient-to-b from-green-500 to-teal-500 rounded-full"></span>
                    Sedang Berlangsung
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($ongoingAgendas as $agenda)
                        <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all overflow-hidden border-l-4 border-green-500">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $agenda->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-3">{{ $agenda->description }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full whitespace-nowrap ml-2">
                                        Berlangsung
                                    </span>
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <span>📅</span>
                                        <span>{{ $agenda->start_date->format('d M Y') }} - {{ $agenda->end_date->format('d M Y') }}</span>
                                    </div>
                                    @if($agenda->start_time)
                                        <div class="flex items-center gap-2">
                                            <span>🕐</span>
                                            <span>{{ $agenda->start_time }} - {{ $agenda->end_time ?? 'Selesai' }}</span>
                                        </div>
                                    @endif
                                    @if($agenda->location)
                                        <div class="flex items-center gap-2">
                                            <span>📍</span>
                                            <span>{{ $agenda->location }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Upcoming Agendas -->
        <div class="scroll-reveal scroll-reveal-delay-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-8 bg-gradient-to-b from-cyan-500 to-teal-500 rounded-full"></span>
                Akan Datang
            </h2>
            
            @if($upcomingAgendas->count() > 0)
                <div class="space-y-6">
                    @foreach($upcomingAgendas as $agenda)
                        <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all overflow-hidden border-l-4 border-cyan-500">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $agenda->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-3">{{ $agenda->description }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full whitespace-nowrap ml-2">
                                        Akan Datang
                                    </span>
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <span>📅</span>
                                        <span>
                                            @if($agenda->start_date->format('Y-m-d') == $agenda->end_date->format('Y-m-d'))
                                                {{ $agenda->start_date->format('d M Y') }}
                                            @else
                                                {{ $agenda->start_date->format('d M Y') }} - {{ $agenda->end_date->format('d M Y') }}
                                            @endif
                                        </span>
                                    </div>
                                    @if($agenda->start_time)
                                        <div class="flex items-center gap-2">
                                            <span>🕐</span>
                                            <span>{{ $agenda->start_time }} @if($agenda->end_time) - {{ $agenda->end_time }} @endif</span>
                                        </div>
                                    @endif
                                    @if($agenda->location)
                                        <div class="flex items-center gap-2">
                                            <span>📍</span>
                                            <span>{{ $agenda->location }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                    <div class="text-6xl mb-4">📅</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Agenda</h3>
                    <p class="text-gray-600">Tidak ada agenda yang akan datang saat ini</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
