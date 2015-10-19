<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Http\Controllers\Controller;
use AC\Http\Requests;
use DB;

class ClassificationController extends Controller
{
    public function index()
    {
        $classifications = DB::table('classifications')->orderBy('name')->get(['id', 'name']);
        return view('dashboard.classifications.index', ['classifications' => $classifications]);
    }
}
