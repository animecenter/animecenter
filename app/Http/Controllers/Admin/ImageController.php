<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Images\Image;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

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
        $this->data['images'] = $this->image->orderBy('date', 'desc')->get();
        $this->data['user'] = $this->auth->user();

        return view('admin.images.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $this->data['user'] = $this->auth->user();

        return view('admin.images.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        try {
            $filename = rand(00000000, 99999999) . '_' . $request['file']->getClientOriginalName();
            $request['file']->move("images/", $filename);
            chmod(public_path("images/" . $filename), 0644);
        } catch (Exception $e) {
            dd($e);
        }
        $this->image->create([
            'bigtitle' => $request['bigtitle'],
            'smalltitle' => $request['smalltitle'],
            'desc' => $request['desc'],
            'file' => $filename,
            'link' => $request['link'],
            'date' => date("Y-m-d H:i:s")
        ]);
        $msg = 'Image was created successfully!';

        return redirect()->action('Admin\ImageController@index')->with('success', $msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id = 0)
    {
        $this->data['image'] = $this->image->findorFail($id);
        $this->data['user'] = $this->auth->user();

        return view('admin.images.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id = 0, Request $request)
    {
        $image = $this->image->findOrFail($id);
        if ($request['new_file']) {
            try {
                $filename = rand(00000000, 99999999) . '_' . $request['new_file']->getClientOriginalName();
                $request['new_file']->move("images/", $filename);
                chmod(public_path("images/" . $filename), 0644);
                if ($image['file']) {
                    unlink(public_path("images/" . $image['file']));
                }
                $image->file = $filename;
            } catch (Exception $e) {
                dd($e);
            }
        }
        $image->bigtitle = $request['bigtitle'];
        $image->smalltitle = $request['smalltitle'];
        $image->desc = $request['desc'];
        $image->link = $request['link'];
        $image->date = date("Y-m-d H:i:s");
        $image->save();
        $msg = 'Image was updated successfully!';

        return redirect()->action('Admin\ImageController@index')->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id = 0)
    {
        $image = $this->image->findOrFail($id);
        unlink(public_path("images/" . $image['file']));
        $image->delete();
        $msg = 'Image was deleted successfully!';

        return redirect()->action('Admin\ImageController@index')->with('success', $msg);
    }
}
