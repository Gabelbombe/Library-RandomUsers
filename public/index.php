<?php
/**
 * Example:
 */
require dirname(__DIR__) . '/vendor/autoload.php';

$random = New \RandomUsers\Generator();

print_r($random->getMales(3));
