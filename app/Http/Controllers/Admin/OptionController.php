<?php

namespace AC\Http\Controllers\Admin;

use AC\Http\Controllers\Controller;
use AC\Models\Option;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * @var Option
     */
    private $option;

    /**
     * @var Guard
     */
    private $auth;

    private $data;

    /**
     * @param Option $option
     * @param Guard $auth
     */
    public function __construct(Option $option, Guard $auth)
    {
        $this->option = $option;
        $this->auth = $auth;
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function getEdit()
    {
        $this->data['options'] = $this->option->all();
        $this->data['user'] = $this->auth->user();

        return view('admin.options.edit', $this->data);
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
