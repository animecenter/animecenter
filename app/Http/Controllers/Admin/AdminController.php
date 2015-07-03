<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private $data;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['user'] = Auth::user();

        return view('admin.index', $this->data);
    }
}
