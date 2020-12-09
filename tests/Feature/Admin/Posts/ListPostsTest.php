<?php

namespace Tests\Feature\Admin\Posts;

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_read_all_post()
    {
        $post = factory(Post::class)->create([
            'category_id' => factory(Category::class)->create(),
            'user_id' => factory(User::class)->create(),
            'published_at' => Carbon::now()->subDays(rand(1, 20))->format('d/m/Y')
        ]);

        $response = $this->actingAs(factory(User::class)->create())
            ->get(route('admin.posts.index'))
            ->assertStatus(200)
        ;

        $response->assertSee($post->title);
    }
}
