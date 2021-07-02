<?php

return [
    'id' => 'user-account-tests',
    'basePath' => Yii::getAlias('@RobotE13/Yii2UserAccount'),
    'bootstrap' => [\RobotE13\Yii2UserAccount\Bootstrap::class],
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'components' => [
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'mysql:host=db;dbname=test_module',
            'username' => 'root',
            'password' => 'rootpassword'
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => RobotE13\Yii2UserAccount\Adapters\IdentityAdapter::class,
        ],
    ],
    'modules' => [
        'accounts' => \RobotE13\Yii2UserAccount\Module::class
    ]
];
