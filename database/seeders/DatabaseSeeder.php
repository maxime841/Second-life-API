<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\House;
use App\Models\Land;
use App\Models\Role;
use App\Models\User;
use App\Models\Picture;
use App\Models\Tenant;
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
        //Creation des club dancer dj party
        $this->call([
            ClubSeeder::class,
            PartySeeder::class,
            DjSeeder::class,
            DancerSeeder::class,
        ]);
        
        // create role
        Role::factory()->create([
            'libelle' => 'root',
        ],);
        Role::factory()->create([
            'libelle' => 'admin',
        ],);
        Role::factory()->create([
            'libelle' => 'managerclub',
        ],);
        Role::factory()->create([
            'libelle' => 'managerdancer',
        ],);
        Role::factory()->create([
            'libelle' => 'managerdj',
        ],);
        Role::factory()->create([
            'libelle' => 'auth',
        ],);
        Role::factory()->create([
            'libelle' => 'public',
        ],);

        // get roles
        $idRoleRoot = Role::select('id')->where('libelle', '=', 'root')->get();
        $roleAdmin = Role::where('libelle', '=', 'admin')->get();
        $roleManageClub = Role::where('libelle', '=', 'managerclub')->get();
        $roleManageDancer = Role::where('libelle', '=', 'managerdancer')->get();
        $roleManageDj = Role::where('libelle', '=', 'managerdj')->get();
        $roleAuth = Role::where('libelle', '=', 'auth')->get();
        $rolePublic = Role::where('libelle', '=', 'public')->get();

        // create user with role root
        User::factory()->create([
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
        User::factory()->create([
            // 'first_name' => 'john',
            // 'last_name' => 'haimez',
            // 'pseudo' => 'john_dev',
            'name' => 'Max Poirot',
            // 'address' => '1 rue de la paix',
            // 'code_post' => '75000',
            // 'city' => 'paris',
            // 'phone' => '0606060606',
            'avatar' => null,
            'email' => 'max@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => $idRoleRoot[0]->id,
            'remember_token' => null,
        ]);
        // create user with role admin
        $usersAdmin = User::factory()->count(5)->create();
        foreach ($usersAdmin as $user) {
            $roleAdmin[0]->users()->save($user);
        };
        // create user with role managerclub
        $userManagerClub = User::factory()->count(5)->create();
        foreach ($userManagerClub as $user) {
            $roleManageClub[0]->users()->save($user);
        };
        // create user with role managerdancer
        $userManagerDancer = User::factory()->count(5)->create();
        foreach ($userManagerDancer as $user) {
            $roleManageDancer[0]->users()->save($user);
        };
        // create user with role managerdj
        $userManagerDj = User::factory()->count(5)->create();
        foreach ($userManagerDj as $user) {
            $roleManageDj[0]->users()->save($user);
        };
        // create user with role auth
        $usersAuth = User::factory()->count(5)->create();
        foreach ($usersAuth as $user) {
            $roleAuth[0]->users()->save($user);
        };
        // create user with role public
        $usersPublic = User::factory()->count(5)->create();
        foreach ($usersPublic as $user) {
            $rolePublic[0]->users()->save($user);
        };

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

        // create tenants
        $tenants = Tenant::factory()->count(10)->create();

        // create houses
        foreach ($lands as $land) {
            $houses = House::factory()->count(10)->create();
            foreach ($houses as $house) {
                $pictures = Picture::factory()->count(4)->create();
                $pictureFavori = Picture::factory()->count(1)->create([
                    'favori' => true
                ]);
                $house->pictures()->saveMany($pictures);
                $house->pictures()->save($pictureFavori[0]);
            }
            $land->houses()->saveMany($houses);
        }
    }
}
