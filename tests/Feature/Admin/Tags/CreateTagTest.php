<?php

namespace Tests\Feature\Admin\Tags;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function authenticated_users_can_see_a_new_tag_form()
    {
        $this->withExceptionHandling();

        $this->actingAs(factory(User::class)->create())
            ->get(route('admin.tags.create'))
            ->assertStatus(200)
            ->assertSee('Crear Etiqueta')
        ;
    }

    /** @test */
    public function authenticated_users_can_create_a_new_tag()
    {
        $this->withExceptionHandling();

        $tag = factory(Tag::class)->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('admin.tags.store'), $tag->toArray())
        ;

        $this->assertEquals(1, Tag::all()->count());
    }

    /** @test */
    public function name_field_is_required()
    {
        //
    }

    /** @test */
    public function name_field_must_be_unique()
    {
        //
    }
}
