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
        return view('todo.index');

    }
    public function table()
    {
        $todos = $this->todoService->getAll();
        return view('todo.table.todoTable', compact('todos'));
    }
    public function modalCreate()
    {
        return view('todo.modal.create');
    }
    public function store(StoreTodoRequest $request)
    {
        $this->todoService->create($request->validated());
        return redirect()->route('todo.index')->with('success', 'Yeni todo eklendi!');    }

    public function update(UpdateTodoRequest $request, $id)
    {
        $this->todoService->update($id, $request->validated());

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('todo.index')->with('success', 'Todo güncellendi!');
    }

    public function destroy($id)
    {
        $this->todoService->delete($id);
        return redirect()->route('todo.index')->with('success', 'Todo silindi!');
    }

    public function toggleStatus($id)
    {
        $todo = $this->todoService->getById($id);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();

        return response()->json(['success' => true, 'status' => $todo->is_completed]);
    }
    public function getTodo($id)
    {
        $todo = $this->todoService->getById($id);
        return response()->json($todo);
    }


    public function modalEdit($id)
{
    $todo = $this->todoService->getById($id);
    return view('todo.modal.edit', compact('todo'));
}
}