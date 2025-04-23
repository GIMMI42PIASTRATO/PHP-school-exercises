<?php

declare(strict_types=1);

require_once __DIR__ . "/lib/Router.php";
require_once __DIR__ . "/routes/web.php";

// Run the router for web routes
Router::run(false);
