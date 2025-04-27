<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    /** @var CompanyService */
    private CompanyService $svc;

    public function __construct(CompanyService $svc)
    {
        $this->svc = $svc;
    }

    /*--------------------------------------------------------------
     |  LISTE / AJAX TABLO
     *--------------------------------------------------------------*/
    public function index()
    {
        if (request()->ajax()) {
            $companies = $this->svc->paginate();
            return view('companies.table', compact('companies'))->render();
        }

        return view('companies.index');
    }

    /*--------------------------------------------------------------
     |  CREATE
     *--------------------------------------------------------------*/
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'       => 'required|string|max:150',
            'legal_name' => 'nullable|string|max:150',
            'tax_number' => 'nullable|string|max:50',
            'phone'      => 'nullable|string|max:25',
            'email'      => 'nullable|email|max:120|unique:companies,email',
            'website'    => 'nullable|url|max:150',
            'industry'   => 'nullable|string|max:100',
            'size'       => 'nullable|in:small,medium,enterprise',
            'address'    => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $this->svc->store($data);

        return response()->json(['success' => true]);
    }

    /*--------------------------------------------------------------
     |  EDIT MODAL (body)
     *--------------------------------------------------------------*/
    public function edit(int $id)
    {
        $company = $this->svc->find($id);
        return view('companies.modal.edit', compact('company'));
    }

    /*--------------------------------------------------------------
     |  UPDATE
     *--------------------------------------------------------------*/
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'name'       => 'required|string|max:150',
            'legal_name' => 'nullable|string|max:150',
            'tax_number' => 'nullable|string|max:50',
            'phone'      => 'nullable|string|max:25',
            'email'      => "nullable|email|max:120|unique:companies,email,{$id}",
            'website'    => 'nullable|url|max:150',
            'industry'   => 'nullable|string|max:100',
            'size'       => 'nullable|in:small,medium,enterprise',
            'address'    => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $this->svc->update($id, $data);

        return response()->json(['success' => true]);
    }

    /*--------------------------------------------------------------
     |  DELETE
     *--------------------------------------------------------------*/
    public function destroy(int $id): JsonResponse
    {
        $this->svc->destroy($id);
        return response()->json(['success' => true]);
    }
}