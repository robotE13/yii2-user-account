<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RobotE13\Yii2UserAccount;

use yii\helpers\ArrayHelper;

/**
 * Description of Bootstrap
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class Bootstrap implements \yii\base\BootstrapInterface
{

    /**
     *
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        if($app instanceof \yii\console\Application)
        {
            // добавление пути к миграциям модуля в Yii контроллер миграций
            $app->controllerMap = ArrayHelper::merge($app->controllerMap, ['migrate' => [
                            'class' => \yii\console\controllers\MigrateController::class,
                            'migrationNamespaces' => ['RobotE13\Yii2UserAccount\Repositories\Migrations']]
            ]);
        }

        if($app instanceof \yii\web\Application)
        {
            $app->setModule('accounts', [
                'class' => Module::class
            ]);
        }
    }

}
