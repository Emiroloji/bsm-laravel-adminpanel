<?php

namespace App\Services;

use App\Repositories\Contracts\ActivityRepositoryInterface;

class ActivityService
{
    protected ActivityRepositoryInterface $repo;

    public function __construct(ActivityRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Bir subject için tüm aktiviteleri döner.
     */
    public function allBySubject(string $subjectType, int $subjectId)
    {
        return $this->repo->allBySubject($subjectType, $subjectId);
    }

    /**
     * Yeni bir aktivite oluşturur.
     */
    public function create(array $data)
    {
        return $this->repo->create($data);
    }
}