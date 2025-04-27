<?php
namespace App\Repositories\Eloquent;

use App\Models\Deal;
use App\Repositories\Contracts\DealRepositoryInterface;

class DealRepository implements DealRepositoryInterface
{
    public function __construct(private Deal $model) {}

    public function paginate(int $perPage = 15)
    { return $this->model->latest()->paginate($perPage); }

    public function find(int $id): Deal
    { return $this->model->findOrFail($id); }

    public function create(array $data): Deal
    { return $this->model->create($data); }

    public function update(int $id, array $data): Deal
    { $d = $this->find($id); $d->update($data); return $d; }

    public function delete(int $id): bool
    { return $this->find($id)->delete(); }
}