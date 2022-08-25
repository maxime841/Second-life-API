<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Club::factory()->create([
            'name' => 'Le Douceur Kreyol Club',
            'owner' => 'Khalee.voxel',  
        ]);
    }
}
