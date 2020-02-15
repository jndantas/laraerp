<?php

use App\Models\Category;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin admn',
            'email' => 'admin@admin.com',
            'type' => 'admin',
            'password' => Hash::make('password')
        ]);
    }
}
