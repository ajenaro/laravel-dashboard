<?php

namespace Tests\Feature\Admin;

use App\Skill;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListSkillsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_skills_list()
    {
        $userLogin = factory(User::class)->create();

        factory(Skill::class)->create(['name' => 'HTML']);

        factory(Skill::class)->create(['name' => 'PHP']);

        factory(Skill::class)->create(['name' => 'CSS']);

        $this->actingAs($userLogin)
            ->get('/admin/skills')
            ->assertStatus(200)
            ->assertSeeInOrder([
               'CSS',
               'HTML',
               'PHP'
           ]);
    }
}
