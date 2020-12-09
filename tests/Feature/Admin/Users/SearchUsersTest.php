<?php

namespace Tests\Feature\Admin\Users;

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function search_users_by_name()
    {
        $joel = factory(User::class)->create([
            'name' => 'Joel'
        ]);

        $ellie = factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->actingAs($ellie)
            ->get('/admin/users?search=Joel')
            ->assertStatus(200)
            ->assertViewHas('users', function ($users) use ($joel, $ellie) {
                return $users->contains($joel) && !$users->contains($ellie);
            });
    }

    /** @test */
    function show_results_with_a_partial_search_by_name()
    {
        $joel = factory(User::class)->create([
            'name' => 'Joel'
        ]);

        $ellie = factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->actingAs($ellie)
            ->get('/admin/users?search=Jo')
            ->assertStatus(200)
            ->assertViewHas('users', function ($users) use ($joel, $ellie) {
                return $users->contains($joel) && !$users->contains($ellie);
            });
    }

    /** @test */
    function search_users_by_email()
    {
        $joel = factory(User::class)->create([
            'email' => 'joel@example.com',
        ]);

        $ellie = factory(User::class)->create([
            'email' => 'ellie@example.net',
        ]);

        $response = $this->actingAs($ellie)
            ->get('/admin/users?search=joel@example.com')
            ->assertStatus(200)
            ->assertViewHas('users', function ($users) use ($joel, $ellie) {
                return $users->contains($joel) && !$users->contains($ellie);
            })
        ;
    }

    /** @test */
    function show_results_with_a_partial_search_by_email()
    {
        $joel = factory(User::class)->create([
            'email' => 'joel@example.com',
        ]);

        $ellie = factory(User::class)->create([
            'email' => 'ellie@example.net',
        ]);

        $this->actingAs($ellie)
            ->get('/admin/users?search=joel@example')
            ->assertStatus(200)
            ->assertViewHas('users', function ($users) use ($joel, $ellie) {
                return $users->contains($joel) && !$users->contains($ellie);
            });
    }

    /** @test */
    function show_results_with_a_partial_search_by_name_or_email()
    {
        $loginUser = factory(User::class)->create();

        $alberto = factory(User::class)->create([
            'name' => 'Alberto Gomez',
            'email' => 'alberto@email.com'
        ]);

        $sonia = factory(User::class)->create([
            'name' => 'Sonia Valencia',
            'email' => 'sonia@hotmail.com'
        ]);

        $carlos = factory(User::class)->create([
            'name' => 'Carlos Perez',
            'email' => 'carlos@hermanos-gomez.com'
        ]);

        $this->actingAs($loginUser)
            ->get('/admin/users?search=gomez')
            ->assertStatus(200)
            ->assertViewHas('users', function ($users) use ($alberto, $sonia, $carlos) {
                return $users->contains($alberto) && $users->contains($carlos) && !$users->contains($sonia);
            });
    }

    /** @test */
    function search_users_by_team_name()
    {
        $joel = factory(User::class)->create([
            'name' => 'Joel',
            'team_id' => factory(Team::class)->create(['name' => 'Smuggler'])->id,
        ]);

        $ellie = factory(User::class)->create([
            'name' => 'Ellie',
            'team_id' => null,
        ]);

        $marlene = factory(User::class)->create([
            'name' => 'Marlene',
            'team_id' => factory(Team::class)->create(['name' => 'Firefly'])->id,
        ]);

        $this->actingAs($ellie)
            ->get('/admin/users?search=Firefly')
            ->assertStatus(200)
            ->assertViewHas('users', function ($users) use ($marlene, $joel, $ellie) {
                return $users->contains($marlene)
                    && !$users->contains($joel)
                    && !$users->contains($ellie);
            })
            ;
    }

    /** @test */
    function partial_search_by_team_name()
    {
        $joel = factory(User::class)->create([
             'name' => 'Joel',
             'team_id' => factory(Team::class)->create(['name' => 'Smuggler'])->id,
        ]);

        $ellie = factory(User::class)->create([
            'name' => 'Ellie',
            'team_id' => null,
        ]);

        $marlene = factory(User::class)->create([
            'name' => 'Marlene',
            'team_id' => factory(Team::class)->create(['name' => 'Firefly'])->id,
        ]);

        $response = $this->actingAs($ellie)
            ->get('/admin/users?search=Fire')
            ->assertStatus(200);

        $response->assertViewHas('users', function ($users) use ($marlene, $joel, $ellie) {
            return $users->contains($marlene)
                && !$users->contains($joel)
                && !$users->contains($ellie);
        })
        ;
    }
}
