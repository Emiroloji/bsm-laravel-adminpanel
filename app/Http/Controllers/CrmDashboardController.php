<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deal;
use App\Models\Contact;
use Carbon\Carbon;

class CrmDashboardController extends Controller
{
    public function index()
    {
        $openDeals = Deal::whereNotIn('stage', ['won','lost'])->count();
        $totalContacts = Contact::count();

        $stages = Deal::selectRaw('stage, count(*) as count')
            ->groupBy('stage')
            ->pluck('count','stage')
            ->toArray();

        $start = Carbon::now()->startOfMonth();
        $end   = Carbon::now()->endOfMonth();
        $raw = Contact::whereBetween('created_at', [$start,$end])
            ->selectRaw('DATE(created_at) as date, count(*) as cnt')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('cnt','date')
            ->toArray();

        $days = [];
        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $days[$d->format('d.m')] = $raw[$d->toDateString()] ?? 0;
        }

        return view('crm.dashboard', compact(
            'openDeals','totalContacts','stages','days'
        ));
    }
}