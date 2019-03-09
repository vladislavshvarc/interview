<?php

$params = array_merge(require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php');

$routes = include 'routes.php';

return [
	'id'                  => 'app-api',
	'basePath'            => dirname(__DIR__),
	'bootstrap'           => [ 'log' ],
	'controllerNamespace' => 'api\controllers',
	'components'          => [
		'request'      => [
			'csrfParam' => '_csrf-api',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],
		'user'         => [
			'identityClass'   => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie'  => [
				'name'     => '_identity-api',
				'httpOnly' => true
			],
		],
		'session'      => [
			// this is the name of the session cookie used for login on the frontend
			'name' => 'advanced-api',
		],
		'log'          => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets'    => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => [
						'error',
						'warning'
					],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'voyages/error',
		],
		'urlManager'   => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'rules'           => $routes,
		],
	],
	'params'              => $params,
];
