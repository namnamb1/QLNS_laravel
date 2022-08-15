<?php

namespace App\Http\Controllers;

use App\Member;
use App\MemberLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $year = MemberLeave::select(DB::raw('Year(date_leave) as year'))
            ->groupBy(DB::raw("Year(date_leave)"))
            ->pluck('year');

        $time = $request->time ?? date("Y");

        $arrayMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            array_push($arrayMonth, $i);
        }

        $memberLeave = MemberLeave::select(DB::raw('COUNT(*) as count'),)
            ->join('members', 'member_leave.member_id', '=', 'members.id')
            ->whereYear('date_leave', $time)
            ->whereIn(DB::raw('MONTH(date_leave)'), $arrayMonth)
            ->groupBy(DB::raw("MONTH(date_leave)"))
            ->pluck('count');

        // dd($memberLeave);
        $month = MemberLeave::select(DB::raw('MONTH(date_leave) as month'))
            ->whereYear('date_leave', $time)
            ->whereIn(DB::raw('MONTH(date_leave)'), $arrayMonth)
            ->groupBy(DB::raw("MONTH(date_leave)"))
            ->pluck('month');
        // dd($month);
        $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($month as $index => $mon) {
            if (!empty($memberLeave)) {
                if (empty($memberLeave[$index])) {
                    $memberLeave[$index] = 0;
                }
                $data[$mon - 1] = $memberLeave[$index];
            }
        }
        //  dd($data);  

        $member = Member::select(DB::raw('COUNT(*) as count'), 'departments.department_name as department_name')
            ->where('status', '=', '2')
            ->join('departments', 'members.department_id', '=', 'departments.id')
            ->groupBy('members.department_id')
            ->pluck('count', 'department_name');
        //   dd($member);

        return view('home.index', compact('member', 'data', 'year','time'));
    }
}
