<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = [
            'school_name' => 'SMKN 4 Bogor',
            'address' => 'Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan',
            'city' => 'Bogor, Jawa Barat 16137',
            'phone' => '(0251) 1234567',
            'whatsapp' => '081234567890',
            'email' => 'info@smkn4bogor.sch.id',
            'website' => 'www.smkn4bogor.sch.id',
            'social_media' => [
                'facebook' => 'https://facebook.com/smkn4bogor',
                'instagram' => 'https://instagram.com/smkn4bogor',
                'youtube' => 'https://youtube.com/@smkn4bogor',
                'twitter' => 'https://twitter.com/smkn4bogor'
            ],
            'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.2!2d106.8!3d-6.6!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzYnMDAuMCJTIDEwNsKwNDgnMDAuMCJF!5e0!3m2!1sen!2sid!4v1234567890!5m2!1sen!2sid',
            'operating_hours' => [
                'Senin - Jumat' => '07:00 - 16:00 WIB',
                'Sabtu' => '07:00 - 12:00 WIB',
                'Minggu' => 'Libur'
            ]
        ];

        return view('guest.contact', compact('contactInfo'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:500'
        ]);

        // Simpan pesan ke database
        ContactMessage::create($validated);

        // Optional: Kirim notifikasi ke admin (bisa pakai email atau notification)
        // Notification::send($admins, new NewContactMessage($contactMessage));

        return back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
