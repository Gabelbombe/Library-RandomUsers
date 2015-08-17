<?php
/**
 * Example:
 */
require dirname(__DIR__) . '/vendor/autoload.php';

$random = New \RandomUsers\Generator();

echo "\n\n" . print_r($random->getMales(1),     1);
echo "\n\n" . print_r($random->getFemales(1),   1);
echo "\n\n" . print_r($random->getUsers(3),     1);
