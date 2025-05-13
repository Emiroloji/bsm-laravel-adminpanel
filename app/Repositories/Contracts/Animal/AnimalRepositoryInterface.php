<?php

namespace App\Repositories\Contracts\Animal;

use App\Models\Animal\Animal;

interface AnimalRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Animal[]
     */
    public function all();

    /**
     * @param  int  $id
     * @return Animal|null
     */
    public function find(int $id): ?Animal;

    /**
     * @param  array  $data
     * @return Animal
     */
    public function create(array $data): Animal;

    /**
     * @param  int    $id
     * @param  array  $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool;
}