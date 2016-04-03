<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Genre;
use DB;
use Illuminate\Http\Request;

class GenreController extends DashboardController
{
    /**
     * @var Genre
     */
    private $genre;

    /**
     * @param Genre $genre
     */
    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function index()
    {
        return view('dashboard.genres.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.genres.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $genre = new $this->genre();
        $genre->name = $request['name'];
        $genre->model = $request['model'];
        $genre->description = $request['description'];
        $genre->active = $request['active'] === '1' ? 1 : 0;
        $genre->save();
        $msg = 'Genre was created successfully!';

        return redirect()->action('Dashboard\GenreController@index')->with('success', $msg);
    }

    /**
     * Show the form for editing a resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function getEdit($id = 0)
    {
        return view(
            'dashboard.genres.edit',
            ['genre' => DB::table('genres')->where('id', '=', $id)->first()]
        );
    }

    /**
     * Edit a resource.
     *
     * @param int     $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, Request $request)
    {
        $genre = $this->genre->findOrFail($id);
        $genre->name = $request['name'];
        $genre->model = $request['model'];
        $genre->description = $request['description'];
        $genre->active = $request['active'] === '1' ? 1 : 0;
        $genre->save();
        $msg = 'Genre was edited successfully!';

        return redirect()->action('Dashboard\GenreController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.genres.index');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->genre->findOrFail($id)->delete();
        $msg = 'Genre was trashed successfully!';

        return redirect()->action('Dashboard\GenreController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->genre->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Genre was deleted successfully!';

        return redirect()->action('Dashboard\GenreController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->genre->withTrashed()->findOrFail($id)->restore();
        $msg = 'Genre was recovered successfully!';

        return redirect()->action('Dashboard\GenreController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'genres';
        $list = collect(
            DB::table('genres')->where('deleted_at', '=', null)->get(['id', 'name', 'model', 'active'])
        );
        $showColumns = ['name', 'model', 'active', 'actions'];
        $searchColumns = ['name', 'model', 'active'];
        $orderColumns = ['name', 'model', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'genres';
        $list = collect(
            DB::table('genres')->where('deleted_at', '<>', '')->get(['id', 'name', 'model', 'active'])
        );
        $showColumns = ['name', 'model', 'active', 'actions'];
        $searchColumns = ['name', 'model', 'active'];
        $orderColumns = ['name', 'model', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
