<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uAdmin = new User;
        $uAdmin->name = "John Admin";
        $uAdmin->email = "john@john.com";
        $uAdmin->password = Hash::make("swordfish");
        $uAdmin->save();

        $uUser = new User;
        $uUser->name = "Jane User";
        $uUser->email = "jane@jane.com";
        $uUser->password = Hash::make("blackberry");
        $uUser->save();

        User::factory() -> count(20) -> create();
    }
}
