<?php
/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Unban\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'resources' => [
        'unban' => ['url', '/unban']
    ],

    'routes' => [
	   ['name' => 'unban#index', 'url' => '/unban/showBan', 'verb' => 'GET']
    ]
];
