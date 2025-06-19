<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'admin@example.com')->first();

        if ($user) {
            // Reset password dengan Bcrypt hash
            $user->update([
                'password' => Hash::make('admin123'), // ← ganti sesuai keinginan
            ]);
        }
    }
}
