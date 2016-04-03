<?php

namespace AC\Composers;

use AC\Models\Option;
use AC\Models\Page;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;

class AppComposer
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * @var Page
     */
    private $page;

    /**
     * @var Option
     */
    private $option;

    /**
     * Create a new page composer.
     *
     * @param Guard  $auth
     * @param Page   $page
     * @param Option $option
     */
    public function __construct(Guard $auth, Page $page, Option $option)
    {
        $this->auth = $auth;
        $this->page = $page;
        $this->option = $option;
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
        $this->data['options'] = $this->option->all(['name', 'value']);
        $this->data['pages'] = $this->page->get(['title', 'slug', 'content']);

        $view->with($this->data);
    }
}
