<?php
namespace App\Repositories\Eloquent;

use App\Models\Deal;
use App\Repositories\Contracts\DealRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DealRepository implements DealRepositoryInterface
{
    public function __construct(private Deal $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function find(int $id): Deal
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Deal
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Deal
    {
        $d = $this->find($id);
        $d->update($data);
        return $d;
    }

    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }

    public function getAllGroupedByStatus(): array
    {
        return $this->model->all()
            ->groupBy('stage')
            ->toArray();
    }

    public function updateStatus(int $id, string $newStatus): Deal
    {
        $deal = $this->find($id);
        $deal->stage = $newStatus;
        $deal->save();
        return $deal;
    }
}