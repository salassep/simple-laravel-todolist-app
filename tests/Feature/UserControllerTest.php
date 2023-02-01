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

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "test",
        ])->get("/login")
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "test",
            "password" => "test"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "test");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "test",
        ])->post('/login', [
            "user" => "test",
            "password" => "test"
        ])->assertRedirect("/");
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

    public function testLogOut()
    {
        $this->withSession([
            "user" => "test"
        ])->post("/logout")
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function testLogOutGuest()
    {
        $this->withSession([])->post("/logout")
            ->assertRedirect("/");
    }
}
