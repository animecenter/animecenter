<?php

namespace AC\Composers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;

class DashboardComposer
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * Create a new page error composer.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $this->data['user'] = $this->auth->user();

        $view->with($this->data);
    }
}
