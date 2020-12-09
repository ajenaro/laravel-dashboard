<?php

namespace Tests\Feature\Admin\Users;

use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function a_user_can_be_deleted()
    {
        $user1 = factory(User::class)->create([
            'email' => 'user1@email.com'
        ]);

        $user2 = factory(User::class)->create([
          'email' => 'user2@email.com'
        ]);

        $this->actingAs($user1)
            ->delete('admin/users/'.$user2->id)
            ;

        $this->get('admin/users')
            ->assertSee('user1@email.com')
            ->assertDontSee('user2@email.com')
            ;
    }
}
