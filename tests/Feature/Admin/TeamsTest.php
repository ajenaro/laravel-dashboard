<?php

namespace Tests\Feature\Admin;

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_read_all_teams()
    {
        $team1 = factory(Team::class)->create();
        $team2 = factory(Team::class)->create();
        $team3 = factory(Team::class)->create();

        $response = $this->actingAs(factory(User::class)->create())
            ->get(route('admin.teams.index'))
            ->assertStatus(200)
            ;
        $response->assertSee($team1->title);
        $response->assertSee($team2->title);
        $response->assertSee($team3->title);

    }

    /** @test */
    public function authenticated_users_can_read_single_team()
    {
        $team = factory(Team::class)->create();
        $this->actingAs(factory(User::class)->create())
            ->get(route('admin.teams.edit', $team))
            ->assertSee($team->name)
        ;
    }

    /** @test */
    function authenticated_users_can_see_a_new_team_form()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('admin.teams.create'))
            ->assertStatus(200)
            ->assertSee('Nuevo Equipo')
        ;
    }

    /** @test */
    public function authenticated_users_can_create_a_new_team()
    {
        $team = factory(Team::class)->make();
        $this->actingAs(factory(User::class)->create())
            ->post(route('admin.teams.store'), $team->toArray())
        ;

        $this->assertEquals(1, Team::all()->count());
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_team()
    {
        $team = factory(Team::class)->make();
        $this->post(route('admin.teams.store'), $team->toArray())
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_team_requires_a_title()
    {
        $team = factory(Team::class)->make(['name' => null]);
        $this->actingAs(factory(User::class)->create())
            ->post(route('admin.teams.store'), $team->toArray())
            ->assertSessionHasErrors('name')
        ;
    }

    /** @test */
    public function authenticated_users_can_update_a_team()
    {
        $team = factory(Team::class)->create();
        $team->name = 'Updated Title';

        $this->actingAs(factory(User::class)->create())
            ->put( route('admin.teams.update', $team), $team->toArray())
            ;
        $this->assertDatabaseHas('teams',['id'=> $team->id , 'name' => 'Updated Title']);
    }

    /** @test */
    public function authorized_user_can_update_a_team()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function unauthorized_user_cannot_update_a_team()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function authenticated_users_can_delete_a_team()
    {
        $team = factory(Team::class)->create();
        $this->actingAs(factory(User::class)->create());
        $this->delete(route('admin.teams.destroy', $team));
        $this->assertDatabaseMissing('teams',['id'=> $team->id]);
    }

    /** @test */
    public function authorized_user_can_delete_a_team()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function unauthorized_user_cannot_delete_a_team()
    {
        $this->markTestIncomplete();
    }
}
