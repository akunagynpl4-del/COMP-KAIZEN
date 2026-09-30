<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@partyrentalpro.com']);
        $admin->name = 'Admin';
        $admin->role = 'admin';

        if (!$admin->exists) {
            $password = env('ADMIN_PASSWORD');

            if (!$password) {
                $this->command?->warn('Set ADMIN_PASSWORD sebelum membuat akun admin.');
                return;
            }

            $admin->password = Hash::make($password);
        }

        $admin->save();
    }
}
