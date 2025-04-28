<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Services\DealService;
use App\Models\Company;
use App\Models\Contact;

class DealController extends Controller
{
    /** @var DealService */
    private DealService $svc;

    public function __construct(DealService $svc)
    {
        $this->svc = $svc;
    }

    /* ----------------------------------------------------------
     |  LISTE  –  /crm/deals  (AJAX tablo veya tam sayfa)
     * -------------------------------------------------------- */
    public function index()
    {
        if (request()->ajax()) {
            $deals = $this->svc->paginate();
            return view('deals.table', compact('deals'))->render();
        }

        /*  Create modalındaki dropdown’lar için Company & Contact listesi  */
        $companies = Company::orderBy('name')->pluck('name', 'id');
        $contacts  = Contact::orderBy('first_name')
                     ->select(DB::raw("id, CONCAT(first_name,' ',last_name) as full_name"))
                     ->pluck('full_name', 'id');

        return view('deals.index', compact('companies', 'contacts'));
    }

    /* ----------------------------------------------------------
     |  CREATE  –  POST /crm/deals
     * -------------------------------------------------------- */
    public function store(Request $r): JsonResponse
    {
        $data = $r->validate([
            'title'       => 'required|string|max:150',
            'amount'      => 'nullable|numeric|min:0',
            'stage'       => 'required|in:new,qualified,proposal,negotiation,won,lost',
            'close_date'  => 'nullable|date',
            'company_id'  => 'nullable|exists:companies,id',
            'contact_id'  => 'nullable|exists:contacts,id',
            'description' => 'nullable|string',
        ]);

        $this->svc->store($data);
        return response()->json(['success' => true]);
    }

    /* ----------------------------------------------------------
     |  EDIT MODAL BODY  –  GET /crm/deals/{id}/edit
     * -------------------------------------------------------- */
    public function edit(int $id)
    {
        $deal      = $this->svc->find($id);
        $companies = Company::orderBy('name')->pluck('name', 'id');
        $contacts  = Contact::orderBy('first_name')
                      ->select(DB::raw("id, CONCAT(first_name,' ',last_name) as full_name"))
                      ->pluck('full_name', 'id');

        return view('deals.modal.edit', compact('deal', 'companies', 'contacts'));
    }

    /* ----------------------------------------------------------
     |  UPDATE  –  PUT /crm/deals/{id}
     * -------------------------------------------------------- */
    public function update(Request $r, int $id): JsonResponse
    {
        $data = $r->validate([
            'title'       => 'required|string|max:150',
            'amount'      => 'nullable|numeric|min:0',
            'stage'       => 'required|in:new,qualified,proposal,negotiation,won,lost',
            'close_date'  => 'nullable|date',
            'company_id'  => 'nullable|exists:companies,id',
            'contact_id'  => 'nullable|exists:contacts,id',
            'description' => 'nullable|string',
        ]);

        $this->svc->update($id, $data);
        return response()->json(['success' => true]);
    }

    /* ----------------------------------------------------------
     |  DELETE  –  DELETE /crm/deals/{id}
     * -------------------------------------------------------- */
    public function destroy(int $id): JsonResponse
    {
        $this->svc->destroy($id);
        return response()->json(['success' => true]);
    }



    // DealController.php
    public function kanban()
    {
        $stages = ['new','qualified','proposal','negotiation','won','lost'];

        $deals  = $this->svc->paginate(9999);   // tüm fırsatlar
        // her aşama için mutlaka anahtar oluştur
        $group  = collect($stages)->mapWithKeys(fn($s)=>
                    [$s => $deals->where('stage',$s)]
                );

        return view('deals.kanban', compact('group','stages'));
    }
}