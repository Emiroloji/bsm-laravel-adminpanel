<?php

namespace App\Repositories\Eloquent\Animal;

use App\Models\Animal\AnimalOwner;
use App\Repositories\Contracts\Animal\AnimalOwnerRepositoryInterface;
use Illuminate\Support\Collection;

class AnimalOwnerRepository implements AnimalOwnerRepositoryInterface
{
    protected AnimalOwner $model;

    public function __construct(AnimalOwner $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?AnimalOwner
    {
        return $this->model->find($id);
    }

    public function create(array $data): AnimalOwner
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $owner = $this->model->findOrFail($id);
        return $owner->update($data);
    }

    public function delete(int $id): bool
    {
        $owner = $this->model->findOrFail($id);
        return $owner->delete();
    }
}