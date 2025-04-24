<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = \App\Models\Todo::query();

        // Arama filtresi
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Tarih aralığı filtresi
        if (!empty($filters['date_start']) && !empty($filters['date_end'])) {
            $query->whereBetween('created_at', [$filters['date_start'], $filters['date_end']]);
        }

        return $query->orderByDesc('created_at')->get();
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