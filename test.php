<?php
$loader = require 'vendor/autoload.php';
$prefixes = $loader->getPrefixesPsr4();
foreach (array_keys($prefixes) as $key) {
    if (strpos($key, 'Penjamin') !== false) {
        echo $key . "\n";
    }
}
