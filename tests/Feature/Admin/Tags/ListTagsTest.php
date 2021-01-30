<?php

namespace Tests\Feature\Admin\Tags;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTagsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_read_all_tags()
    {
        $tag = factory(Tag::class)->create();

        $response = $this->actingAs(factory(User::class)->create())
            ->get(route('admin.tags.index'))
            ->assertStatus(200)
        ;

        $response->assertSee($tag->name);
    }
}
