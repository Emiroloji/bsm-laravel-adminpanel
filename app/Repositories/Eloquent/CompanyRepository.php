<?php
namespace App\Repositories\Eloquent;

use App\Models\Company;

class CompanyRepository
{
    public function __construct(private Company $model) {}

    public function paginate(int $perPage = 15)
    { return $this->model->latest()->paginate($perPage); }

    public function find(int $id): Company
    { return $this->model->findOrFail($id); }

    public function create(array $data): Company
    { return $this->model->create($data); }

    public function update(int $id, array $data): Company
    { $c = $this->find($id); $c->update($data); return $c; }

    public function delete(int $id): bool
    { return $this->find($id)->delete(); }
}