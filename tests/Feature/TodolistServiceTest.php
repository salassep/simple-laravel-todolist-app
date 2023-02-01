<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp() : void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "test");
        
        $todolist = Session::get("todolist");

        foreach ($todolist as $value) {
            self::assertEquals("1", $value['id']);
            self::assertEquals("test", $value['todo']);
        }
    }

    public function testGetEmptyTodolist()
    {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolist()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "test",
            ],
            [
                "id" => "2",
                "todo" => "test2",
            ]
        ];

        $this->todolistService->saveTodo("1", "test");
        $this->todolistService->saveTodo("2", "test2");

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }
}
