<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $this->todoService->create($data);
        return redirect()->route('todo.index')->with('success', 'Todo eklendi!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean'
        ]);

        $this->todoService->update($id, $data);
        return redirect()->route('todo.index')->with('success', 'Todo güncellendi!');
    }

    public function destroy($id)
    {
        $this->todoService->delete($id);
        return redirect()->route('todo.index')->with('success', 'Todo silindi!');
    }
}