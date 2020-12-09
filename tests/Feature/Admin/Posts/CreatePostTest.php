<?php

namespace Tests\Feature\Admin\Posts;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function authenticated_users_can_see_a_new_post_form()
    {
        $this->withExceptionHandling();

        $this->actingAs(factory(User::class)->create())
            ->get(route('admin.posts.create'))
            ->assertStatus(200)
            ->assertSee('Crear Post')
        ;
    }

    /** @test */
    public function authenticated_users_can_create_a_new_post()
    {
        $post = factory(Post::class)->make([
            'user_id' => factory(User::class)->create(),
            'category_id' => factory(Category::class)->create(),
            'published_at' => null
        ]);

        $this->actingAs(factory(User::class)->create())
            ->post(route('admin.posts.store'), $post->toArray())
        ;

        $this->assertEquals(1, Post::all()->count());
    }
}
