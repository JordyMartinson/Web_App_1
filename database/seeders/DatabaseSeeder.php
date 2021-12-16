<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this -> call(UserTableSeeder::class);
        $this -> call(AccountTableSeeder::class);
        $this -> call(PostTableSeeder::class);
        $this -> call(CommentTableSeeder::class);
        $this -> call(RoleTableSeeder::class);
        $this -> call(RoleUserTableSeeder::class);
    }
}
