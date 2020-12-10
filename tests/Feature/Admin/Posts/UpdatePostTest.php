<?php

namespace Tests\Feature\Admin\Posts;

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_update_a_post()
    {
        $post = factory(Post::class)->create([
            'user_id' => factory(User::class)->create(),
            'category_id' => factory(Category::class)->create(),
            'published_at' => null,
            'title' => 'New Post',
            'url' => 'new-post'
        ]);

        $post->title = 'Updated Title';
        $post->url = 'updated-title';

        $this->actingAs(factory(User::class)->create())
            ->put( route('admin.posts.update', $post), $post->toArray())
        ;

        $this->assertDatabaseHas('posts',[
            'id'=> $post->id ,
            'title' => 'Updated Title',
            'url' => 'updated-title'
        ]);
    }

    /** @test */
    public function title_field_must_be_unique()
    {
        $oldPost = factory(Post::class)->create([
             'user_id' => factory(User::class)->create(),
             'category_id' => factory(Category::class)->create(),
             'published_at' => null,
             'title' => 'Old Post',
         ]);

        $post = factory(Post::class)->create([
             'user_id' => factory(User::class)->create(),
             'category_id' => factory(Category::class)->create(),
             'published_at' => null,
             'title' => 'New Post',
         ]);

        $post->title = 'Old Post';

        $this->actingAs(factory(User::class)->create())
            ->put( route('admin.posts.update', $post), $post->toArray())
            ->assertSessionHasErrors('title')
        ;
    }
}
