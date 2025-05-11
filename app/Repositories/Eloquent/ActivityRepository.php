<?php

namespace App\Repositories\Eloquent;

use App\Models\Activity;
use App\Repositories\Contracts\ActivityRepositoryInterface;

class ActivityRepository implements ActivityRepositoryInterface
{
    protected Activity $model;

    public function __construct(Activity $model)
    {
        $this->model = $model;
    }

    public function allBySubject(string $subjectType, int $subjectId)
    {
        return $this->model
                    ->where('subject_type', $subjectType)
                    ->where('subject_id', $subjectId)
                    ->orderByDesc('created_at')
                    ->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // ❶ Güncelleme: verilen ID ile record’u bulup günceller
    public function update(int $id, array $data)
    {
        $activity = $this->model->findOrFail($id);
        $activity->update($data);
        return $activity;
    }

    // ❷ Silme: verilen ID’ye sahip record’u siler
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}