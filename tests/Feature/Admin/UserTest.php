<?php

namespace Tests\Feature\Admin;

use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_the_user_profile_associated_to_a_user()
    {
        $user = factory(User::class)->create();

        $userProfile = factory(UserProfile::class)->create([
           'user_id' => $user->id,
           'website' => 'antoniojenaro.com'
       ]);

        $this->assertInstanceOf(UserProfile::class, $user->profile);
        $this->assertTrue($userProfile->is($user->profile));
        $this->assertSame('antoniojenaro.com', $user->profile->website);
    }

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
            ->assertRedirect(route('admin.users.index'))
            ;

        $this->get('admin/users')
            ->assertSee('user1@email.com')
            ->assertDontSee('user2@email.com')
            ;
    }
}
