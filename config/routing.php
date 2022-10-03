<?php

return [

    'routes' => [

        [

            'method'  => 'GET',
            'pattern' => 'foo/bar',
            'action'  => config('options.def_page') . '@' . config('options.def_method'),
        ], [

            'method'  => 'POST',
            'pattern' => 'foo/bar',
            'action'  => 'login@auth',
        ],

    ],

];
