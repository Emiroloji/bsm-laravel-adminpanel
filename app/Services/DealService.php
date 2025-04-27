<?php
namespace App\Services;

/* 1. satır: interface yerine concrete class'ı kullan */
use App\Repositories\Eloquent\DealRepository;

class DealService
{
    /* 2. satır: type-hint artık DealRepository */
    public function __construct(private DealRepository $repo) {}

    public function paginate($p = 15)         { return $this->repo->paginate($p); }
    public function find($id)                 { return $this->repo->find($id); }
    public function store(array $d)           { return $this->repo->create($d); }
    public function update($id,array $d)      { return $this->repo->update($id,$d); }
    public function destroy($id)              { return $this->repo->delete($id); }
    public function moveStage($id,$stage)     { return $this->repo->update($id,['stage'=>$stage]); }
}