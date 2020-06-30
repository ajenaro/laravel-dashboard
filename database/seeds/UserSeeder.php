<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$oPTZiwmD3Dgy5KH/OnlVv.kWqnFnbYze3F/YsZ5w55Wh2qNzVugOy', // password
        ]);

        for($i = 1; $i < 60; $i++) {
            factory(User::class)->create([
                 'created_at' => now()->subDays($i),
                 'updated_at' => now()->subDays($i)
             ]);
        }
    }
}
