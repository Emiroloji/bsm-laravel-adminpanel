<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function paginate($per = 15)   { return Contact::latest()->paginate($per); }
    public function find($id)             { return Contact::findOrFail($id); }
    public function store($data)          { return Contact::create($data); }
    public function update($id,$data)     { $c=$this->find($id); $c->update($data); return $c; }
    public function destroy($id)          { return $this->find($id)->delete(); }
}