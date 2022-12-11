<?php
require_once './phptodo/PHPTODO.php';
if (file_exists('../malltodo-php.database.config/database.config.create.php')) {
    require_once '../malltodo-php.database.config/database.config.create.php';
} else {
    TDREDIRECT(TDUU("Index/Index/index", array(), "index.php"));
}