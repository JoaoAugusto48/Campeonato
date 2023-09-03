<?php

namespace App\Http\Helper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            // "/.." é acesso a pasta /src
            [__DIR__ . "/.."],
            true
        );

        $conn = [
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbname' => 'campeonatos',
            'user' => 'root',
            'charset' => 'utf8',
            'password' => '123456' 
        ];

        return EntityManager::create($conn, $config);
    }
}