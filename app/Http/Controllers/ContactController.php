<?php

namespace App\Http\Controllers;   // ← BU satır tam olarak böyle olmalı!

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\ContactService;

class ContactController extends Controller
{
    /** @var ContactService */
    private ContactService $svc;

    public function __construct(ContactService $svc)
    {
        // Service tek katman—IOC container otomatik çözer
        $this->svc = $svc;
    }

    /* ---------------------------------------------------- *
     |  LISTE
     * ---------------------------------------------------- */
    public function index()
    {
        // AJAX isteği ise yalnızca tablo gövdesini döndür
        if (request()->ajax()) {
            $contacts = $this->svc->paginate();
            return view('contacts.table', compact('contacts'))->render();
        }

        // Normal page load
        return view('contacts.index');
    }

    /* ---------------------------------------------------- *
     |  CREATE
     * ---------------------------------------------------- */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'nullable|string|max:50',
            'email'      => 'required|email|unique:contacts,email',
            'phone'      => 'nullable|string|max:20',
            'position'   => 'nullable|string|max:50',
            'address'    => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $this->svc->store($data);

        return response()->json(['success' => true]);
    }

    /* ---------------------------------------------------- *
     |  EDIT FORM (modal body)
     * ---------------------------------------------------- */
    public function edit(int $id)
    {
        $contact = $this->svc->find($id);
        return view('contacts.modal.edit', compact('contact'));
    }

    /* ---------------------------------------------------- *
     |  UPDATE
     * ---------------------------------------------------- */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'nullable|string|max:50',
            'email'      => 'required|email|unique:contacts,email,'.$id,
            'phone'      => 'nullable|string|max:20',
            'position'   => 'nullable|string|max:50',
            'address'    => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $this->svc->update($id, $data);

        return response()->json(['success' => true]);
    }

    /* ---------------------------------------------------- *
     |  DELETE
     * ---------------------------------------------------- */
    public function destroy(int $id): JsonResponse
    {
        $this->svc->destroy($id);
        return response()->json(['success' => true]);
    }
}