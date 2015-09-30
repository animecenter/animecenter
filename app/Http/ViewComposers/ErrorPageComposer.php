<?php

namespace app\Http\ViewComposers;

use AC\Anime\Anime;
use AC\Options\Option;
use AC\Pages\Page;
use Illuminate\Contracts\View\View;

class ErrorPageComposer
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
        $this->data['options'] = $this->option->all();
        $this->data['animeBanner'] = $this->anime->orderByRaw("RAND()")->where('type2', '=', 'subbed')->take(1)->first();
        $this->data['topPagesList'] = $this->page->where('position', '=', 'top')->orderBy('order')->get();
        $this->data['bottomPagesList'] = $this->page->where('position', '=', 'bottom1')->orderBy('order')->get();
        $this->data['bottomPagesList2'] = $this->page->where('position', '=', 'bottom2')->orderBy('order')->get();
        $this->data['bottomPagesList3'] = $this->page->where('position', '=', 'bottom3')->orderBy('order')->get();
        $this->data['pageTitle'] = $pageTitle = "Sorry, the page you have requested cannot be found.";
        $this->data['metaTitle'] = $pageTitle;
        $this->data['metaDesc'] = $pageTitle;
        $this->data['metaKey'] = $pageTitle;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with($this->data);
    }
}
