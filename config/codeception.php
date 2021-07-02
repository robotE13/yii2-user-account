<?php

$config = [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'test'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>'
            ],
        ],
    ]
];

return \yii\helpers\ArrayHelper::merge(require 'test.php', $config);
