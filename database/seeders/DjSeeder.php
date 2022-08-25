<?php

namespace Database\Seeders;

use App\Models\Dj;
use App\Models\Picture;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create dj
        $djs = Dj::factory()->count(5)->create();
        // create pictures for dj
        foreach ($djs as $dj) {
            $pictures = Picture::factory()->count(4)->create();
            $pictureFavori = Picture::factory()->count(1)->create([
                'favori' => true
            ]);
            $dj->pictures()->saveMany($pictures);
            $dj->pictures()->save($pictureFavori[0]);
        }
    }
}
