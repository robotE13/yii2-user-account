<?php

namespace RobotE13\Yii2UserAccount\Controllers;

use yii\web\Controller;

/**
 * Default controller for the `yii2-user-account` module
 */
class AdminController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
