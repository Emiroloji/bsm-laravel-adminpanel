<?php

namespace App\Repositories\Eloquent\Animal;

use App\Models\Animal\Animal;
use App\Repositories\Contracts\Animal\AnimalRepositoryInterface;

class AnimalRepository implements AnimalRepositoryInterface
{
    protected $model;

    public function __construct(Animal $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('owner')->get();
    }

    public function find(int $id): ?Animal
    {
        return $this->model->with('owner')->find($id);
    }

    public function create(array $data): Animal
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $animal = $this->model->findOrFail($id);
        return $animal->update($data);
    }

    public function delete(int $id): bool
    {
        $animal = $this->model->findOrFail($id);
        return $animal->delete();
    }
}