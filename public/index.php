<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../bootstrap/app.php';

app()->getRouter()->dispatch($_GET['url'] ?? '/');
