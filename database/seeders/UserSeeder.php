<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating a default user
        $user = User::create([
            'name' => "Md. Jahirul Islam",
            'email' => "jahirul.iit5th@gmail.com",
            'password' => Hash::make('84908986@jJ'),
        ]);
        
        User::create([
            'name' => 'Dr. Md Saifuzzaman',
            'email' => 'md.saifuzzaman.mail@gmail.com',
            'password' => Hash::make('zaman@1234'), // Always hash passwords!
        ]);
    }
}
