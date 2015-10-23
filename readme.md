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

### Requirements

1. [Git](https://git-scm.com/download)
2. PHP 5.6
    - Windows
        - TODO:
    - Ubuntu
        1. `sudo apt-get update && sudo apt-get install python-software-properties`
        2. `sudo add-apt-repository ppa:ondrej/php5-5.6 && sudo apt-get update && sudo apt-get install php5`
        3. To confirm: `php5 -v`
    - Mac OS X
        1. `curl -s http://php-osx.liip.ch/install.sh | bash -s 5.6`
        2. Write into your ~/.profile file the following `export PATH=/usr/local/php5/bin:$PATH`
3. [VirtualBox 5.x](https://www.virtualbox.org/wiki/Downloads)
4. [Vagrant](https://www.vagrantup.com/downloads.html)

### Setup

1. Clone this repository: `git clone https://github.com/animecenter/animecenter.git`
2. In the command line change directory to the animecenter repository you just downloaded with `cd path/to/directory` and run the following commands:
    1. Change to the development branch with `git checkout development`
    2. Use one of the following commands depending on your Operating System:
        - Mac / Linux:
            `php vendor/bin/homestead make`
        - Windows:
            `vendor\bin\homestead make`
3. Update `Homestead.yaml` with the following settings:
    1. Change `map: homestead.app` to `map: animecenter.app`
    2. If you don't have a SSH key, run `ssh-keygen -t rsa -C "you@homestead"` in the command line. Windows users should use Git Bash.
    3. Run `vagrant up` in the command line
4. SSH into your Homestead box with `vagrant ssh`, go to folder containing the code with `cd /home/vagrant/animecenter` and run the following commands to install development dependencies:
    1. `composer install`
    2. `php artisan migrate --seed --env=local`
    3. `npm install`
    4. `bower install`
5. Add `192.168.10.10 animecenter.app` to your computer's `hosts` file.
    - On Mac and Linux, this file is located at `/etc/hosts`. 
    - On Windows, it is located at `C:\Windows\System32\drivers\etc\hosts`.
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
