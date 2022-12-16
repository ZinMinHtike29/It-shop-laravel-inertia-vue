<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductBrand;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name" => "Zin Min Htike",
            "phone" => "09780136579",
            "email" => "admin@gmail.com",
            "password" => Hash::make("zinminhtike"),
            "role" => "admin",
            "address" => "Yangon",
        ]);
        User::create([
            "name" => "Zin Min Htike",
            "phone" => "09780136579",
            "email" => "user@gmail.com",
            "password" => Hash::make("zinminhtike"),
            "role" => "user",
            "address" => "Mandalay",
        ]);
        Category::create([
            "title" => "Laptop"
        ]);
        Category::create([
            "title" => "Tablet"
        ]);
        Category::create([
            "title" => "Tv"
        ]);

        ProductBrand::create([
            "title" => "Apple"
        ]);
        ProductBrand::create([
            "title" => "Samsung"
        ]);
        ProductBrand::create([
            "title" => "Lg"
        ]);
    }
}