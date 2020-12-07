<?php

use App\{Profession, Skill, Team, User, UserProfile};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected $professions;
    protected $teams;
    protected $skills;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fetchRelations();

        $this->createAdmin();

        foreach(range(1, 99) as $i) {
            $this->createRandomUser($i);
        }
    }

    private function fetchRelations()
    {
        $this->professions = Profession::pluck('id')->toArray();

        $this->teams = Team::pluck('id')->toArray();

        $this->skills = Skill::pluck('id')->toArray();
    }

    private function createAdmin()
    {
        $admin = User::create([
             'name'           => 'Admin',
             'email'          => 'admin@admin.com',
             'email_verified_at' => now(),
             'password'       => 'password',
             'role'           => 'admin',
             'options'       => [
                 'language' => 'es',
                 'theme'    => 'dark'
             ],
             'created_at' => now(),
             'updated_at' => now()
         ]);

        $admin->profile()->create([
              'website' => 'http://antoniojenaro.com',
              'profession_id' => Profession::where('title', 'Desarrollador back-end')->first()->id,
          ]);

        $admin->skills()->attach($this->skills);
    }

    private function createRandomUser($i)
    {
        $user = factory(User::class)->create(
            [
                'team_id' => rand(1, sizeof($this->teams)),
                'state' => rand(0, 1),
                'created_at' => now()->subDays($i),
                'updated_at' => now()->subDays($i)
            ]
        );

        factory(UserProfile::class)->create([
            'user_id' => $user->id,
            'profession_id' => rand(1, sizeof($this->professions)),
        ]);

        $user->skills()->attach(Skill::all()->random(rand(0, sizeof($this->skills))));
    }
}
