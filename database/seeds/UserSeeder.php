<?php

use App\User;
use App\UserProfile;
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
        //User::truncate();

        User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'email_verified_at' => now(),
                'password'       => 'password'
        ]);

        // Users with profile
        factory(User::class)->times(10)->create()->each(function ($user) {
            factory(UserProfile::class)->create([
                'user_id' => $user->id
            ]);
        });

        // Users without profile
        factory(User::class)->times(10)->create();

       /* for($i = 1; $i < 60; $i++) {
            factory(User::class)->create([
                 'created_at' => now()->subDays($i),
                 'updated_at' => now()->subDays($i)
             ]);
        }*/
    }
}
