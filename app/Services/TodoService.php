<?php

namespace App\Services;

use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoService
{
    protected TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }


    public function getAll(array $filters = [])
    {
        return $this->todoRepository->all($filters);
    }

    public function getById(int $id)
    {
        return $this->todoRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->todoRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->todoRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->todoRepository->delete($id);
    }
}