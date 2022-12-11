<?php
require_once './phptodo/PHPTODO.php';
require_once 'Common/config.php';
require_once 'Common/function.php';
require_once 'Common/malltodo.service.php';
require_once 'Common/RenovationWidget.php';
require_once 'Common/MU.php';
if (checkIsInstall()) {
    echo PHPTODO::run("Index");
} else {
    echo PHPTODO::run("Install");
}