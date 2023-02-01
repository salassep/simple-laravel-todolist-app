<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "test",
            "password" => "test"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "test");
    }

    public function testValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText("User or password is required");
    }

    public function testFailedLogin()
    {
        $this->post('/login', [
            "user" => "user",
            "password" => "wrong",
        ])->assertSeeText("User or password invalid");
    }
}