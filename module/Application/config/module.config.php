<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'album' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/album[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                     'constraints' => array(
                         'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                         'page' => '[0-9]+',
                         'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'order' => 'ASC|DESC',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Album',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'auth' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/auth[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Auth',
                         'action'     => 'login',
                     ),
                 ),
             ),
             'user' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/user[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\User',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'products' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/product[/:action][/:id][/:stage][/page/:page][/order_by/:order_by][/:order]',
                     'constraints' => array(
                         'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                         'stage'  => '[0-9]+',
                         'page' => '[0-9]+',
                         'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'order' => 'ASC|DESC',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Product',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'categories' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/categories[/:action][/:id][/order_by/:order_by][/:order]',
                     'constraints' => array(
                         'action' => '(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                         'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'order' => 'ASC|DESC',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Categories',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'collections' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/collections[/:action][/:id][/order_by/:order_by][/:order]',
                     'constraints' => array(
                         'action' => '(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                         'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'order' => 'ASC|DESC',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Collections',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'stages' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/stages[/:action][/:id][/order_by/:order_by][/:order]',
                     'constraints' => array(
                         'action' => '(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                         'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'order' => 'ASC|DESC',
                     ),
                     'defaults' => array(
                         'controller' => 'Application\Controller\Stages',
                         'action'     => 'index',
                     ),
                 ),
             ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
            'Zend\Authentication\AuthenticationService' => 'my_auth_service',
        ),
    	'invokables' => array(
			'my_auth_service' => 'Zend\Authentication\AuthenticationService',
		),
    ),
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Album' => 'Application\Controller\AlbumController',
            'Application\Controller\Auth' => 'Application\Controller\AuthController',
            'Application\Controller\Product' => 'Application\Controller\ProductController',
            'Application\Controller\Categories' => 'Application\Controller\CategoriesController',
            'Application\Controller\User' => 'Application\Controller\UserController',
            'Application\Controller\Collections' => 'Application\Controller\CollectionsController',
            'Application\Controller\Stages' => 'Application\Controller\StagesController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'paginator-slide'         => __DIR__ . '/../view/layout/slidePaginator.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
