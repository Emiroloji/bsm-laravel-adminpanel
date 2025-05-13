<?php

namespace App\Repositories\Contracts\Animal;

use App\Models\Animal\AnimalOwner;
use Illuminate\Support\Collection;

interface AnimalOwnerRepositoryInterface
{
    /**
     * Tüm sahipleri getirir.
     *
     * @return Collection|AnimalOwner[]
     */
    public function all(): Collection;

    /**
     * Tek bir sahibi getirir.
     *
     * @param  int  $id
     * @return AnimalOwner|null
     */
    public function find(int $id): ?AnimalOwner;

    /**
     * Yeni sahip oluşturur.
     *
     * @param  array  $data
     * @return AnimalOwner
     */
    public function create(array $data): AnimalOwner;

    /**
     * Mevcut sahip bilgisini günceller.
     *
     * @param  int    $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Sahibi siler.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool;
}