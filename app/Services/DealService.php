<?php
namespace App\Services;

use App\Models\Deal;
use App\Repositories\Eloquent\DealRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DealService
{
    public function __construct(protected DealRepository $repo) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repo->paginate($perPage);
    }

    public function find(int $id): Deal
    {
        return $this->repo->find($id);
    }

    public function create(array $data): Deal
    {
        return $this->repo->create($data);
    }

    public function update(int $id, array $data): Deal
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }

    /** @return array<string, Collection<Deal>> */
    public function kanban(): array
    {
        // stage => Collection<Deal>
        return collect($this->repo->getAllGroupedByStatus())
               ->map(fn(array $rows) => collect($rows)->map(fn($d) => new Deal((array)$d)))
               ->toArray();
    }

    public function move(int $id, string $newStatus): Deal
    {
        return $this->repo->updateStatus($id, $newStatus);
    }
}