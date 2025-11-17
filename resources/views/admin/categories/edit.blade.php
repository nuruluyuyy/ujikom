@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white/10 backdrop-blur-lg p-6 rounded-3xl shadow-2xl border border-white/20">
    <h1 class="text-2xl font-bold text-white mb-6">✏️ Edit Kategori</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $category->name }}"
               class="w-full px-4 py-2 rounded-xl bg-white/20 text-white placeholder-white/70 border border-white/30 focus:ring-2 focus:ring-[#0EA5E9]">
        <button type="submit"
                class="w-full px-5 py-2 rounded-xl bg-gradient-to-r from-[#0EA5E9] to-[#2563EB] text-white font-semibold hover:scale-105 transform transition">
            Perbarui
        </button>
    </form>
</div>
@endsection
