<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin
        // User::factory(1)
        // ->withAdmin()
        // ->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@diagnose.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('Diagnose21'),
        //     'remember_token' => Str::random(10)
        // ])
        // ->each(function ($user) {
        //     $user->assignRole('admin');
        // });
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@diagnose.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Diagnose21'),
            'remember_token' => Str::random(10)
        ]);
        $admin->assignRole('admin');
        $admin->admin()->create([
            'user_id' => $admin->id
        ]);

        // create expert
        // User::factory(1)
        // ->withExpert()
        // ->create([
        //     'name' => 'Nadya Puspita Ekawardhani, M. Psi',
        //     'email' => 'nadyapuspita@personalgrowth.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('Personalgrowth21'),
        //     'remember_token' => Str::random(10)
        // ])
        // ->each(function ($user) {
        //     $user->assignRole('expert');
        // });
        $expert = User::create([
            'name' => 'Nadya Puspita Ekawardhani, M. Psi',
            'email' => 'nadyapuspita@personalgrowth.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Personalgrowth21'),
            'remember_token' => Str::random(10)
        ]);
        $expert->assignRole('expert');
        $expert->expert()->create([
            'position' => 'Psikolog',
            'company' => 'Personal Growth',
            'user_id' => $expert->id
        ]);

        // create user
        // User::factory(1)
        // ->withDendyProfile()
        // ->create([
        //     'name' => "Dendy Dharmawan",
        //     'email' => "dendy@yopmail.com",
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('Gemscool88'),
        //     'remember_token' => Str::random(10),
        // ])
        // ->each(function ($user) {
        //     $user->assignRole('user');
        // });

        // User::factory(2)
        // ->withUserProfile()
        // ->create()
        // ->each(function ($user) {
        //     $user->assignRole('user');
        // });
        $user = User::create([
            'name' => "Dendy Dharmawan",
            'email' => "dendy@yopmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('Gemscool88'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('user');
        $user->userProfile()->create([
            'gender' => 'male',
            'age' => 21,
            'user_id' => $user->id
        ]);
    }
}
