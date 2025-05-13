<?php

namespace App\Http\Controllers\Animal;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\Animal\AnimalOwnerRepository;
use App\Models\Animal\AnimalOwner;
use Illuminate\Http\Request;

class AnimalOwnerController extends Controller
{
    protected AnimalOwnerRepository $repo;

    public function __construct()
    {
        $this->repo = new AnimalOwnerRepository(new AnimalOwner());
    }

    public function index()
    {
        $owners = $this->repo->all();
        return view('animal.owner.index', compact('owners'));
    }

    public function create()
    {
        return view('animal.owner.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $this->repo->create($data);
        return redirect()->route('animal-owner.index');
    }

    public function edit($id)
    {
        $owner = $this->repo->find($id);
        return view('animal.owner.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $this->repo->update($id, $data);
        return redirect()->route('animal-owner.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return back();
    }
}