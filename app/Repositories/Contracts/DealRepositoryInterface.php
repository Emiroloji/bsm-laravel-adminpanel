<?php
namespace App\Repositories\Contracts;

use App\Models\Deal;                // ← Bu kullanımı ekle
use Illuminate\Support\Collection;  // ← Collection türü belirtsen iyi olur

interface DealRepositoryInterface
{
    public function paginate(int $perPage = 15);
    public function find(int $id): Deal;
    public function create(array $data): Deal;
    public function update(int $id, array $data): Deal;
    public function delete(int $id): bool;

    /**
     * Kanban görünümü için tüm deal’ları durumlarına göre getirir
     *
     * @return array<string, Collection<Deal>>
     */
    public function getAllGroupedByStatus(): array;

    /**
     * Bir deal’ın status’unu günceller
     *
     * @param  int    $id
     * @param  string $newStatus
     * @return Deal
     */
    public function updateStatus(int $id, string $newStatus): Deal;
}