<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{

    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todolist(Request $request): Response
    {
        $todolist = $this->todolistService->getTodolist();
        return response()
            ->view('todolist.todolist', [
                "title" => "Todolist",
                "todolist" => $todolist,
            ]);
    }

    public function addTodo(Request $request)
    {
        # code...
    }

    public function removeTodo(Request $request, string $id)
    {
        # code...
    }
}
