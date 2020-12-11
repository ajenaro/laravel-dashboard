<?php

namespace Tests\Feature\Admin\Tags;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function authenticated_users_can_see_a_edit_tag_form()
    {
        $tag = factory(Tag::class)->create();

        $this->actingAs(factory(User::class)->create())
            ->get(route('admin.tags.edit', $tag))
            ->assertStatus(200)
            ->assertSee($tag->name)
            ->assertSee($tag->url)
        ;
    }

    /** @test */
    function authenticated_users_can_update_a_tag()
    {
        $tag = factory(Tag::class)->create();

        $tag->name = 'Tag name updated';

        $this->actingAs(factory(User::class)->create())
            ->put(route('admin.tags.update', $tag), $tag->toArray())
        ;

        $this->assertDatabaseHas('tags',[
            'id'=> $tag->id ,
            'name' => 'Tag name updated',
            'url' => 'tag-name-updated'
        ]);
    }
}
