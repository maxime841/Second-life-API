<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Land::factory()->create([
            'name' => 'Le Domaine de Valombreuse',
            'owner' => 'Khalee.voxel',
            'presentation' => 'Si vous aimez les iles veuillez lire cet article',
            'description' => 'Une map située dans les iles carraibes avec 7 maisons et un complexe hotellier, chaque maison dispose d\'une piscine',
            'group' => 'Le Domaine de Valombreuse',
            'prims' => '9000',
            'remaining_prims' => '1500',
            'date_buy' => '2022-04-15',  
        ]);
    }
}
