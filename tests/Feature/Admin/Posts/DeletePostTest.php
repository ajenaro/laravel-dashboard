<?php

namespace Tests\Feature\Admin\Posts;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_delete_a_post()
    {
        $post = factory(Post::class)->create([
             'user_id' => factory(User::class)->create(),
             'category_id' => factory(Category::class)->create(),
             'published_at' => null
         ]);

        $this->actingAs(factory(User::class)->create());
        $this->delete(route('admin.posts.destroy', $post));
        $this->assertDatabaseMissing('posts',['id'=> $post->id]);
    }
}
