<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Services\ImageFetcher;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ImageFetcher $fetcher)
    {   

        $admin = User::create([
        'name' => "Freddie_Admin",
            'email' => "bulldogwuffwuff@gmail.com",
            'email_verified_at' => now(),
            'admin_status' => true,
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            ]);
        
        $admin->profile()->create([
            'bio' => "I am the admin of this website!!!",
        ]);

        $admin->profile->avatar()->create([
            'path' => 'post_images/George.jpg',
        ]);

        $users = User::factory(10)->has(Profile::factory())->create();

        foreach ($users as $user) {
            $avatarPath = $fetcher->fetchRandomImage();
            $user->profile->avatar()->create([
                'path' => $avatarPath,
        ]);
    }
    }
}
