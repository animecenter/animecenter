<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\MirrorReport;
use DB;
use Illuminate\Http\Request;

class MirrorReportController extends DashboardController
{
    /**
     * @var MirrorReport
     */
    private $mirrorReport;

    /**
     * @param MirrorReport $mirrorReport
     */
    public function __construct(MirrorReport $mirrorReport)
    {
        $this->mirrorReport = $mirrorReport;
    }

    public function index()
    {
        return view('dashboard.mirror-reports.index');
    }

    /**
     * Show the form for editing a resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id = 0)
    {
        return view('dashboard.mirror-reports.edit', [
            'mirrorReport' => DB::table('mirror_reports')->join('users', 'mirror_reports.user_id', '=', 'users.id')
                ->join('mirrors', 'mirror_reports.mirror_id', '=', 'mirrors.id')->where('mirror_reports.id', '=', $id)
                ->first([
                    'mirror_reports.id', 'users.username', 'mirrors.url', 'mirror_reports.verified',
                    'mirror_reports.broken', 'mirror_reports.active'
                ])
        ]);
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
        $mirrorReport = $this->mirrorReport->findOrFail($id);
        $mirrorReport->user_id = $request['user_id'];
        $mirrorReport->mirror_id = $request['mirror_id'];
        $mirrorReport->verified = $request['verified'] === '1' ? 1 : 0;
        $mirrorReport->broken = $request['broken'] === '1' ? 1 : 0;
        $mirrorReport->active = $request['active'] === '1' ? 1 : 0;
        $mirrorReport->save();
        $msg = 'Mirror Report was edited successfully!';

        return redirect()->action('Dashboard\MirrorReportController@index')->with('success', $msg);
    }

    /**
     * Show trash resources.
     *
     * @return \Illuminate\View\View
     */
    public function getTrash()
    {
        return view('dashboard.mirror-reports.index');
    }

    /**
     * Trash resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrash($id = 0)
    {
        $this->mirrorReport->findOrFail($id)->delete();
        $msg = 'Mirror Report was trashed successfully!';

        return redirect()->action('Dashboard\MirrorReportController@index')->with('success', $msg);
    }

    /**
     * Delete resource by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($id = 0)
    {
        $this->mirrorReport->withTrashed()->findOrFail($id)->forceDelete();
        $msg = 'Mirror Report was deleted successfully!';

        return redirect()->action('Dashboard\MirrorReportController@getTrash')->with('success', $msg);
    }

    /**
     * Recover resource from trash by id.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecover($id = 0)
    {
        $this->mirrorReport->withTrashed()->findOrFail($id)->restore();
        $msg = 'Mirror Report was recovered successfully!';

        return redirect()->action('Dashboard\MirrorReportController@getTrash')->with('success', $msg);
    }

    /**
     * Get resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $url = 'mirror-reports';
        $list = collect(
            DB::table('mirror_reports')->join('users', 'mirror_reports.user_id', '=', 'users.id')
                ->join('mirrors', 'mirror_reports.mirror_id', '=', 'mirrors.id')
                ->where('mirror_reports.deleted_at', '=', null)
                ->get([
                    'mirror_reports.id', 'users.username', 'mirrors.url', 'mirror_reports.verified',
                    'mirror_reports.broken', 'mirror_reports.active'
                ])
        );
        $showColumns = ['username', 'url', 'verified', 'broken', 'active', 'actions'];
        $searchColumns = ['username', 'url', 'active'];
        $orderColumns = ['username', 'url', 'verified', 'broken', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Get trash resource listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListTrash()
    {
        $url = 'mirror-reports';
        $list = collect(
            DB::table('mirror_reports')->join('users', 'mirror_reports.user_id', '=', 'users.id')
                ->join('mirrors', 'mirror_reports.mirror_id', '=', 'mirrors.id')
                ->where('mirror_reports.deleted_at', '<>', '')
                ->get([
                    'mirror_reports.id', 'users.username', 'mirrors.url', 'mirror_reports.verified',
                    'mirror_reports.broken', 'mirror_reports.active'
                ])
        );
        $showColumns = ['username', 'url', 'verified', 'broken', 'active', 'actions'];
        $searchColumns = ['username', 'url', 'active'];
        $orderColumns = ['username', 'url', 'verified', 'broken', 'active'];

        return parent::getDataTableListTrash($url, $list, $showColumns, $searchColumns, $orderColumns);
    }
}
