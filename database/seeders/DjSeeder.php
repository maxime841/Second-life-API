<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Dj::factory()->create([
        "name" => 'madmax3184',
        "style" => 'Bouyon, Soca, Dance hall, Electro, Afro-house',
        "date_entrance" => '10/05/2022',
        ]);
    }
}
