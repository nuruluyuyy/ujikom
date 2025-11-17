<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder admin.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $exists = DB::table('petugas')->where('username', 'admin')->exists();

        if (!$exists) {
            DB::table('petugas')->insert([
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'nama' => 'Administrator',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Admin berhasil dibuat.');
        } else {
            $this->command->warn('Admin sudah ada, tidak dibuat ulang.');
        }
    }
}
