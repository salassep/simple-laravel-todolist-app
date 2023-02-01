<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "test",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "test",
                ],
                [
                    "id" => "2",
                    "todo" => "test2",
                ],
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("test")
            ->assertSeeText("2")
            ->assertSeeText("test2");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "test",
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "test",
        ])->post("/todolist", [
            "todo" => "test todo",
        ])->assertRedirect("/todolist");
    }
}
