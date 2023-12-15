<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Bo Si',
            'email' => 'bosi@gmail.com',
            'password' => Hash::make("11111111")
        ]);
        User::factory(10)->create();


        $categories = ["IT News","Sports","Food & Drinks","Travel"];
        foreach ($categories as $key => $category) {
            \App\Models\Category::factory()->create([
                'title' => $category,
                'slug' => Str::slug($category),
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }

        Post::factory(150)->create();
    }
}
