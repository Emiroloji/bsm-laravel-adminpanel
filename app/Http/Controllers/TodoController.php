<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    protected TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = $this->todoService->getAll();
        return view('todo.index', compact('todos'));
    }

    public function store(StoreTodoRequest $request)
    {
        $this->todoService->create($request->validated());
        return redirect()->route('todo.index')->with('success', 'Todo eklendi!');
    }

    public function update(UpdateTodoRequest $request, $id)
    {
        $this->todoService->update($id, $request->validated());
        return redirect()->route('todo.index')->with('success', 'Todo güncellendi!');
    }

    public function destroy($id)
    {
        $this->todoService->delete($id);
        return redirect()->route('todo.index')->with('success', 'Todo silindi!');
    }
}