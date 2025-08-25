<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Destination;
use App\Models\News;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tourism.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Create Regular User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@tourism.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        // Create Sample Destinations
        Destination::create([
            'name' => 'Candi Borobudur',
            'slug' => 'candi-borobudur',
            'description' => 'Candi Buddha terbesar di dunia yang terletak di Jawa Tengah.',
            'location' => 'Magelang, Jawa Tengah',
            'price' => 50000,
            'status' => 'active'
        ]);

        News::create([
            'title' => 'Pembukaan Destinasi Wisata Baru',
            'slug' => 'pembukaan-destinasi-wisata-baru',
            'content' => 'Pemerintah membuka destinasi wisata baru...',
            'excerpt' => 'Pemerintah membuka destinasi wisata baru',
            'status' => 'published',
            'author_id' => 1
        ]);
    }
}