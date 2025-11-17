<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Agenda;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample News
        News::create([
            'title' => 'SMKN 4 Bogor Raih Juara 1 Lomba Kompetensi Siswa Tingkat Provinsi',
            'content' => 'SMKN 4 Bogor berhasil meraih juara 1 dalam Lomba Kompetensi Siswa (LKS) tingkat Provinsi Jawa Barat. Prestasi gemilang ini diraih oleh siswa jurusan Rekayasa Perangkat Lunak yang berhasil mengalahkan 50 sekolah lainnya. Tim yang terdiri dari 3 siswa terbaik berhasil menyelesaikan tantangan pemrograman dengan sempurna dan mendapat nilai tertinggi dari dewan juri. Kepala Sekolah menyampaikan apresiasi setinggi-tingginya kepada para siswa dan guru pembimbing yang telah berjuang keras mempersiapkan kompetisi ini.',
            'category' => 'prestasi',
            'status' => 'published',
            'published_date' => Carbon::now()->subDays(2),
        ]);

        News::create([
            'title' => 'Pelaksanaan Ujian Tengah Semester Ganjil Tahun Ajaran 2025/2026',
            'content' => 'Ujian Tengah Semester (UTS) Ganjil Tahun Ajaran 2025/2026 akan dilaksanakan mulai tanggal 15-20 Oktober 2025. Seluruh siswa diwajibkan hadir tepat waktu dan membawa perlengkapan ujian yang diperlukan. Jadwal ujian dapat dilihat di papan pengumuman sekolah atau melalui website resmi. Siswa diharapkan mempersiapkan diri dengan baik dan menjaga kesehatan agar dapat mengikuti ujian dengan optimal.',
            'category' => 'akademik',
            'status' => 'published',
            'published_date' => Carbon::now()->subDays(5),
        ]);

        News::create([
            'title' => 'Kegiatan Bakti Sosial SMKN 4 Bogor di Panti Asuhan',
            'content' => 'Siswa-siswi SMKN 4 Bogor mengadakan kegiatan bakti sosial di Panti Asuhan Kasih Sayang pada hari Minggu kemarin. Kegiatan ini diikuti oleh 50 siswa dan 10 guru pendamping. Mereka membawa bantuan berupa sembako, pakaian layak pakai, dan perlengkapan sekolah untuk anak-anak panti. Selain menyerahkan bantuan, siswa juga mengadakan games dan hiburan untuk menghibur anak-anak panti. Kegiatan ini merupakan bagian dari program kepedulian sosial sekolah.',
            'category' => 'kegiatan',
            'status' => 'published',
            'published_date' => Carbon::now()->subDays(7),
        ]);

        News::create([
            'title' => 'Pendaftaran Ekstrakurikuler Semester Ganjil Dibuka',
            'content' => 'Pendaftaran ekstrakurikuler untuk semester ganjil tahun ajaran 2025/2026 telah dibuka. Tersedia berbagai pilihan ekstrakurikuler seperti Paskibra, PMR, Pramuka, Basket, Futsal, Badminton, Tari, Musik, Teater, dan masih banyak lagi. Pendaftaran dapat dilakukan secara online melalui website sekolah atau langsung ke ruang OSIS. Batas akhir pendaftaran adalah 30 September 2025. Jangan lewatkan kesempatan untuk mengembangkan bakat dan minat kalian!',
            'category' => 'pengumuman',
            'status' => 'published',
            'published_date' => Carbon::now()->subDays(10),
        ]);

        // Sample Agendas
        Agenda::create([
            'title' => 'Upacara Hari Sumpah Pemuda',
            'description' => 'Upacara bendera memperingati Hari Sumpah Pemuda. Seluruh siswa wajib hadir dengan seragam lengkap.',
            'start_date' => Carbon::now()->addDays(20),
            'end_date' => Carbon::now()->addDays(20),
            'start_time' => '07:00',
            'end_time' => '08:00',
            'location' => 'Lapangan Upacara',
            'status' => 'upcoming',
        ]);

        Agenda::create([
            'title' => 'Ujian Tengah Semester',
            'description' => 'Pelaksanaan Ujian Tengah Semester Ganjil untuk semua kelas. Siswa hadir 30 menit sebelum ujian dimulai.',
            'start_date' => Carbon::now()->addDays(6),
            'end_date' => Carbon::now()->addDays(11),
            'start_time' => '07:30',
            'end_time' => '10:00',
            'location' => 'Ruang Kelas Masing-masing',
            'status' => 'upcoming',
        ]);

        Agenda::create([
            'title' => 'Pekan Olahraga dan Seni',
            'description' => 'Kegiatan Pekan Olahraga dan Seni (PORSENI) tingkat sekolah. Berbagai lomba akan dilaksanakan.',
            'start_date' => Carbon::now()->addDays(15),
            'end_date' => Carbon::now()->addDays(17),
            'start_time' => '08:00',
            'end_time' => '15:00',
            'location' => 'Lapangan & Aula Sekolah',
            'status' => 'upcoming',
        ]);

        Agenda::create([
            'title' => 'Rapat Orang Tua Siswa',
            'description' => 'Rapat koordinasi orang tua siswa kelas X, XI, dan XII membahas perkembangan akademik siswa.',
            'start_date' => Carbon::now()->addDays(25),
            'end_date' => Carbon::now()->addDays(25),
            'start_time' => '09:00',
            'end_time' => '12:00',
            'location' => 'Aula Sekolah',
            'status' => 'upcoming',
        ]);

        Agenda::create([
            'title' => 'Study Tour Kelas XI',
            'description' => 'Kegiatan study tour untuk siswa kelas XI ke museum dan tempat bersejarah di Jakarta.',
            'start_date' => Carbon::now()->addDays(30),
            'end_date' => Carbon::now()->addDays(31),
            'start_time' => '06:00',
            'end_time' => '18:00',
            'location' => 'Jakarta',
            'status' => 'upcoming',
        ]);
    }
}
