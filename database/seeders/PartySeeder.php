<?php

namespace Database\Seeders;

use App\Models\Dj;
use App\Models\Club;
use App\Models\Party;
use App\Models\Dancer;
use App\Models\Picture;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clubs = Club::all();
        $djs = Dj::all();
        $dancers = Dancer::all();
        foreach ($clubs as $club) {
            // create Party
            $parties = Party::factory()->count(5)->create();
            // create pictures for club
            foreach ($parties as $party) {
                $pictures = Picture::factory()->count(4)->create();
                 $pictureFavori = Picture::factory()->count(1)->create([
                'favori' => true
                ]);
            $party->pictures()->saveMany($pictures);
            $party->pictures()->save($pictureFavori[0]);
            }
           foreach ($djs as $dj) {
                foreach ($dancers as $dancer) {
                $dancer->parties()->saveMany($parties); 
            }
            $dj->parties()->saveMany($parties);
        }  
        $club->parties()->saveMany($parties);
        }
    }
}
