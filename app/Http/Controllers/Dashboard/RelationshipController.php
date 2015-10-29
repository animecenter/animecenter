<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Relationship;
use DB;
use Illuminate\Http\Request;

class RelationshipController extends DashboardController
{
    /**
     * @var Relationship
     */
    private $relationship;

    /**
     * @param Relationship $relationship
     */
    public function __construct(Relationship $relationship)
    {
        $this->relationship = $relationship;
    }

    public function index()
    {
        return view('dashboard.relationships.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.relationships.create');
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
        $relationship = new $this->relationship();
        $relationship->name = $request['name'];
        $relationship->active = $request['active'] === '1' ? 1 : 0;
        $relationship->save();
        $msg = 'Relationship was created successfully!';

        return redirect()->action('Dashboard\RelationshipController@index')->with('success', $msg);
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
            'dashboard.relationships.edit',
            ['relationship' => DB::table('relationships')->where('id', '=', $id)->first()]
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
    public function postEdit($id = 0, Request $request)
    {
        $relationship = $this->relationship->findOrFail($id);
        $relationship->name = $request['name'];
        $relationship->active = $request['active'] === '1' ? 1 : 0;
        $relationship->save();
        $msg = 'Relationship was edited successfully!';

        return redirect()->action('Dashboard\RelationshipController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.relationships.index');
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
        $this->relationship->findOrFail($id)->delete();
        $msg = 'Relationship was trashed successfully!';

        return redirect()->action('Dashboard\RelationshipController@index')->with('success', $msg);
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
        $this->relationship->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Relationship was deleted successfully!';

        return redirect()->action('Dashboard\RelationshipController@getTrash')->with('success', $msg);
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
        $this->relationship->withTrashed()->findOrFail($id)->restore();
        $msg = 'Relationship was recovered successfully!';

        return redirect()->action('Dashboard\RelationshipController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'relationships';
        $list = collect(
            DB::table('relationships')->where('deleted_at', '=', null)->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'relationships';
        $list = collect(
            DB::table('relationships')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
