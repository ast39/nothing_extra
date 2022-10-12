<?php

use framework\classes\Routing;

# Admin panel
Routing::instance()->group(['prefix' => config('options.admin_partition')], function($mv) {

    Routing::instance()->request('GET|POST', 'login', ['uses' => 'Login@index']);
});

Routing::instance()->group(['prefix' => config('options.admin_partition'), 'middleware' => ['Admin']], function($mv) {

    Routing::instance()->get( 'license',      ['middleware' => $mv, 'uses' => 'License@index']);
    Routing::instance()->get( 'home',         ['middleware' => $mv, 'uses' => 'Home@index']);
    Routing::instance()->get( 'logout',       ['middleware' => $mv, 'uses' => 'Logout@index']);
    Routing::instance()->get( 'upload/image', ['middleware' => $mv, 'uses' => 'Images@index']);
    Routing::instance()->post('upload/image', ['middleware' => $mv, 'uses' => 'Images@upload']);

    Routing::instance()->group(['prefix'=> 'management', 'middleware' => $mv], function($mv) {

        Routing::instance()->get('robots',   ['middleware' => $mv, 'uses' => 'Management@robots']);
        Routing::instance()->get('sitemap',  ['middleware' => $mv, 'uses' => 'Management@sitemap']);
        Routing::instance()->get('htaccess', ['middleware' => $mv, 'uses' => 'Management@htaccess']);
    });

    Routing::instance()->group(['prefix'=> 'log', 'middleware' => $mv], function($mv) {

        Routing::instance()->get('error', ['middleware' => $mv, 'uses' => 'Errorlog@index']);
        Routing::instance()->get('visit', ['middleware' => $mv, 'uses' => 'Visitlog@index']);
    });

    Routing::instance()->group(['prefix'=> 'explorer', 'middleware' => ['Root']], function($mv) {

        Routing::instance()->get('scan/{url}',   ['middleware' => $mv, 'uses' => 'Redactor@scan']);
        Routing::instance()->get('back/{steps}', ['middleware' => $mv, 'uses' => 'Redactor@back']);
        Routing::instance()->get('show/{url}',   ['middleware' => $mv, 'uses' => 'Redactor@showFile']);
        Routing::instance()->get('delete/{url}', ['middleware' => $mv, 'uses' => 'Redactor@delete']);

        Routing::instance()->request('GET|POST', 'new/dir/{url}',  ['middleware' => $mv, 'uses' => 'Redactor@newDir']);
        Routing::instance()->request('GET|POST', 'new/file/{url}', ['middleware' => $mv, 'uses' => 'Redactor@newFile']);
        Routing::instance()->request('GET|POST', 'upload/{url}',   ['middleware' => $mv, 'uses' => 'Redactor@uploadFile']);
        Routing::instance()->request('GET|POST', 'edit/{url}',     ['middleware' => $mv, 'uses' => 'Redactor@editFile']);
    });

    Routing::instance()->get('/', ['uses' => 'Home@index']);

});
