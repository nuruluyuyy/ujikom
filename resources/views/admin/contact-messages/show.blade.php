@extends('layouts.admin')

@section('content')
<div class="container mx-auto max-w-4xl">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.contact-messages.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-all">
            ← Kembali
        </a>
    </div>

    <!-- Message Card -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white p-8">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $message->subject }}</h1>
                    <div class="flex items-center gap-4 text-cyan-50">
                        <span class="flex items-center gap-2">
                            <span>👤</span> {{ $message->name }}
                        </span>
                        <span class="flex items-center gap-2">
                            <span>✉️</span> {{ $message->email }}
                        </span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-cyan-100 mb-1">Diterima pada</div>
                    <div class="font-semibold">{{ $message->created_at->format('d M Y') }}</div>
                    <div class="text-sm">{{ $message->created_at->format('H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- Message Content -->
        <div class="p-8">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <span class="text-2xl">💬</span> Isi Pesan
            </h2>
            <div class="bg-gray-50 rounded-2xl p-6 border-l-4 border-cyan-500">
                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="px-8 pb-8 flex gap-4">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
               class="flex-1 px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white rounded-xl font-semibold text-center transition-all hover:scale-105 shadow-lg">
                📧 Balas via Email
            </a>
            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus pesan ini?')"
                  class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold transition-all hover:scale-105 shadow-lg">
                    🗑️ Hapus Pesan
                </button>
            </form>
        </div>

        <!-- Info Footer -->
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <div>
                    Status: 
                    @if($message->is_read)
                        <span class="text-green-600 font-semibold">✓ Sudah Dibaca</span>
                    @else
                        <span class="text-cyan-600 font-semibold">● Baru Dibaca</span>
                    @endif
                </div>
                <div>
                    ID Pesan: #{{ $message->id }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
