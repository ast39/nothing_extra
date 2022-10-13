<?php

use framework\classes\Routing;

# Application
Routing::instance()->get('/', ['uses' => config('sys.def_page') . '@' . config('sys.def_method')]);
