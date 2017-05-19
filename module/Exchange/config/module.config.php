<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Exchange;

use Zend\ServiceManager\Factory\InvokableFactory;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'translator' => [
        'locale' => 'en',
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo' 
            ] 
        ] 
    ],
    'controllers' => [
        'factories' => [

            Controller\IndexController::class => Controller\Factories\IndexControllerFactory::class,//InvokableFactory::class,//
            Controller\ExchangeController::class => Controller\Factories\ExchangeControllerFactory::class,
            Controller\WalletController::class => Controller\Factories\WalletControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'services' => [
            //'translateHelper'   => TranslateHelper::class,
            //'imageService'      => ImageService::class,
   
        ],
        'aliases' => [
        ],
        'invokables' => [
        ],
        'factories' => [            
           //'translator'  => TranslatorServiceFactory::class,
          
        ],
        'abstract_factories' => [
            //NavigationAbstractServiceFactory::class,
            //LoggerAbstractServiceFactory::class,
        ],
        'initializers' => [
            // initializers
        ],
        'delegators' => [
            // service name => [ delegator factories ]
        ],
        'shared' => [
            // service name => boolean
        ],
    ],
    'lazy_services' => [
        // The class_map is required if using lazy services:
        'class_map' => [
            // service name => class name pairs
        ],
        // The following are optional:
        'proxies_namespace'  => 'Alternate namespace to use for generated proxy classes',
        'proxies_target_dir' => 'path in which to write generated proxy classes',
        'write_proxy_files'  => true, // boolean; false by default
    ],   
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            'exchange' => __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            //'translate'     => TranslateViewHelper::class,
            //'imageHelper'   => ImageHelper::class,
        ],        
        'invokables' => [
        ],
        'factories' => [
            //TranslateViewHelper::class  => TranslateViewHelperFactory::class,
            //ImageHelper::class          => ImageHelperFactory::class,
            
        ]
    ],
    'doctrine' => [
       'authentication' => [
            'orm_default' => [
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => Models\Entities\Users::class,
                'identity_property' => 'Email',
                'credential_property' => 'Password',
            ],
        ],
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Models/Entities',
                            ]
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__. '\Models\Entities' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],  
];
