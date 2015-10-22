# animecenter

## What is animecenter?

animecenter is an anime aggregation platform. Every link and information on animecenter is found on the open internet. 
We don't host any illegal content on our server. If you think otherwise, please let us know.

## What main software does animecenter use?

- [Laravel](http://laravel.com) for the backend.
- [Bootstrap](https://getbootstrap.com) for styling pages.
- [jQuery](https://jquery.con) for dynamic content.
- [Bower](http://bower.io) for managing web dependencies.
- [Gulp](http://gulpjs.com) for automating common tasks.
- [SASS](http://sass-lang.com) for preprocessing CSS.
- [Scrapy](https://scrapy.org) for data and links aggregation.

## Development

### Setup

1. We need to install [Homestead](http://laravel.com/docs/homestead) first because it comes with almost all 
requirements to start developing right away on the codebase.
2. You need to clone this repository: `git clone git@github.com:animecenter/animecenter.git`
3. Update your `Homestead.yml` with the following settings:
    1. Add the path for the cloned animecenter repository to the `folders` list
    2. Add a site `animecenter.app` for the animecenter repository to the `sites` list
    3. Add a database called `animecenter` to the `databases` list
    4. Run `homestead provision`
4. SSH into your Homestead box and run the following commands:
    1. `composer install`
    2. `php artisan migrate --seed --env=local`
    3. `npm install`
    4. `bower install`
5. Add `192.168.10.10 animecenter.app` to your computer's `hosts` file
6. Visit animecenter.app in the browser.
7. Start developing!

### Instructions

- If you want to modify CSS, you can modify the .scss files inside resources/assets/sass and compile them with `gulp css`
- If you want to modify JS, you can modify the .js files inside resources/assets/js and compile them with `gulp js`
- If you want to modify how a web page is presented, you can modify the .blade.php files inside resources/views and they are compile automatically

The app folders you will find at resources/* are for the frontend main application and dashboard folders are for the admin dashboard.

## Contributions

Everyone is welcome to contribute. You can do it in the following ways:

If you want a new feature, make an issue with all details.

If you find a bug, make an issue describing how you came upon it and what os, browser, etc you are using.

If you want to contribute code, fork the project, branch off of the development branch and pick an issue to solve. 
When you finish solving it, do a pull request. There is a higher chance for a feature to be accepted if you make tests for it.

## To Do

- [ ] Finish the new design and new admin interface.
- [ ] Implement Reviews, and Recommendations.
- [ ] Make tests and add repository to travis.
- [ ] Make a API in Laravel.
- [ ] Use React for the frontend.

## License

animecenter is licensed under the [CPAL-1.0](http://opensource.org/licenses/CPAL-1.0) license.
For better understanding of what you can do with it visit [tldrlegal.com](https://tldrlegal.com/license/common-public-attribution-license-version-1.0-(cpal-1.0)).
