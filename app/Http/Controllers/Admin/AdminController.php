<?php

namespace AC\Http\Controllers\Admin;

use AC\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class AdminController extends Controller
{
    private $data;

    /**
     * @var
     */
    private $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->data['user'] = $this->auth->user();

        return view('admin.index', $this->data);
    }
}
