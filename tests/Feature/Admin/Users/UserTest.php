<?php

namespace Tests\Feature\Admin\Users;

use App\Team;
use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_many_post()
    {
        $this->markTestSkipped();

        $user = factory(User::class)->create();

        $firstPost = $user->posts()->create([
            'title' => 'First Post',
            'content' => 'Content of the first post'
        ]);

        $secondPost = $user->posts()->create([
             'title' => 'Second Post',
             'content' => 'Content of the second post'
         ]);

        $this->assertInstanceOf(HasMany::class, $user->posts());
        $this->assertInstanceOf(Collection::class, $user->posts);
        $this->assertCount(2, $user->posts);

        $posts = $user->posts->all();
        $this->assertTrue(is_array($posts));
        $this->assertTrue($posts[0]->is($firstPost));
        $this->assertTrue($posts[1]->is($secondPost));
    }

    /** @test */
    public function get_the_published_posts_of_a_user()
    {
        $this->markTestSkipped();

        $user = factory(User::class)->create();

        $published = factory(Post::class)->create([
              'author_id' => $user->id,
              'published_at' => now()
          ]);

        $draft = factory(Post::class)->create([
              'author_id' => $user->id,
              'published_at' => null
          ]);

        $scheduled = factory(Post::class)->create([
              'author_id' => $user->id,
              'published_at' => now()->addDay()
          ]);

        $this->assertInstanceOf(HasMany::class, $user->posts());
        $this->assertInstanceOf(Collection::class, $user->publishedPosts);
        $this->assertCount(3, $user->posts);
        $this->assertCount(1, $user->publishedPosts);
        $this->assertTrue($user->publishedPosts->first()->is($published));
    }

    /** @test */
    function stores_the_configuration_options_of_the_user()
    {
        $this->markTestSkipped('esta opción no está implementada');

        $user = factory(User::class)->create([
             'options' => [
                 'language' => 'es',
                 'theme' => 'dark'
             ],
         ]);

        $this->assertSame('es', $user->options['language']);
        $this->assertSame('dark', $user->options['theme']);
    }

    /** @test */
    function gets_the_state_attribute_as_a_boolean()
    {
        $user = factory(User::class)->create([
             'state' => 1
         ]);

        $this->assertTrue($user->state);
    }

    /** @test */
    function a_user_belongs_to_team()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create([
            'team_id' => $team->id,
        ]);

        $this->assertSame($team->name, $user->team->name);
    }

    /** @test */
    function verifies_if_the_user_is_an_admin()
    {
        $user = factory(User::class)->create();

        $user->role = 'user';
        $this->assertFalse($user->isAdmin());

        $user->role = 'admin';
        $this->assertTrue($user->isAdmin());
    }
}
