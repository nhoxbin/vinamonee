<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'admin'],
            ['name' => 'saler'],
            ['name' => 'appraiser'],
            ['name' => 'disburser'],
            ['name' => 'member'],
        ]);

        $user = \App\Models\User::create([
            'name' => 'Bin',
            'email' => 'bin@gmail.com',
            'username' => 'nhoxbin',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('admin');
        // \App\Models\User::factory(10)->create();
    }
}
