<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $schoolInfo = [
            'name' => 'SMKN 4 Bogor',
            'full_name' => 'Sekolah Menengah Kejuruan Negeri 4 Bogor',
            'established' => '1985',
            'address' => 'Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan',
            'city' => 'Bogor, Jawa Barat',
            'phone' => '(0251) 1234567',
            'email' => 'info@smkn4bogor.sch.id',
            'website' => 'www.smkn4bogor.sch.id',
            'vision' => 'Menjadi SMK yang unggul, berkarakter, dan berwawasan lingkungan',
            'mission' => [
                'Menyelenggarakan pendidikan berbasis kompetensi dan karakter',
                'Mengembangkan pembelajaran yang inovatif dan kreatif',
                'Membangun kemitraan dengan dunia usaha dan industri',
                'Menciptakan lingkungan sekolah yang kondusif dan ramah lingkungan',
                'Menghasilkan lulusan yang kompeten dan siap kerja'
            ],
            'stats' => [
                'students' => 1250,
                'teachers' => 85,
                'majors' => 6,
                'achievements' => 150
            ]
        ];

        return view('guest.about', compact('schoolInfo'));
    }
}
