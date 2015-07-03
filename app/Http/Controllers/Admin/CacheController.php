<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getPurge()
    {
        $cache_path = base_path() . '/../nginx-cache/*';
        exec("rm -rf $cache_path");
        $msg = 'Cache purge initiated successfully';

        return redirect()->back()->with('success', $msg);
    }
}
