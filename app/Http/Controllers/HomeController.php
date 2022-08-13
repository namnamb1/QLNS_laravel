<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $memberLeave = Member::select(DB::raw('COUNT(*) as count'), 'members.name as name');
        return view('home.index');
    }
}
