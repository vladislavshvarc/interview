<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'i18n' => [
			'translations' => [
				'*' => [
					'class'          => 'yii\i18n\PhpMessageSource',
					'basePath'       => '@app/messages',
					'sourceLanguage' => 'en',
					'fileMap'        => [
						//'main' => 'main.php',
					],
				],
			],
		],
    ],
];
