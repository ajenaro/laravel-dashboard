<?php

namespace Tests\Feature\Admin;

use App\Profession;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfessionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_professions_list()
    {
        factory(Profession::class)->create(['title' => 'Profession 1']);
        factory(Profession::class)->create(['title' => 'Profession 2']);
        factory(Profession::class)->create(['title' => 'Profession 3']);

        $this->actingAs(factory(User::class)->create())
            ->get(route('admin.professions.index'))
            ->assertStatus(200)
            ->assertSeeInOrder([
               'Profession 1',
               'Profession 2',
               'Profession 3'
           ]);
    }

    /** @test */
    function authenticated_users_can_see_a_new_profession_form()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.professions.create'))
            ->assertStatus(200)
            ->assertSee('Nueva Profesión')
        ;
    }

    /** @test */
    function authenticated_users_can_create_a_new_profession()
    {
        $profession = factory(Profession::class)->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('admin.professions.store'), $profession->toArray())
            ;

        $this->assertEquals(1,Profession::all()->count());
    }

    /** @test */
    function unauthenticated_users_cannot_create_a_new_task()
    {
        $profession = factory(Profession::class)->make();
        $this->post(route('admin.professions.store'),$profession->toArray())
            ->assertRedirect('/login');
    }

    /** @test */
    function the_title_is_required()
    {
        $profession = factory(Profession::class)->make([
            'title' => null
        ]);

        $this->actingAs(factory(User::class)->create())
            ->post(route('admin.professions.store'), $profession->toArray())
            ->assertSessionHasErrors(['title'])
        ;

    }

    /** @test */
    function authenticated_user_can_delete_a_profession()
    {
        $this->actingAs(factory(User::class)->create());
        $profession = factory(Profession::class)->create();
        $this->delete(route('admin.professions.destroy', $profession));
        $this->assertDatabaseMissing('professions',['title'=> $profession->title]);
    }

    /** @test */
    public function unauthenticated_user_cannot_delete_a_profession()
    {
        $profession = factory(Profession::class)->create();
        $response = $this->delete(route('admin.professions.destroy', $profession));
        $response->assertRedirect('/login');
    }

    /** @test */
    function a_user_can_read_single_profession()
    {
        $profession = factory(Profession::class)->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('admin.professions.edit', $profession))
            ->assertSee($profession->title)
        ;
    }

    /** @test */
    public function authenticated_user_can_update_a_profession()
    {
        $this->actingAs(factory(User::class)->create());
        $profession = factory(Profession::class)->create();
        $profession->title = 'Updated Title';
        $this->put(route('admin.professions.update', $profession), $profession->toArray());
        $this->assertDatabaseHas('professions',['id'=> $profession->id , 'title' => 'Updated Title']);
    }

    /** @test */
    public function unauthenticated_user_cannot_update_a_profession()
    {
        $profession = factory(Profession::class)->create();
        $profession->title = 'Updated Title';
        $response = $this->put(route('admin.professions.update', $profession), $profession->toArray());
        // Redirect to login
        $response->assertRedirect('/login');
    }
}
