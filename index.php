<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set("display_errors", 1);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require 'vendor/autoload.php';


/* --- System --- */
require 'lib/database.php';
require 'lib/user.php';
require 'lib/dispatch.php';
require 'lib/functions.php';
require 'lib/validasi.php';

/* --- Library --- */
require 'lib/validator.php';
// require 'lib/dependencies.php';
require 'lib/simple_html_dom.php';

config('source', 'config.ini');

$uri = dispatch();

$fl = explode("/", $uri);
$file = 'routes/' . $fl[0] . '.php';

if (file_exists($file)) {
    require $file;
} else {
    require 'routes/core/frontend.php';
    require 'routes/core/backend.php';
}

get('.*', function() {
    not_found();
});

route(method(), "/{$uri}");
