<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Kegiatan Sekolah',
                'description' => 'Berbagai kegiatan yang dilakukan di sekolah',
                'is_active' => true
            ],
            [
                'name' => 'Ekstrakurikuler',
                'description' => 'Kegiatan ekstrakurikuler siswa',
                'is_active' => true
            ],
            [
                'name' => 'Prestasi',
                'description' => 'Prestasi yang diraih oleh siswa dan guru',
                'is_active' => true
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}