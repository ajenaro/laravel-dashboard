<?php

namespace Tests\Feature\Admin;

use App\Skill;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSkillTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function new_skill_page_can_be_rendered()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/admin/skills/create')
            ->assertStatus(200)
            ->assertSee('Nueva Habilidad')
        ;
    }

    /** @test */
    function it_creates_a_new_skill()
    {
        $userLogin = factory(User::class)->create();

        $this->actingAs($userLogin)
            ->post(route('admin.skills.store'), [
                'name' => 'Nueva Habilidad'
            ])
            ->assertRedirect('/admin/skills')
        ;

        $this->assertDatabaseHas('skills', [
            'name' => 'Nueva Habilidad',
        ]);
    }

    /** @test */
    function the_name_is_required()
    {
        $userLogin = factory(User::class)->create();

        $this->actingAs($userLogin)
            ->post(route('admin.skills.store'), [
                'name' => null
            ])
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio.']);

    }

    /** @test */
    function it_cannot_create_a_existing_skill()
    {
        $userLogin = factory(User::class)->create();

        factory(Skill::class)->create([
            'name' => 'PHP'
        ]);

        $this->actingAs($userLogin)
            ->post(route('admin.skills.store'), [
                'name' => 'PHP'
            ])
            ->assertSessionHasErrors(['name' => 'El campo nombre ya ha sido registrado.']);
        ;
    }
}
