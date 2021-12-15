<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        User::all()->each(function ($user) use ($roles){
            $user->roles()->attach(
                $roles-> random(1)->pluck('id')
            );
        });

        $roleA = Role::where('id', 1)->get();
        User::get()[0]->roles()->attach($roleA);

        $roleU = Role::where('id', 2)->get();
        User::get()[1]->roles()->attach($roleU);
    }
}
