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
        ]);

        // create land
        $lands = Land::factory()->count(5)->create();
        // create pictures for land
        foreach ($lands as $land) {
            $pictures = Picture::factory()->count(4)->create();
            $pictureFavori = Picture::factory()->count(1)->create([
                'favori' => true
            ]);
            $land->pictures()->saveMany($pictures);
            $land->pictures()->save($pictureFavori[0]);
        }
    }
}
