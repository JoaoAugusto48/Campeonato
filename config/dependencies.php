<?php 

declare(strict_types=1);

use App\Http\Helper\EntityManagerCreator;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    // PDO::class => function(): PDO {
    //     return new PDO('mysql:host=127.0.0.1:3306;dbname=campeonatos;charset=utf8', 'root', '123456');
    // },
    PDO::class => EntityManagerCreator::createEntityManager(),
    \League\Plates\Engine::class => function() {
        $templatePath = __DIR__ . '/../views';
        return new \League\Plates\Engine($templatePath);
    },
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;