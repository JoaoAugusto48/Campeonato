<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'Psr\\Http\\Server\\' => array($vendorDir . '/psr/http-server-handler/src'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-factory/src', $vendorDir . '/psr/http-message/src'),
    'Psr\\Container\\' => array($vendorDir . '/psr/container/src'),
    'Nyholm\\Psr7\\' => array($vendorDir . '/nyholm/psr7/src'),
    'Nyholm\\Psr7Server\\' => array($vendorDir . '/nyholm/psr7-server/src'),
    'League\\Plates\\' => array($vendorDir . '/league/plates/src'),
    'Laravel\\SerializableClosure\\' => array($vendorDir . '/laravel/serializable-closure/src'),
    'Invoker\\' => array($vendorDir . '/php-di/invoker/src'),
    'DI\\' => array($vendorDir . '/php-di/php-di/src'),
    'App\\Http\\' => array($baseDir . '/src'),
);
