<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Http\Controllers\Controller;
use AC\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @var Page
     */
    private $page;

    private $data;

    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->data['pages'] = $this->page->orderBy('id', 'desc')->get();

        return view('dashboard.pages.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.pages.create');
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
            'order' => $request['order'] ? $request['order'] : null,
            'position' => $request['position']
        ]);
        $msg = 'Page was created successfully!';

        return redirect()->action('Dashboard\PageController@index')->with('success', $msg);
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

        return view('dashboard.pages.edit', $this->data);
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
        $page->order = $request['order'] ? $request['order'] : null;
        $page->position = $request['position'];
        $page->save();
        $msg = 'Page was updated successfully!';

        return redirect()->action('Dashboard\PageController@index')->with('success', $msg);
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

        return redirect()->action('Dashboard\PageController@index')->with('success', $msg);
    }
}
