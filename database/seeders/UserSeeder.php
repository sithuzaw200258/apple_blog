<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->create([
        //     'name' => 'Bo Si',
        //     'email' => 'bosi@gmail.com',
        //     'password' => Hash::make("admin"),
        // ]);
        // User::factory(10)->create();
        // User::factory()
        //     ->has(Post::factory()->count(3))
        //     ->create();
    }
}
