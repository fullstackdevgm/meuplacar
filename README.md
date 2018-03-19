# Meu Placar

* [Production Website](http://www.meuplacar.com)
* [Dev Website](http://www.fernandohenriques.com.br/meuplacar)

## Overview & Architecture

### Similar websites
* http://www.resultados.com
* http://www.flashscore.com/

* API that provides the data
* We are using Soccerama, which is already all configured in the project with its API as a "vendor".
* Link for docs: https://soccerama.pro/docs/1.2
* Path API in project: /vendor/rebing/laravel-soccerama/
* Paths for requests here: /vendor/rebing/laravel-soccerama/src/Rebing/Soccerama/Soccerama.php

The structure of the theme is as follows:
   * /assets/: css, js, images and fonts files
   * /layouts/: HTML default of site -- do not change.
   * /partials/: HTMLs loaded by ajax
   * /content/: Parts of HTML used in Partials files
   * /pages/: Pages of Site
   * /themes/website/: Theme main folder

### Technologies used
   * PHP Laravel
   * October CMS
   * Laravel Soccerama.pro API


## Testing

## Local Development

### Installation
   * Clone from Git: git clone [url]
   * Create a Database and configure at "/config/database.php".

### Build
   * Move to Root Directory: cd meuplacar
   * Migrate Database: php artisan migrate

### Run
   * Run apache: php artisan serve
   * Otherwise you can configure it on XAMPP/LAMP/MAMP