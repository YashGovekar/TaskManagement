<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for creating a test user.
     */
    public function run(): void
    {
        // Define Test User's data.
        $user_data = [
            'name'     => 'Test User',
            'email'    => 'test@example.com',
            'password' => Hash::make('test1234#'),
        ];

        // Create Test User.
        $user = new User;
        $user->fill($user_data);
        $user->save();
    }
}
