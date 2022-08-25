<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Land;
use App\Models\Picture;
use Illuminate\Database\Seeder;
use Database\Seeders\LandSeeder;

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

        //Creation des terrains
        $this->call([
            //LandSeeder::class,
            //PictureSeeder::class,
            // TenantSeeder::class,
            //HouseSeeder::class,
            //DjSeeder::class,
            ClubSeeder::class,
        ]);

        
    }
}
