<?php

namespace App\Http\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\Migrations\Tools\Console\ConsoleLogger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntityManagerCreator
{
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            // "/.." é acesso a pasta /src
            [__DIR__ . "/.."],
            true
        );

        // $consoleOutput = new ConsoleOutput(ConsoleOutput::VERBOSITY_DEBUG);
        // $consoleLogger = new ConsoleLogger($consoleOutput);
        // $logMiddleware = new Middleware($consoleLogger);
        // $config->setMiddlewares([
        //     // new Middleware(new ConsoleLogger(new ConsoleOutput()))
        //     $logMiddleware,
        // ]);

        $conn = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbname' => 'campeonatos',
            'user' => 'root',
            'charset' => 'utf8',
            'password' => '123456' 
        ]);

        return new EntityManager($conn, $config);
    }
}