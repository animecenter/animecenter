<?php

namespace AC\Http\Controllers\Dashboard;

use AC\Models\Option;
use DB;

class OptionController extends DashboardController
{
    /**
     * @var Option
     */
    private $option;

    private $data;

    /**
     * @param Option $option
     */
    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    public function getList()
    {
        $url = 'options';
        $list = collect(DB::table('options')->get(['id', 'name', 'active']));
        $showColumns = ['name', 'active'];
        $searchColumns = ['name', 'active'];
        $orderColumns = ['name', 'active'];

        return parent::getDataTableList($url, $list, $showColumns, $searchColumns, $orderColumns);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function getEdit()
    {
        $this->data['options'] = $this->option->all();

        return view('dashboard.options.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $options = $this->option->all();
        if ($request['title'] !== $options[0]['value']) {
            $option = $this->option->findOrFail(1);
            $option->value = $request['title'];
            $option->save();
        }
        if ($request['text'] !== $options[1]['value']) {
            $option = $this->option->findOrFail(2);
            $option->value = $request['text'];
            $option->save();
        }
        if ($request['subbed'] !== $options[2]['value']) {
            $option = $this->option->findOrFail(3);
            $option->value = $request['subbed'];
            $option->save();
        }
        if ($request['dubbed'] !== $options[3]['value']) {
            $option = $this->option->findOrFail(4);
            $option->value = $request['dubbed'];
            $option->save();
        }
        if ($request['episode'] !== $options[4]['value']) {
            $option = $this->option->findOrFail(5);
            $option->value = $request['episode'];
            $option->save();
        }
        $msg = "Options were updated successfully";

        return redirect()->back()->with('success', $msg);
    }
}
