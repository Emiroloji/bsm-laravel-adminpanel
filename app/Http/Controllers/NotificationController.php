<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notifications()->paginate(10);
        return view('notifications.index', compact('notes'));
    }

    public function markRead($id)
    {
        $note = auth()->user()->notifications()->findOrFail($id);
        $note->markAsRead();
        return back();
    }
}