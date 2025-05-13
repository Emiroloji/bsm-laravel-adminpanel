<?php

namespace App\Http\Controllers\Animal;

use App\Http\Controllers\Controller;
use App\Services\Animal\AnimalService;
use Illuminate\Http\Request;
use App\Models\Animal\AnimalOwner;
use App\Repositories\Eloquent\Animal\AnimalOwnerRepository;

class AnimalController extends Controller
{
    protected AnimalService $service;
    protected AnimalOwnerRepository $ownerRepo;

    public function __construct()
    {
        $this->service   = new AnimalService();
        $this->ownerRepo = new AnimalOwnerRepository(new AnimalOwner());
    }

    public function index()
    {
        $list = $this->service->all();
        return view('animal.index', compact('list'));
    }

    public function show($id)
    {
        $animal = $this->service->find($id);
        return view('animal.show', compact('animal'));
    }

    public function create()
    {
        $owners = $this->ownerRepo->all();
        return view('animal.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string',
            'species'    => 'required|string',
            'breed'      => 'nullable|string',
            'birth_date' => 'nullable|date',
            'weight'     => 'nullable|numeric',
            'owner_id'   => 'required|exists:animal_owners,id',
        ]);

        $this->service->create($data);

        return redirect()->route('animal.index');
    }

    public function edit($id)
    {
        $animal = $this->service->find($id);
        $owners = $this->ownerRepo->all();
        return view('animal.edit', compact('animal','owners'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'       => 'required|string',
            'species'    => 'required|string',
            'breed'      => 'nullable|string',
            'birth_date' => 'nullable|date',
            'weight'     => 'nullable|numeric',
        ]);

        $this->service->update($id, $data);

        return back();
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back();
    }
}