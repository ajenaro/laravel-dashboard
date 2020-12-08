<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ExampleTest
 * More info: https://5balloons.info/laravel-tdd-beginner-crud-example/
 *
 */
class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_read_all_rows()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function authenticated_users_can_read_single_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    function authenticated_users_can_see_a_new_row_form()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function authenticated_users_can_create_a_new_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function a_row_requires_a_title()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function authenticated_users_can_update_a_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function authorized_user_can_update_a_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function unauthorized_user_cannot_update_a_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function authenticated_users_can_delete_a_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function authorized_user_can_delete_a_row()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function unauthorized_user_cannot_delete_a_row()
    {
        $this->markTestIncomplete();
    }
}

