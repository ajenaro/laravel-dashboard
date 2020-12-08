<?php

namespace Tests\Feature\Admin\Users;

use App\Profession;
use App\Skill;
use App\Team;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    protected $defaultData = [
        'team_id' => null,
        'name' => 'Antonio',
        'email' => 'antonio.jenaro@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'website' => 'http://antoniojenaro.com',
        'state' => true,
    ];

    /** @test */
    function new_users_page_can_be_rendered()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/admin/users/create')
            ->assertStatus(200)
            ->assertSee('Datos del Usuario')
        ;
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $userLogin = factory(User::class)->create();

        $profession = factory(Profession::class)->create();

        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();
        $skillC = factory(Skill::class)->create();

        $team = factory(Team::class)->create();

        $this->defaultData['skills'] = [
            $skillA->id, $skillB->id
        ];

        $this->defaultData['team_id'] = $team->id;

        $this->defaultData['profession_id'] = $profession->id;

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            //->assertRedirect('/admin/users')
        ;

        $user = User::where('email', 'antonio.jenaro@gmail.com')->first();

        $this->assertDatabaseHas('user_profiles', [
            'profession_id' => $profession->id,
            'website' => 'http://antoniojenaro.com',
            'phone_number' => null,
            'user_id' => $user->id,
        ]);

        $this->assertCount(2, $user->skills);

        $this->assertDatabaseHas('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillA->id,
        ]);

        $this->assertDatabaseHas('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillB->id,
        ]);

        $this->assertDatabaseMissing('user_skill', [
            'user_id' => $user->id,
            'skill_id' => $skillC->id,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'team_id' => $team->id,
        ]);
    }

    /** @test */
    function the_profession_title_field_is_optional()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['profession_id'] = null;

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
        //    ->assertRedirect('/admin/users')
        ;

        $this->assertDatabaseHas('user_profiles', [
            'profession_id' => null,
            'website' => 'http://antoniojenaro.com',
        ]);
    }

    /** @test */
    function the_website_field_is_optional()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['website'] = null;
        $this->defaultData['profession_id'] = null;

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
        //    ->assertRedirect('/admin/users')
        ;

        $this->assertDatabaseHas('user_profiles', [
            'website' => null,
        ]);
    }

    /** @test */
    function the_website_field_must_be_a_valid_url()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['website'] = 'domain.com';
        $this->defaultData['profession_id'] = null;

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            ->assertSessionHasErrors(['website'])
        ;

    }

    /** @test */
    function the_name_is_required()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['name'] = null;

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            //->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio.']);
            ->assertSessionHasErrors(['name'])
        ;

    }

    /** @test */
    function the_email_is_required()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['email'] = null;

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            ->assertSessionHasErrors(['email'])
        ;
    }

    /** @test */
    function the_email_must_be_valid()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['email'] = 'correo-no-valido';

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            ->assertSessionHasErrors(['email']);

    }

    /** @test */
    function the_email_must_be_unique()
    {
        $userLogin = factory(User::class)->create([
            'email' => 'antonio.jenaro@gmail.com'
        ]);

        $this->defaultData['email'] = 'antonio.jenaro@gmail.com';

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            ->assertSessionHasErrors(['email' => 'El correo electrónico ya ha sido registrado.']);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['password'] = null;

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            ->assertSessionHasErrors(['password']);
    }

    /** @test */
    function the_password_must_be_confirmed()
    {
        $userLogin = factory(User::class)->create();

        $this->defaultData['password'] = 'password';
        $this->defaultData['password_confirmation'] = 'password_mismatch';

        $this->actingAs($userLogin)
            ->post(route('admin.users.store'), $this->defaultData)
            ->assertSessionHasErrors(['password']);
    }
}
