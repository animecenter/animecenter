<?php

namespace AC\Http\ViewComposers;

use AC\Anime\Anime;
use AC\Options\Option;
use AC\Pages\Page;
use Illuminate\Contracts\View\View;

class ErrorComposer
{
    /**
     * @var Page
     */
    private $page;

    /**
     * @var Option
     */
    private $option;

    /**
     * @var Anime
     */
    private $anime;

    /**
     * Create a new page error composer.
     * @param Page $page
     * @param Option $option
     * @param Anime $anime
     */
    public function __construct(Page $page, Option $option, Anime $anime)
    {
        $this->page = $page;
        $this->option = $option;
        $this->anime = $anime;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->data['pageTitle'] = $pageTitle = "Sorry, the page you have requested cannot be found.";
        $this->data['metaTitle'] = $pageTitle;
        $this->data['metaDesc'] = $pageTitle;
        $this->data['metaKey'] = $pageTitle;

        $view->with($this->data);
    }
}
