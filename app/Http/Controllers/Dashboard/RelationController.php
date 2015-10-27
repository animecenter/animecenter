<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\CalendarSeason;
use DB;
use Illuminate\Http\Request;

class RelationController extends DashboardController
{
    /**
     * @var CalendarSeason
     */
    private $calendarSeason;

    /**
     * @param CalendarSeason $calendarSeason
     */
    public function __construct(CalendarSeason $calendarSeason)
    {
        $this->calendarSeason = $calendarSeason;
    }

    public function index()
    {
        return view('dashboard.calendar-seasons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('dashboard.calendar-seasons.create');
    }

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $calendarSeason = new $this->calendarSeason;
        $calendarSeason->name = $request['name'];
        $calendarSeason->active = $request['active'] === '1' ? 1 : 0;
        $calendarSeason->save();
        $msg = 'Calendar Season was created successfully!';

        return redirect()->action('Dashboard\CalendarSeasonController@index')->with('success', $msg);
    }

    /**
     * Show the form for editing a resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id = 0)
    {
        return view(
            'dashboard.calendar-seasons.edit',
            ['calendarSeason' => DB::table('calendar_seasons')->where('id', '=', $id)->first()]
        );
    }

    /**
     * Edit a resource.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id = 0, Request $request)
    {
        $calendarSeason = $this->calendarSeason->findOrFail($id);
        $calendarSeason->name = $request['name'];
        $calendarSeason->active = $request['active'] === '1' ? 1 : 0;
        $calendarSeason->save();
        $msg = 'Calendar Season was edited successfully!';

        return redirect()->action('Dashboard\CalendarSeasonController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.calendar-seasons.trash');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->calendarSeason->findOrFail($id)->delete();
        $msg = 'Calendar Season was trashed successfully!';

        return redirect()->action('Dashboard\CalendarSeasonController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->calendarSeason->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Calendar Season was deleted successfully!';

        return redirect()->action('Dashboard\CalendarSeasonController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->calendarSeason->withTrashed()->findOrFail($id)->restore();
        $msg = 'Calendar Season was recovered successfully!';

        return redirect()->action('Dashboard\CalendarSeasonController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'calendar-seasons';
        $list = collect(DB::table('calendar_seasons')->where('deleted_at', '=', null)->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'calendar-seasons';
        $list = collect(
            DB::table('calendar_seasons')->where('deleted_at', '<>', '')->get(['id', 'name', 'active'])
        );
        $showColumns = ['name', 'active', 'actions'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
