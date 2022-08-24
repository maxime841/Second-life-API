<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Land;
use App\Models\Role;
use App\Models\Picture;
use Illuminate\Database\Seeder;
use Database\Seeders\LandSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create role
        \App\Models\Role::factory(1)->create();
        \App\Models\Role::factory()->create([
            'libelle' => 'admin',
        ],);
        \App\Models\Role::factory()->create([
            'libelle' => 'auth',
        ],);
        \App\Models\Role::factory()->create([
            'libelle' => 'public',
        ],);

        $idRoleRoot = Role::select('id')->where('libelle', '=', 'root')->get();

        //\App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            // 'first_name' => 'john',
            // 'last_name' => 'haimez',
            // 'pseudo' => 'john_dev',
            'name' => 'John Haimez',
            // 'address' => '1 rue de la paix',
            // 'code_post' => '75000',
            // 'city' => 'paris',
            // 'phone' => '0606060606',
            'avatar' => null,
            'email' => 'haimezjohn@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => $idRoleRoot[0]->id,
            'remember_token' => null,
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
