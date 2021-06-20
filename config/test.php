<?php

return [
    'id' => 'tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'mysql:host=db;dbname=user_accounts',
            'username' => 'root',
            'password' => 'root'
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => RobotE13\Yii2UserAccount\Adapters\IdentityAdapter::class,
        ],
    ],
    'modules' => [
        'user-account' => \RobotE13\Yii2UserAccount\Module::class
    ]
];