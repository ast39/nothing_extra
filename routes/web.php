<?php

use framework\classes\Routing;

# Application
Routing::getInstance()->get('/', ['uses' => config('options.def_page') . '@' . config('options.def_method')]);
