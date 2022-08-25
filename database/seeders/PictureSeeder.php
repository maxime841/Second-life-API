<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Picture::factory()->create([
            'name' => 'land 1',
            'picture_url' => 'url1',
            'favori' => 'true', 
        ]);

        \App\Models\Picture::factory()->create([
            'name' => 'land 2',
            'picture_url' => 'url2',
            'favori' => 'false',
        ]);

        \App\Models\Picture::factory()->create([
            'name' => 'house 1',
            'picture_url' => 'url1',
            'favori' => 'false',
        ]);

        \App\Models\Picture::factory()->create([
            'name' => 'house 2',
            'picture_url' => 'url2',
            'favori' => 'true',
        ]);
    }
}
