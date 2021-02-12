<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'admin@miniblog.com',
            'password' => bcrypt('12345678'),
        ]);

    }
}
