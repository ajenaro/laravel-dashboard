<?php

namespace Tests\Feature\Admin\Users;

use App\Profession;
use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_edit_its_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->put(route('admin.users.update', $user), [
                'name' => 'Antonio',
                'email' => 'antonio.jenaro@gmail.com',
                'website' => null,
                'profession_id' => null,
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Antonio',
            'email' => 'antonio.jenaro@gmail.com',
        ]);

       /*$this->assertDatabaseHas('user_profiles', [
            'website' => 'https://twitter.com/sileence',
            'profession_id' => $newProfession->id,
        ]);*/
    }

    /** @test */
    public function a_user_profile_belongs_to_a_user()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
           'website' => 'https://styde.net',
           'user_id' => $user->id,
       ]);

        $this->assertInstanceOf(BelongsTo::class, $userProfile->user());
        $this->assertInstanceOf(User::class, $userProfile->user);
        $this->assertTrue($userProfile->user->is($user));
        $this->assertSame('https://styde.net', $user->profile->website);
    }

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

    /** @test */
    function users_without_profile_are_assigned_a_default_profile()
    {
        $this->markTestSkipped();

        $user = factory(User::class)->create([
             'name' => 'Antonio',
         ]);

        $this->assertInstanceOf(UserProfile::class, $user->profile);
        $this->assertFalse($user->profile->exists);
        $this->assertSame('Developer', $user->profile->job_title);
        $this->assertSame('https://styde.net/perfil/antonio', $user->profile->website);
    }
}
