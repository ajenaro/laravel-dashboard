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
                'password'       => 'password',
                'role'           => 'admin',
                 'created_at' => now(),
                 'updated_at' => now()
        ]);

        // Users with profile

            factory(User::class)->times(50)->create(
                [
                    'active' => rand(0, 1),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            )->each(
                function ($user) {
                    factory(UserProfile::class)->create(
                        [
                            'user_id' => $user->id,
                        ]
                    );
                }
            );


       // Users without profile
       for($i = 1; $i <= 49; $i++) {
            factory(User::class)->create([
                 'active' => rand(0, 1),
                 'created_at' => now()->subDays($i),
                 'updated_at' => now()->subDays($i)
             ]);
        }
    }
}
