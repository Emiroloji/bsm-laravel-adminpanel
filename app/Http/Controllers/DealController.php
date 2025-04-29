<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Services\DealService;
use App\Models\Company;
use App\Models\Contact;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DealProposalExport;

class DealController extends Controller
{
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
            'title'              => 'required|string|max:150',
            'amount'             => 'nullable|numeric|min:0',
            'stage'              => 'required|in:new,qualified,proposal,negotiation,won,lost',
            'close_date'         => 'nullable|date',
            'company_id'         => 'nullable|exists:companies,id',
            'contact_id'         => 'nullable|exists:contacts,id',
            'description'        => 'nullable|string',
            // items için
            'items'              => 'nullable|array',
            'items.*.name'       => 'required_with:items|string|max:255',
            'items.*.quantity'   => 'required_with:items|integer|min:1',
            'items.*.unit_price' => 'required_with:items|numeric|min:0',
        ]);

        // Servis imzası: create, delete, update – store(/destroy) yok
        $this->svc->create($data);

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
            'title'              => 'required|string|max:150',
            'amount'             => 'nullable|numeric|min:0',
            'stage'              => 'required|in:new,qualified,proposal,negotiation,won,lost',
            'close_date'         => 'nullable|date',
            'company_id'         => 'nullable|exists:companies,id',
            'contact_id'         => 'nullable|exists:contacts,id',
            'description'        => 'nullable|string',
            // items için
            'items'              => 'nullable|array',
            'items.*.name'       => 'required_with:items|string|max:255',
            'items.*.quantity'   => 'required_with:items|integer|min:1',
            'items.*.unit_price' => 'required_with:items|numeric|min:0',
        ]);

        $this->svc->update($id, $data);

        return response()->json(['success' => true]);
    }


    /* ----------------------------------------------------------
     |  DELETE  –  DELETE /crm/deals/{id}
     * -------------------------------------------------------- */
    public function destroy(int $id): JsonResponse
    {
        // Service’da metot adı delete
        $this->svc->delete($id);

        return response()->json(['success' => true]);
    }

    /* ----------------------------------------------------------
     |  KANBAN  –  GET /crm/deals/kanban
     * -------------------------------------------------------- */
    public function kanban()
    {
        // Tüm aşamaları kesin sırayla tanımla
        $stages = ['new', 'qualified', 'proposal', 'negotiation', 'won', 'lost'];

        // Hepsini getir
        $deals = $this->svc->paginate(9999);

        // Her aşama için grupla
        $group = collect($stages)
            ->mapWithKeys(fn($s) => [
                $s => $deals->where('stage', $s)
            ]);

        return view('deals.kanban', compact('group', 'stages'));
    }

    /* ----------------------------------------------------------
     |  MOVE  –  PATCH /crm/deals/{id}/move
     * -------------------------------------------------------- */
    public function move(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'new_stage' => 'required|string|in:new,qualified,proposal,negotiation,won,lost',
        ]);

        $deal = $this->svc->move($id, $request->new_stage);

        return response()->json($deal);
    }


    // Excel
    public function exportExcel(int $id)
    {
        $deal = $this->svc->find($id);
        return Excel::download(
            new DealProposalExport($deal),
            "teklif-{$id}.xlsx"
        );
    }

    // PDF
    public function exportPdf(int $id)
    {
        $deal = $this->svc->find($id);
        $pdf  = Pdf::loadView('deals.proposal', compact('deal'));
        return $pdf->download("teklif-{$id}.pdf");
    }

    public function viewProposal(int $id)
    {
        $deal = $this->svc->find($id);
        $pdf  = Pdf::loadView('deals.proposal', compact('deal'));

        // Browser’da açmak için stream()
        return $pdf->stream("teklif-{$deal->id}.pdf");
    }
}