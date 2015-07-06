<?php

namespace App\Http\Controllers\Admin;

use App\Pages\Page;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @var Page
     */
    private $page;

    /**
     * @var Guard
     */
    private $auth;

    private $data;

    /**
     * @param Page $page
     * @param Guard $auth
     */
    public function __construct(Page $page, Guard $auth)
    {
        $this->page = $page;
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
        $this->data['pages'] = $this->page->orderBy('id', 'desc')->get();

        return view('admin.pages.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        $this->data['user'] = $this->auth->user();

        return view('admin.pages.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $this->page->create([
            'title' => $request['title'],
            'content' => $request['content'],
            'link' => $request['link'],
            'order' => $request['order'] ? $request['order'] : NULL,
            'position' => $request['position']
        ]);
        $msg = 'Page was created successfully!';

        return redirect()->action('Admin\PageController@index')->with('success', $msg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id = 0)
    {
        $this->data['page'] = $this->page->findOrFail($id);
        $this->data['user'] = $this->auth->user();

        return view('admin.pages.edit', $this->data);
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
        $page = $this->page->findOrFail($id);
        $page->title = $request['title'];
        $page->content = $request['content'];
        $page->link = $request['link'];
        $page->order = $request['order'] ? $request['order'] : NULL;
        $page->position = $request['position'];
        $page->save();
        $msg = 'Page was updated successfully!';

        return redirect()->action('Admin\PageController@index')->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id = 0)
    {
        $this->page->findOrFail($id)->delete();
        $msg = 'Page was deleted successfully!';

        return redirect()->action('Admin\PageController@index')->with('success', $msg);
    }
}
