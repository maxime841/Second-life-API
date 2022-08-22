<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\House::factory()->create([
            'name' => 'La maison paradis',
            'owner' => 'Selecta Delwood',
            'presentation' => 'Une maison de style carraibes avec sa piscine et sa décoration éxotique',
            'prims' => '100',
            'remaining_house_prims' => '10',
            'date_start_rent' => '2022-08-19', 
            'date_end_rent' => '2022-08-25',
        ]);
    }
}