<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Repositories\Eloquent\ActivityRepository;
use App\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected ActivityService $activitySvc;

    public function __construct()
    {
        // Repository ve Service örneklemesi
        $repo = new ActivityRepository(new Activity());
        $this->activitySvc = new ActivityService($repo);
    }

    public function index(string $subjectType, int $subjectId)
    {
        // Burada $activities adında değişken tanımlıyoruz
        $activities = $this->activitySvc->allBySubject($subjectType, $subjectId);

        // Sonra compact ile o ismi gönderiyoruz
        return view('activities.table.activitiesTable', compact('activities'));
    }


    public function store(Request $req)
    {
        $data = $req->validate([
            'subject_type' => 'required|string',
            'subject_id'   => 'required|int',
            'type'         => 'required|string',
            'comment'      => 'nullable|string',
            'due_at'       => 'nullable|date',
        ]);
        $this->activitySvc->create($data);
        return response()->json(['success' => true]);
    }
}