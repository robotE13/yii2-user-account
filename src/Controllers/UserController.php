<?php

/**
 * This file is part of the yii2-user-account.
 *
 * Copyright 2020 Evgenii Dudal <wolfstrace@gmail.com>.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * @package yii2-user-account
 */

namespace RobotE13\Yii2UserAccount\Controllers;

use RobotE13\Yii2UserAccount\Forms\LoginForm;

/**
 * Description of AuthController
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class UserController extends \yii\web\Controller
{

    public function actionSignIn()
    {
        $form = new LoginForm();
        return $this->render('sign-in', compact('form'));
    }

    public function actionSignUp()
    {

    }

    public function actionLogout()
    {

    }

}
