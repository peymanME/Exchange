<?php
namespace Exchange;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
return [
    'router' => [
        'routes' => [
            'root' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'home' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/Home[/:action]',
                    'constraints' => [
                        'action' 	=> '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],             
            'exchange' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/Exchange[/:action]',
                    'constraints' => [
                        'action' 	=> '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'keyword' 	=> '[a-zA-Z0-9_-]*',
//                        'id'		=> '[0-9]*'
                    ],
                    'defaults' => [
                        //'__NAMESPACE__' => $pathController,
                        'controller' 	=> Controller\ExchangeController::class,
                        'action' 		=> 'index'
                    ]
                ]
            ],
            'wallet' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/Wallet[/:action][/:currency]',
                    'constraints' => [
                        'action' 	=> '[a-zA-Z][a-zA-Z0-9_-]*',
                        'currency' 	=> '[a-zA-Z]*',
//                        'id'		=> '[0-9]*'
                    ],
                    'defaults' => [
                        //'__NAMESPACE__' => $pathController,
                        'controller' 	=> Controller\WalletController::class,
                        'action' 		=> 'index'
                    ]
                ]
            ],
        ],
    ]
];