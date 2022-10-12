<?php

use framework\classes\Routing;

# Application
Routing::instance()->get('/', ['uses' => config('options.def_page') . '@' . config('options.def_method')]);
