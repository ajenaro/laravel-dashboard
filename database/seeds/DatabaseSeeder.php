<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
              'users',
              'user_profiles',
              'user_skill',
              'skills',
              'teams',
              'professions',
              'posts',
              'categories',
              'tags'
          ]);

        $this->call([
            SkillSeeder::class,
            TeamSeeder::class,
            ProfessionSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            TagSeeder::class
        ]);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
