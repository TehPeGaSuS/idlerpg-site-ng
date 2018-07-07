<?php

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Application\Service\BotParser;
use Application\View\Helper\Scoreboard;

return [
    'router' => require __DIR__ .'/router.config.php',
    'navigation' => require __DIR__ .'/navigation.config.php',

    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IdleControllerFactory::class,
            Controller\JsonController::class => Controller\Factory\IdleControllerFactory::class,
            Controller\ImageController::class => Controller\Factory\IdleControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            'Cache' => Service\Factory\CacheFactory::class,
            BotParser::class => Service\Factory\BotParserFactory::class,
        ],
    ],

    'view_helpers' => [
        'aliases' => [
            'scoreboard' => Scoreboard::class,
        ],
        'factories' => [
            Scoreboard::class => InvokableFactory::class,
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/game-info.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
