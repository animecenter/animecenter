<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Images\Image;
use Illuminate\Auth\Guard;

class ImageController extends Controller
{
    /**
     * @var Image
     */
    private $image;

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param Image $image
     * @param Guard $auth
     */
    public function __construct(Image $image, Guard $auth)
    {
        $this->image = $image;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['images'] = $this->image->all();
        $this->data['user'] = $this->auth->user();

        return view('admin.images.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id = 0)
    {
        $image = $this->image->findOrFail($id);
        unlink(public_path("images/" . $image['image']));
        $image->delete();
        $msg = 'Anime was deleted successfully!';

        return redirect()->action('Admin\ImageController@index')->with('success', $msg);
    }
}
