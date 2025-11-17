<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key constraints (hanya untuk MySQL)
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('users')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            // Untuk SQLite, cukup hapus semua record
            DB::table('users')->delete();
        }

        // Buat user admin
        User::create([
            'name' => 'Admin SMKN 4 Bogor',
            'username' => 'admin_smkn4',
            'email' => 'admin@smkn4bogor.sch.id',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'is_super_admin' => true,
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@smkn4bogor.sch.id');
        $this->command->info('Password: admin123');
    }
}