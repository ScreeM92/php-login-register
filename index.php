<?php

require_once 'core/init.php';
require_once 'core/Routing.php';

try {
    $routing = new Routing();
    $routing->init();
} catch(Exception $e) {}
