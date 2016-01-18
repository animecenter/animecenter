<?php

namespace AC\Composers;

use AC\Models\Meta;
use AC\Models\Option;
use AC\Models\Page;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\View\View;
use Route;

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
     * @var Meta
     */
    private $meta;

    /**
     * Create a new page composer.
     *
     * @param Guard  $auth
     * @param Page   $page
     * @param Option $option
     * @param Meta   $meta
     */
    public function __construct(Guard $auth, Page $page, Option $option, Meta $meta)
    {
        $this->auth = $auth;
        $this->page = $page;
        $this->option = $option;
        $this->meta = $meta;
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
        $this->data['options'] = $this->option->all();
        $this->data['pages'] = $this->page->get();

        // TODO: Get meta data
        $url = Route::current()->uri();
        $meta = $this->meta; //$this->meta->whereRoute($url)->firstOrFail();
        $this->data['pageTitle'] = $meta->title;
        $this->data['metaTitle'] = $meta->title;
        $this->data['metaDesc'] = $meta->description;
        $this->data['metaKeys'] = $meta->keywords;

        $view->with($this->data);
    }
}
