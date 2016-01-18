<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Option;
use DB;
use Illuminate\Http\Request;

class OptionController extends DashboardController
{
    /**
     * @var Option
     */
    private $option;

    /**
     * @param Option $option
     */
    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    public function index()
    {
        return view('dashboard.options.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.options.create');
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
        $option = new $this->option();
        $option->name = $request['name'];
        $option->value = $request['value'];
        $option->active = $request['active'] === '1' ? 1 : 0;
        $option->save();
        $msg = 'Option was created successfully!';

        return redirect()->action('Dashboard\OptionController@index')->with('success', $msg);
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
            'dashboard.options.edit',
            ['option' => DB::table('options')->where('id', '=', $id)->first()]
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
        $option = $this->option->findOrFail($id);
        $option->name = $request['name'];
        $option->value = $request['value'];
        $option->active = $request['active'] === '1' ? 1 : 0;
        $option->save();
        $msg = 'Option was edited successfully!';

        return redirect()->action('Dashboard\OptionController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.options.index');
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
        $this->option->findOrFail($id)->delete();
        $msg = 'Option was trashed successfully!';

        return redirect()->action('Dashboard\OptionController@index')->with('success', $msg);
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
        $this->option->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Option was deleted successfully!';

        return redirect()->action('Dashboard\OptionController@getTrash')->with('success', $msg);
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
        $this->option->withTrashed()->findOrFail($id)->restore();
        $msg = 'Option was recovered successfully!';

        return redirect()->action('Dashboard\OptionController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'options';
        $list = collect(
            DB::table('options')->where('deleted_at', '=', null)->get(['id', 'name', 'active'])
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
        $url = 'options';
        $list = collect(
            DB::table('options')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
