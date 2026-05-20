<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name' => "Stats"]);
        Tag::create(['name' => "Question"]);
        Tag::create(['name' => "Announcement"]);
        Tag::create(['name' => "Complaint"]);
        Tag::create(['name' => "Chant"]);
        Tag::create(['name' => "Suggestion"]);
        Tag::create(['name' => "Funny"]);
    }
}
