<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Picture;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // create land
       $clubs = Club::factory()->count(5)->create();
       // create pictures for land
       foreach ($clubs as $club) {
           $pictures = Picture::factory()->count(4)->create();
           $pictureFavori = Picture::factory()->count(1)->create([
               'favori' => true
           ]);
           $club->pictures()->saveMany($pictures);
           $club->pictures()->save($pictureFavori[0]);
       }
    }
}
