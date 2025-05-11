<?php

namespace App\Repositories\Contracts;

interface ActivityRepositoryInterface
{
    /**
     * Bir subject (Contact veya Deal) için tüm aktiviteleri getir.
     */
    public function allBySubject(string $subjectType, int $subjectId);

    /**
     * Yeni bir aktivite kaydı oluştur.
     */
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);

}