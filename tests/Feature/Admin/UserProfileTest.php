<?php

namespace Tests\Feature\Admin;

use App\Profession;
use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_edit_its_profile()
    {
        $this->markTestIncomplete();

        $user = factory(User::class)->create();

        $newProfession = factory(Profession::class)->create();

        $this->actingAs($user);

        $response = $this->get('/editar-perfil/');

        $response->assertStatus(200);

        $response = $this->put('/editar-perfil/', [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'bio' => 'Programador de Laravel y Vue.js',
            'twitter' => 'https://twitter.com/sileence',
            'profession_id' => $newProfession->id,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'Programador de Laravel y Vue.js',
            'twitter' => 'https://twitter.com/sileence',
            'profession_id' => $newProfession->id,
        ]);
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
