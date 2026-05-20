<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(TagTableSeeder::Class);
        $this->call(UserTableSeeder::Class);
        $this->call(PostTableSeeder::Class);
        //$this->call(CommentTableSeeder::Class);
        //$this->call(ImageTableSeeder::Class);
    }
}
