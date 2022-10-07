<?php

use framework\classes\Routing;

# Admin panel
Routing::getInstance()->group(['prefix' => config('options.admin_partition')], function($mv) {

    Routing::getInstance()->request('GET|POST', 'login', ['uses' => 'Login@index']);
});

Routing::getInstance()->group(['prefix' => config('options.admin_partition'), 'middleware' => ['Admin']], function($mv) {

    Routing::getInstance()->get( 'license',      ['middleware' => $mv, 'uses' => 'License@index']);
    Routing::getInstance()->get( 'home',         ['middleware' => $mv, 'uses' => 'Home@index']);
    Routing::getInstance()->get( 'logout',       ['middleware' => $mv, 'uses' => 'Logout@index']);
    Routing::getInstance()->get( 'upload/image', ['middleware' => $mv, 'uses' => 'Images@index']);
    Routing::getInstance()->post('upload/image', ['middleware' => $mv, 'uses' => 'Images@upload']);

    Routing::getInstance()->group(['prefix'=> 'management', 'middleware' => $mv], function($mv) {

        Routing::getInstance()->get('robots',   ['middleware' => $mv, 'uses' => 'Management@robots']);
        Routing::getInstance()->get('sitemap',  ['middleware' => $mv, 'uses' => 'Management@sitemap']);
        Routing::getInstance()->get('htaccess', ['middleware' => $mv, 'uses' => 'Management@htaccess']);
    });

    Routing::getInstance()->group(['prefix'=> 'log', 'middleware' => $mv], function($mv) {

        Routing::getInstance()->get('error', ['middleware' => $mv, 'uses' => 'Errorlog@index']);
        Routing::getInstance()->get('visit', ['middleware' => $mv, 'uses' => 'Visitlog@index']);
    });

    Routing::getInstance()->group(['prefix'=> 'explorer', 'middleware' => ['Root']], function($mv) {

        Routing::getInstance()->get('scan/{url}',   ['middleware' => $mv, 'uses' => 'Redactor@scan']);
        Routing::getInstance()->get('back/{steps}', ['middleware' => $mv, 'uses' => 'Redactor@back']);
        Routing::getInstance()->get('show/{url}',   ['middleware' => $mv, 'uses' => 'Redactor@showFile']);
        Routing::getInstance()->get('delete/{url}', ['middleware' => $mv, 'uses' => 'Redactor@delete']);

        Routing::getInstance()->request('GET|POST', 'new/dir/{url}',  ['middleware' => $mv, 'uses' => 'Redactor@newDir']);
        Routing::getInstance()->request('GET|POST', 'new/file/{url}', ['middleware' => $mv, 'uses' => 'Redactor@newFile']);
        Routing::getInstance()->request('GET|POST', 'upload/{url}',   ['middleware' => $mv, 'uses' => 'Redactor@uploadFile']);
        Routing::getInstance()->request('GET|POST', 'edit/{url}',     ['middleware' => $mv, 'uses' => 'Redactor@editFile']);
    });

    Routing::getInstance()->get('/', ['uses' => 'Home@index']);

});
