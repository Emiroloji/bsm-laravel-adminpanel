<?php

namespace App\Repositories\Eloquent;

use App\Models\Contact;

use App\Repositories\Contracts\ContactRepositoryInterface;





class ContactRepository implements ContactRepositoryInterface
{
    protected Contact $model;
    public function __construct(Contact $model) { $this->model = $model; }
    public function paginate($perPage = 15)     { return $this->model->latest()->paginate($perPage); }
    public function find($id)                   { return $this->model->findOrFail($id); }
    public function create($data)               { return $this->model->create($data); }
    public function update($id,$data)           { $c=$this->find($id); $c->update($data); return $c; }
    public function delete($id)                 { return $this->find($id)->delete(); }
}