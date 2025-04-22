<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    public function all()
    {
        return Todo::all();
    }

    public function find(int $id)
    {
        return Todo::findOrFail($id);
    }

    public function create(array $data)
    {
        return Todo::create($data);
    }

    public function update(int $id, array $data)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($data);
        return $todo;
    }

    public function delete(int $id)
    {
        $todo = Todo::findOrFail($id);
        return $todo->delete();
    }
}