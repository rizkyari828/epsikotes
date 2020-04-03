<?php

namespace App\Http\Controllers;

use App\Model\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicantListController extends Controller
{
    public function index(Request $request)
    {
        $psikotes_status = $request->get('status');
        $schedule = new Schedules();

        $roleType  = $request->session()->get('user.roleType');
        if($roleType === 'VIEW_ALL_NETWORK'){
            $paramFilter['cabangId'] = null;
        } else if ($roleType === 'VIEW_BY_NETWORK'){
            $paramFilter['cabangId'] = $request->session()->get('user.cabangId');
        }

        $result = $schedule->getScheduleByStatusPsikotes($paramFilter, $psikotes_status)
            ->get();
        $data = [
            'result' => $result,
            'statusLabel' => Str::title(str_replace('_', ' ', $psikotes_status))
        ];
        return view('pages.ApplicantList', $data);
    }
}
