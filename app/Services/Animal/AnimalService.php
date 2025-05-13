<?php

namespace App\Services\Animal;

use App\Repositories\Eloquent\Animal\AnimalRepository;
use App\Models\Animal\Animal;

class AnimalService
{
    protected AnimalRepository $repo;

    public function __construct()
    {
        // Repository’e model’i enjekte ediyoruz
        $this->repo = new AnimalRepository(new Animal());
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }
}